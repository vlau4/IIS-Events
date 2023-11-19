<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'location_id',
        'start',
        'end',
        'capacity',
        'entry_fee',
        'tags',
        'logo',
        'description',
        'confirmed',
        'user_id'
    ];

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orwhere('tags', 'like', '%' . request('search') . '%')
                ->orwhere('description', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship To Category
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relationship To Location
    public function location() {
        return $this->belongsTo(Location::class, 'location_id');
    }

    // Relationship With Attendings
    public function attendings() {
        return $this->hasMany(Attending::class, 'event_id');
    }

    // Relationship To Comments
    public function comments() {
        return $this->hasMany(Comment::class, 'event_id');
    }
}