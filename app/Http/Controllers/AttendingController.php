<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Attending;
use Illuminate\Http\Request;

class AttendingController extends Controller
{
    // Confirm Payments
    public function confirm(Attending $attending) {
        $formFields['paid'] = 1;
        
        $attending->update($formFields);
        

        return back()->with('message', 'Event payment was confirmed successfully!');
    }

    // Remove From My Events
    public function remove(Event $event) {
        
        (Attending::where('user_id', auth()->user()->id)->where('event_id', $event->id)->first())->delete();
        
        return back()->with('message', 'The event was successfullt removed from your events!');
    }
}
