<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\BedAllotment;
use App\Models\Patient;
use Illuminate\Http\Request;

class BedAllotmentController extends Controller
{
    // This web controller now mainly opens Blade pages.
    // Old normal CRUD store/update/delete code is kept below for interview explanation.
    // New API CRUD code is inside app/Http/Controllers/Api/BedAllotmentController.php.

    public function index()
    {
        $bedAllotments = BedAllotment::with('bed.room', 'patient')->latest()->get();
        return view('bed-allotments.index', compact('bedAllotments'));
    }

    public function create()
    {
        $beds = Bed::where('status', 'available')->get();
        $patients = Patient::all();
        return view('bed-allotments.create', compact('beds', 'patients'));
    }

    public function store(Request $request)
    {
        // Old normal CRUD code: form submitted directly to this controller.
        $request->validate([
            'bed_id' => 'required',
            'patient_id' => 'required',
            'allotment_date' => 'required|date',
        ]);

        BedAllotment::create([
            'bed_id' => $request->bed_id,
            'patient_id' => $request->patient_id,
            'allotment_date' => $request->allotment_date,
            'discharge_date' => $request->discharge_date,
            'status' => 'admitted',
        ]);

        $bed = Bed::find($request->bed_id);
        $bed->status = 'occupied';
        $bed->save();

        return redirect()->route('bed-allotments.index')->with('success', 'Bed allotted successfully.');
    }

    public function show(BedAllotment $bedAllotment)
    {
        return view('bed-allotments.show', compact('bedAllotment'));
    }

    public function edit(BedAllotment $bedAllotment)
    {
        $beds = Bed::where('status', 'available')->orWhere('id', $bedAllotment->bed_id)->get();
        $patients = Patient::all();
        return view('bed-allotments.edit', compact('bedAllotment', 'beds', 'patients'));
    }

    public function update(Request $request, BedAllotment $bedAllotment)
    {
        // Old normal CRUD code: update happened directly from the Blade form.
        $request->validate([
            'bed_id' => 'required',
            'patient_id' => 'required',
            'allotment_date' => 'required|date',
            'status' => 'required',
        ]);

        if ($bedAllotment->bed_id != $request->bed_id) {
            $oldBed = Bed::find($bedAllotment->bed_id);
            $oldBed->status = 'available';
            $oldBed->save();
        }

        $bedAllotment->update($request->all());

        $bed = Bed::find($request->bed_id);
        if ($request->status == 'discharged') {
            $bed->status = 'available';
        } else {
            $bed->status = 'occupied';
        }
        $bed->save();

        return redirect()->route('bed-allotments.index')->with('success', 'Bed allotment updated successfully.');
    }

    public function destroy(BedAllotment $bedAllotment)
    {
        // Old normal CRUD code: delete happened directly from a web form.
        $bed = Bed::find($bedAllotment->bed_id);
        if ($bed) {
            $bed->status = 'available';
            $bed->save();
        }

        $bedAllotment->delete();
        return redirect()->route('bed-allotments.index')->with('success', 'Bed allotment deleted successfully.');
    }
}
