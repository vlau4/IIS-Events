<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store Comment
    public function store(Request $request, Event $event) {

        $formFields = $request->validate([
            'content' => 'required|max:200'
        ]);

        $formFields['user_id'] = auth()->id();
        $formFields['event_id'] = $event->id;

        $comment = Comment::create($formFields);       

        return redirect()->route('event.show', ['event' => $event])->with('message', 'Comment added successfully!');
    }
}
