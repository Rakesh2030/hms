<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        // New API CRUD: send bills with patient data as JSON.
        $billings = Billing::with('patient')->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $billings,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'amount' => 'required|numeric',
            'payment_status' => 'required',
            'billing_date' => 'required|date',
        ]);

        $billing = Billing::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Bill added successfully.',
            'data' => $billing,
        ]);
    }

    public function show(Billing $billing)
    {
        $billing->load('patient');

        return response()->json([
            'status' => true,
            'data' => $billing,
        ]);
    }

    public function update(Request $request, Billing $billing)
    {
        $request->validate([
            'patient_id' => 'required',
            'amount' => 'required|numeric',
            'payment_status' => 'required',
            'billing_date' => 'required|date',
        ]);

        $billing->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Bill updated successfully.',
            'data' => $billing,
        ]);
    }

    public function destroy(Billing $billing)
    {
        $billing->delete();

        return response()->json([
            'status' => true,
            'message' => 'Bill deleted successfully.',
        ]);
    }
}
