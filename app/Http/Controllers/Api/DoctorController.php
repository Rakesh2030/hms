<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index()
    {
        // New API CRUD: send doctors as JSON for AJAX table.
        $doctors = Doctor::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $doctors,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:doctors,email|unique:users,email',
            'specialization' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('Doctor');

        $doctor = Doctor::create($request->all() + ['user_id' => $user->id]);

        return response()->json([
            'status' => true,
            'message' => 'Doctor added successfully.',
            'data' => $doctor,
        ]);
    }

    public function show(Doctor $doctor)
    {
        return response()->json([
            'status' => true,
            'data' => $doctor,
        ]);
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'specialization' => 'required',
        ]);

        $doctor->update($request->all());

        if ($doctor->user) {
            $doctor->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Doctor updated successfully.',
            'data' => $doctor,
        ]);
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->user) {
            $doctor->user->delete();
        }

        $doctor->delete();

        return response()->json([
            'status' => true,
            'message' => 'Doctor deleted successfully.',
        ]);
    }
}
