<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // These fields can be saved using Patient::create() or $patient->update().
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'age',
        'gender',
        'blood_group',
        'address',
    ];

    public function user()
    {
        // One patient profile belongs to one login user.
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        // One patient can have many appointments.
        return $this->hasMany(Appointment::class);
    }

    public function billings()
    {
        // One patient can have many bills.
        return $this->hasMany(Billing::class);
    }
}
