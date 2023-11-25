<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Comment;
use App\Models\Attending;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store Comment
    public function store(Request $request, Event $event) {
        
        // Adding a comment after the end of event
        if($event->end > date("Y-m-d H:i:s")) {
            return back()->with('err', 'You cannot add comment since the event has not ended!');
        }

        // Adding a comment just for users that attended
        $attending = Attending::where('event_id', $event->id)->where('user_id', auth()->user()->id)->first();
        if(!$attending) {
            return back()->with('err', 'You cannot add comment to the event you did not attend!');
        }
        
        $formFields = $request->validate([
            'content' => 'required|max:200'
        ]);

        $formFields['user_id'] = auth()->id();
        $formFields['event_id'] = $event->id;

        $comment = Comment::create($formFields);       

        return redirect()->route('event.show', ['event' => $event])->with('message', 'Comment added successfully!');
    }

    // Delete Comment
    public function delete(Comment $comment) {
        if($comment->user_id != auth()->user()->id) {
            back()->with('err', 'You cannot delete comment that is not yours!');
        }

        $comment->delete();
        return back()->with('message', 'Category was unconfirmed successfully!');
    }
}
