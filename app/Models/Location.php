<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'city',
        'zip',
        'country'
    ];

    // Relationship With Events
    public function events() {
        return $this->hasMany(Event::class);
    }
}
