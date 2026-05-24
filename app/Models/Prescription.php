<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    // Prescription form fields that are allowed for mass assignment.
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'medicines',
        'notes',
        'prescription_date',
    ];

    public function doctor()
    {
        // Each prescription is written by one doctor.
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        // Each prescription is for one patient.
        return $this->belongsTo(Patient::class);
    }
}
