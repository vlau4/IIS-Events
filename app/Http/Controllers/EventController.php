<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use App\Models\Location;
use App\Models\Attending;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    // Show All Events
    public function index() {
        return view('home', [
            'events' => Event::where('confirmed', '1')->latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show Single Event
    public function show(Event $event) {
        return view('events.show', [
            'event' => $event
        ]);
    }

    // Show My Events
    public function showMyEvents() {
        return view('roles.user.myEvents', [
            'events' => Event::latest()->paginate(6),
            'attendings' => Attending::where('user_id', auth()->id())->get()
        ]);
    }

    // Add To My Events
    public function add(Event $event) {
        $attending = Attending::where('user_id', auth()->id())->where('event_id', $event->id)->first();

        $formFields['attending'] = 1;

        $attending->update($formFields);

        return redirect('/events/mine')->with('message', 'Event added to my events successfully!');
    }

    // Show Create Form
    public function create() {
        return view('events.create', [
            'categories' => Category::all(),
            'locations' => Location::all()
        ]);
    }

    // Store Event Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'location_id' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
            'capacity' => 'required',
            'entry_fee' => 'nullable',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        $event = Event::create($formFields);
        $formFields['event_id'] = $event->id;

        $users = User::all();

        // for every user create attending to the new event
        foreach($users as $user) {
            $formFields['user_id'] = $user->id;
            Attending::create($formFields);
        }

        return redirect('/')->with('message', 'Event created successfully!');
    }

    // Show Edit Form
    public function edit(Event $event) {
        return view('events.edit', [
            'event' => $event,
            'categories' => Category::all(),
            'locations' => Location::all()
        ]);
    }

    // Update Event
    public function update(Request $request, Event $event) {

        // Make sure logged in user is owner
        if($event->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'location_id' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
            'capacity' => 'required',
            'entry_fee' => 'nullable',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['confirmed'] = 0;

        $event->update($formFields);

        return redirect('/')->with('message', 'Event updated successfully!');
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
        return view('events.manage', ['events' => request()->user()->events()->get()]);
    }

    // Show Confirm Section
    public function showConfirm(Event $event) {
        // TODO: where confirm == 0
        return view('roles.manager.confirm', ['events' => Event::all()]);
    }

    // Confirm New Events Created by Users
    public function confirm(Event $event) {
        $formFields['confirmed'] = 1;

        $event->update($formFields);

        return back()->with('message', 'Event confirmed successfully!');
    }
}
