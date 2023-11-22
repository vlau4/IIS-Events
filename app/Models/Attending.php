<?php

namespace App\Models;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attending extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id'
    ];

    // // Relationship To User
    // public function user() {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    // // Relationship To Event
    // public function event() {
    //     return $this->belongsTo(Event::class, 'event_id');
    // }
}
