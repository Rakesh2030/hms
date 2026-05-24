<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    // This web controller now mainly opens Blade pages.
    // Old normal CRUD store/update/delete code is kept below for interview explanation.
    // New API CRUD code is inside app/Http/Controllers/Api/DoctorController.php.

    public function index()
    {
        $doctors = Doctor::latest()->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        // Old normal CRUD code: form submitted directly to this controller.
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

        Doctor::create($request->all() + ['user_id' => $user->id]);

        return redirect()->route('doctors.index')->with('success', 'Doctor added successfully.');
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        // Old normal CRUD code: update happened directly from the Blade form.
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

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        // Old normal CRUD code: delete happened directly from a web form.
        if ($doctor->user) {
            $doctor->user->delete();
        }

        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
