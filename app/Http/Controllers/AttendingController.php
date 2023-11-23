<?php

namespace App\Http\Controllers;

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
}
