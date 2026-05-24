<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    // This web controller now mainly opens Blade pages.
    // Old normal CRUD store/update/delete code is kept below for interview explanation.
    // New API CRUD code is inside app/Http/Controllers/Api/PrescriptionController.php.

    public function index()
    {
        $prescriptions = Prescription::with('doctor', 'patient')->latest()->get();
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('prescriptions.create', compact('doctors', 'patients'));
    }

    public function store(Request $request)
    {
        // Old normal CRUD code: form submitted directly to this controller.
        $request->validate([
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'medicines' => 'required',
            'prescription_date' => 'required|date',
        ]);

        Prescription::create($request->all());
        return redirect()->route('prescriptions.index')->with('success', 'Prescription added successfully.');
    }

    public function show(Prescription $prescription)
    {
        return view('prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('prescriptions.edit', compact('prescription', 'doctors', 'patients'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        // Old normal CRUD code: update happened directly from the Blade form.
        $request->validate([
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'medicines' => 'required',
            'prescription_date' => 'required|date',
        ]);

        $prescription->update($request->all());
        return redirect()->route('prescriptions.index')->with('success', 'Prescription updated successfully.');
    }

    public function destroy(Prescription $prescription)
    {
        // Old normal CRUD code: delete happened directly from a web form.
        $prescription->delete();
        return redirect()->route('prescriptions.index')->with('success', 'Prescription deleted successfully.');
    }
}
