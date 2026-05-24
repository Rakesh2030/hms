<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BedAllotment extends Model
{
    // Bed allotment fields that can be saved from the allotment form.
    protected $fillable = [
        'bed_id',
        'patient_id',
        'allotment_date',
        'discharge_date',
        'status',
    ];

    public function bed()
    {
        // Each allotment belongs to one bed.
        return $this->belongsTo(Bed::class);
    }

    public function patient()
    {
        // Each allotment belongs to one patient.
        return $this->belongsTo(Patient::class);
    }
}
