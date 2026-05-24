<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index()
    {
        // New API CRUD: send patients as JSON for AJAX table.
        $patients = Patient::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $patients,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients,email|unique:users,email',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('Patient');

        $patient = Patient::create($request->all() + ['user_id' => $user->id]);

        return response()->json([
            'status' => true,
            'message' => 'Patient added successfully.',
            'data' => $patient,
        ]);
    }

    public function show(Patient $patient)
    {
        return response()->json([
            'status' => true,
            'data' => $patient,
        ]);
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients,email,' . $patient->id,
        ]);

        $patient->update($request->all());

        if ($patient->user) {
            $patient->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Patient updated successfully.',
            'data' => $patient,
        ]);
    }

    public function destroy(Patient $patient)
    {
        if ($patient->user) {
            $patient->user->delete();
        }

        $patient->delete();

        return response()->json([
            'status' => true,
            'message' => 'Patient deleted successfully.',
        ]);
    }
}
