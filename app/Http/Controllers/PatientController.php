<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    // This web controller now mainly opens Blade pages.
    // Old normal CRUD store/update/delete code is kept below for interview explanation.
    // New API CRUD code is inside app/Http/Controllers/Api/PatientController.php.

    public function index()
    {
        // Get all patients from database and show them in table.
        $patients = Patient::latest()->get();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        // Old normal CRUD code: form submitted directly to this controller.
        // Validate patient details before saving.
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients,email|unique:users,email',
        ]);

        // Create login user for patient with default password.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('Patient');

        // Save patient profile and connect it with login user.
        Patient::create($request->all() + ['user_id' => $user->id]);

        return redirect()->route('patients.index')->with('success', 'Patient added successfully.');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        // Old normal CRUD code: update happened directly from the Blade form.
        // Validate and update selected patient record.
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

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        // Old normal CRUD code: delete happened directly from a web form.
        // Delete patient login user first, then delete patient profile.
        if ($patient->user) {
            $patient->user->delete();
        }

        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }
}
