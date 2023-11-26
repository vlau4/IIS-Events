<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Location;
use App\Models\Attending;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;

class EventController extends Controller
{
    // Show All Events
    public function index() {
        return view('home', [
            'events' => Event::where('confirmed', '1')->latest()->filter(request(['tag', 'category_id', 'location_id', 'search']))->paginate(6)
        ]);
    }

    // Show Single Event
    public function show(Event $event) {
        if(auth()->user()) {    // if sign in, find out if user is attending the event
            $attending = Attending::where('event_id', $event->id)->where('user_id', auth()->user()->id)->first();
        } else {                // if not, he is not attending the event
            $attending = 0;
        }

        return view('events.show', [
            'event' => $event,
            'comments' => Comment::where('event_id', $event->id)->get(),
            'today' => date("Y-m-d"),
            'attending' => $attending
        ]);
    }

    // Show My Events
    public function showMyEvents(Request $request) {

        $events = Attending::where('user_id', auth()->user()->id)->get(['event_id']);

        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
            ->whereDate('end',   '<=', $request->end)
            ->whereIn('id', $events)
            ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
            
        }

        return view('users.my-events');
    }

    

    // Add To My Events
    public function add(Event $event) {
        
        if(Attending::where('user_id', auth()->id())->where('event_id', $event->id)->first()) {
            return back()->with('err', 'This event is already in your events!');
        }

        Attending::create([
            'user_id' => auth()->id(),
            'event_id'=> $event->id
        ]);

        return redirect('/events/mine')->with('message', 'Event added to my events successfully!');
    }

    public function remove(Event $event) {

        (Attending::where('event_id', $event->id)->where('user_id', auth()->user()->id)->first())->delete();
        return back()->with('message', 'Event removed from my events successfully!');
    }

    // Show Create Form
    public function create() {

        $categories = Category::where('confirmed', 1)->get();

        // recursive function for subcategories
        $generator = function (Collection $level) use ($categories, &$generator) {
            // sorting by id
            foreach ($level->sortBy('id') as $item) {

                // yield a single item
                yield $item;
    
                // continue yielding results from the recursive call
                yield from $generator($categories->where('parent_id', $item->id));
            }
        };
    
        $categories = LazyCollection::make(function () use ($categories, $generator) {

            // yield from root level
            yield from $generator($categories->where('parent_id', null));
        })->flatten()->collect();

        // dd($categories);
    
        return view('events.create', [
            'categories' => $categories,
            'locations' => Location::where('confirmed', 1)->get()
        ]);
    }

    // Store Event Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required|max:40',
            'category_id' => 'required',
            'location_id' => 'required',
            'start' => 'required|date|after:today',
            'end' => 'required|date|after:start',
            'capacity' => 'nullable',
            'tags' => 'nullable',
            'description' => 'nullable'
        ]);

        $entryFee = [];
        for($i=0; ; $i++) {
            $cat = 'fee_category_' . str($i);
            $val = 'fee_value_' . str($i);
            error_log($request->$cat);
            error_log($request->$val);
            if($request->$cat && $request->$val) {
                error_log('here');
                if(strpos($request->$cat, ',') || strpos($request->$cat, ':') || strpos($request->$val, ',') || strpos($request->$cat, ':')) {
                    return redirect()->route('event.create')->with('err', 'You cannot use ":" or "," in Entry Fee field!');
                }
                array_push($entryFee, $request->$cat); // even item in $entryFee is always category
                array_push($entryFee, $request->$val); // odd item in $entryFee is always value
            } elseif($i == 0 && $request->$val){
                $formFields['entry_fee'] = $request->$val;
                break;
            } else {    // one of the fields is missing or both or nothing more was given
                break;
            }
        }

        
        if(count($entryFee) != 0){  // it is not only one value without categories
            $feeField = '';
            for($i = 0; $i<count($entryFee); $i++){
                if($i % 2 == 0) {   // it is category
                    $feeField .= $entryFee[$i] . ':';
                } else {   // it is value
                    $feeField .= $entryFee[$i] . ',';
                }
            }
            $formFields['entry_fee'] = $feeField;
        }
        

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        $event = Event::create($formFields);

        return redirect('/')->with('message', 'Event created successfully!');
    }

    // Show Event Edit Form
    public function edit(Event $event) {

        $categories = Category::where('confirmed', 1)->get();

        // recursive function for subcategories
        $generator = function (Collection $level) use ($categories, &$generator) {
            // sorting by id
            foreach ($level->sortBy('id') as $item) {

                // yield a single item
                yield $item;
    
                // continue yielding results from the recursive call
                yield from $generator($categories->where('parent_id', $item->id));
            }
        };
    
        $categories = LazyCollection::make(function () use ($categories, $generator) {

            // yield from root level
            yield from $generator($categories->where('parent_id', null));
        })->flatten()->collect();

        return view('events.edit', [
            'event' => $event,
            'categories' => $categories,
            'locations' => Location::where('confirmed', 1)->get()
        ]);
    }

    // Update Event
    public function update(Request $request, Event $event) {

        // Make sure logged in user is owner
        if($event->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required|max:40',
            'category_id' => 'required',
            'location_id' => 'required',
            'start' => 'required|date|after:today',
            'end' => 'required|date|after:start',
            'capacity' => 'nullable',
            'tags' => 'nullable',
            'description' => 'nullable'
        ]);

        $entryFee = [];
        for($i=0; ; $i++) {
            $cat = 'fee_category_' . str($i);
            $val = 'fee_value_' . str($i);
            error_log($request->$cat);
            error_log($request->$val);
            if($request->$cat && $request->$val) {
                error_log('here');
                if(strpos($request->$cat, ',') || strpos($request->$cat, ':') || strpos($request->$val, ',') || strpos($request->$cat, ':')) {
                    return redirect()->route('event.create')->with('err', 'You cannot use ":" or "," in Entry Fee field!');
                }
                array_push($entryFee, $request->$cat); // even item in $entryFee is always category
                array_push($entryFee, $request->$val); // odd item in $entryFee is always value
            } elseif($i == 0 && $request->$val){
                $formFields['entry_fee'] = $request->$val;
                break;
            } else {    // one of the fields is missing or both or nothing more was given
                break;
            }
        }

        
        if(count($entryFee) != 0){  // it is not only one value without categories
            $feeField = '';
            for($i = 0; $i<count($entryFee); $i++){
                if($i % 2 == 0) {   // it is category
                    $feeField .= $entryFee[$i] . ':';
                } else {   // it is value
                    $feeField .= $entryFee[$i] . ',';
                }
            }
            $formFields['entry_fee'] = $feeField;
        }

        $formFields['entry_fee'] = $feeField;

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['confirmed'] = 0;

        $event->update($formFields);

        return redirect('/')->with('message', 'Event was updated successfully!');
    }

    // Delete Event
    public function destroy(Event $event) {
        if($event->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $event->delete();
        return redirect('/')->with('message', 'Event deleted successfully!');
    }

    // Manage Events
    public function manage() {
        return view('events.manage', ['events' => request()->user()->events()->get()->sortBy('title')]);
    }

    // Manage Event Payments
    public function payments(Event $event) {
        return view('events.payments', [
            'event' => $event,
            'attendings' => Attending::where('event_id', $event->id)->get()
        ]);
    }

    // Show Event Confirm Section
    public function showConfirm() {
        return view('confirm', [
            'events' => Event::where('confirmed', 0)->get()->sortBy('updated_at'),
            'categories' => Category::where('confirmed', 0)->get()->sortBy('updated_at'),
            'locations' => Location::where('confirmed', 0)->get()->sortBy('updated_at')
        ]);
    }

    // Confirm New Event Created by User
    public function confirm(Event $event) {
        $formFields['confirmed'] = 1;

        $event->update($formFields);

        return back()->with('message', 'Event was confirmed successfully!');
    }

    // Unconfirm New Events Created by User
    public function unconfirm(Event $event) {
        $event->delete();
        return back()->with('message', 'Event was unconfirmed successfully!');
    }
}
