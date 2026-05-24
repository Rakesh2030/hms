<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\BedAllotment;
use Illuminate\Http\Request;

class BedAllotmentController extends Controller
{
    public function index()
    {
        // New API CRUD: send bed allotments with bed, room and patient data as JSON.
        $bedAllotments = BedAllotment::with('bed.room', 'patient')->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $bedAllotments,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bed_id' => 'required',
            'patient_id' => 'required',
            'allotment_date' => 'required|date',
        ]);

        $bedAllotment = BedAllotment::create([
            'bed_id' => $request->bed_id,
            'patient_id' => $request->patient_id,
            'allotment_date' => $request->allotment_date,
            'discharge_date' => $request->discharge_date,
            'status' => 'admitted',
        ]);

        $bed = Bed::find($request->bed_id);
        if ($bed) {
            $bed->status = 'occupied';
            $bed->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Bed allotted successfully.',
            'data' => $bedAllotment,
        ]);
    }

    public function show(BedAllotment $bedAllotment)
    {
        $bedAllotment->load('bed.room', 'patient');

        return response()->json([
            'status' => true,
            'data' => $bedAllotment,
        ]);
    }

    public function update(Request $request, BedAllotment $bedAllotment)
    {
        $request->validate([
            'bed_id' => 'required',
            'patient_id' => 'required',
            'allotment_date' => 'required|date',
            'status' => 'required',
        ]);

        if ($bedAllotment->bed_id != $request->bed_id) {
            $oldBed = Bed::find($bedAllotment->bed_id);
            if ($oldBed) {
                $oldBed->status = 'available';
                $oldBed->save();
            }
        }

        $bedAllotment->update($request->all());

        $bed = Bed::find($request->bed_id);
        if ($bed) {
            if ($request->status == 'discharged') {
                $bed->status = 'available';
            } else {
                $bed->status = 'occupied';
            }
            $bed->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Bed allotment updated successfully.',
            'data' => $bedAllotment,
        ]);
    }

    public function destroy(BedAllotment $bedAllotment)
    {
        $bed = Bed::find($bedAllotment->bed_id);
        if ($bed) {
            $bed->status = 'available';
            $bed->save();
        }

        $bedAllotment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Bed allotment deleted successfully.',
        ]);
    }
}
