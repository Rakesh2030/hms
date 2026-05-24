<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // Room fields that can be saved from the room form.
    protected $fillable = [
        'room_number',
        'room_type',
        'floor',
        'price_per_day',
    ];

    public function beds()
    {
        // One room can contain many beds.
        return $this->hasMany(Bed::class);
    }
}
