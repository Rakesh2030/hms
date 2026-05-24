<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        // New API CRUD: send appointments with doctor and patient data as JSON.
        $appointments = Appointment::with('doctor', 'patient')->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $appointments,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'appointment_date' => 'required|date',
            'status' => 'required',
        ]);

        $appointment = Appointment::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Appointment added successfully.',
            'data' => $appointment,
        ]);
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('doctor', 'patient');

        return response()->json([
            'status' => true,
            'data' => $appointment,
        ]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'appointment_date' => 'required|date',
            'status' => 'required',
        ]);

        $appointment->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Appointment updated successfully.',
            'data' => $appointment,
        ]);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Appointment deleted successfully.',
        ]);
    }
}
