<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    // Appointment data that can be saved from the appointment form.
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'appointment_date',
        'appointment_time',
        'status',
        'problem',
    ];

    public function doctor()
    {
        // Each appointment belongs to one doctor.
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        // Each appointment belongs to one patient.
        return $this->belongsTo(Patient::class);
    }
}
