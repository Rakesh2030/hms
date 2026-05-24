<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    // These fields can be saved using Doctor::create() or $doctor->update().
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'specialization',
        'qualification',
        'address',
    ];

    public function user()
    {
        // One doctor profile belongs to one login user.
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        // One doctor can have many appointments.
        return $this->hasMany(Appointment::class);
    }

    public function prescriptions()
    {
        // One doctor can write many prescriptions.
        return $this->hasMany(Prescription::class);
    }
}
