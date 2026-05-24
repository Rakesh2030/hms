<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    // Bed fields that can be saved from the bed form.
    protected $fillable = [
        'room_id',
        'bed_number',
        'status',
    ];

    public function room()
    {
        // Each bed belongs to one room.
        return $this->belongsTo(Room::class);
    }

    public function bedAllotments()
    {
        // One bed can be allotted many times over time.
        return $this->hasMany(BedAllotment::class);
    }
}
