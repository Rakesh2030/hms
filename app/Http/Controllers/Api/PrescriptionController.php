<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        // New API CRUD: send prescriptions with doctor and patient data as JSON.
        $prescriptions = Prescription::with('doctor', 'patient')->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $prescriptions,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'medicines' => 'required',
            'prescription_date' => 'required|date',
        ]);

        $prescription = Prescription::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Prescription added successfully.',
            'data' => $prescription,
        ]);
    }

    public function show(Prescription $prescription)
    {
        $prescription->load('doctor', 'patient');

        return response()->json([
            'status' => true,
            'data' => $prescription,
        ]);
    }

    public function update(Request $request, Prescription $prescription)
    {
        $request->validate([
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'medicines' => 'required',
            'prescription_date' => 'required|date',
        ]);

        $prescription->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Prescription updated successfully.',
            'data' => $prescription,
        ]);
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();

        return response()->json([
            'status' => true,
            'message' => 'Prescription deleted successfully.',
        ]);
    }
}
