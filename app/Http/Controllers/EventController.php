<?php

namespace App\Http\Controllers;

use App\Models\Attending;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    // Show All Events
    public function index() {
        return view('home', [
            'events' => Event::latest()->filter(request(['tag', 'search']))->paginate(6)
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
            'attendings' => Attending::all()
        ]);
    }

    // Add To My Events
    public function add(Attending $attending) {
        $formFields['attending'] = 1;

        $attending->update($formFields);

        return redirect('/')->with('message', 'Event added to my events successfully!');
    }

    // Show Create Form
    public function create() {
        return view('events.create');
    }

    // Store Event Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();
        // THIS HAVE TO BE DELETED
        $formFields['category_id'] = 1;
        $formFields['location_id'] = 1;

        Event::create($formFields);
        Attending::create($formFields);

        return redirect('/')->with('message', 'Event created successfully!');
    }

    // Show Edit Form
    public function edit(Event $event) {
        return view('events.edit', ['event' => $event]);
    }

    // Update Event
    public function update(Request $request, Event $event) {
        // Make sure logged in user is owner
        if($event->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'name' => 'required',
            'caterory_id' => 'required',
            'location_id' => 'required',
            'website' => ['required', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['confirmed'] = 0;

        $event->update($formFields);

        return back()->with('message', 'Event updated successfully!');
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
        return view('roles.manager.confirm', ['events' => Event::all()]);
    }

    // Confirm New Events Created by Users
    public function confirm(Event $event) {
        $formFields['confirmed'] = 1;

        $event->update($formFields);

        return back()->with('message', 'Event confirmed successfully!');
    }
}
