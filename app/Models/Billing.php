<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    // Billing fields that can be saved from the billing form.
    protected $fillable = [
        'patient_id',
        'amount',
        'payment_status',
        'billing_date',
        'notes',
    ];

    public function patient()
    {
        // Each bill belongs to one patient.
        return $this->belongsTo(Patient::class);
    }
}
