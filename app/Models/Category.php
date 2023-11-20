<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent',
        'position',
        'confirmed'
    ];

    // Relationship With Events
    public function events() {
        return $this->hasMany(Event::class);
    }
}
