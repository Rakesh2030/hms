<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use Illuminate\Http\Request;

class BedController extends Controller
{
    public function index()
    {
        // New API CRUD: send beds with room data as JSON for AJAX table.
        $beds = Bed::with('room')->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $beds,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'bed_number' => 'required',
            'status' => 'required',
        ]);

        $bed = Bed::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Bed added successfully.',
            'data' => $bed,
        ]);
    }

    public function show(Bed $bed)
    {
        $bed->load('room');

        return response()->json([
            'status' => true,
            'data' => $bed,
        ]);
    }

    public function update(Request $request, Bed $bed)
    {
        $request->validate([
            'room_id' => 'required',
            'bed_number' => 'required',
            'status' => 'required',
        ]);

        $bed->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Bed updated successfully.',
            'data' => $bed,
        ]);
    }

    public function destroy(Bed $bed)
    {
        $bed->delete();

        return response()->json([
            'status' => true,
            'message' => 'Bed deleted successfully.',
        ]);
    }
}
