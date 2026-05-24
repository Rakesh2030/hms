<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Room;
use Illuminate\Http\Request;

class BedController extends Controller
{
    // This web controller now mainly opens Blade pages.
    // Old normal CRUD store/update/delete code is kept below for interview explanation.
    // New API CRUD code is inside app/Http/Controllers/Api/BedController.php.

    public function index()
    {
        $beds = Bed::with('room')->latest()->get();
        return view('beds.index', compact('beds'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('beds.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        // Old normal CRUD code: form submitted directly to this controller.
        $request->validate([
            'room_id' => 'required',
            'bed_number' => 'required',
            'status' => 'required',
        ]);

        Bed::create($request->all());
        return redirect()->route('beds.index')->with('success', 'Bed added successfully.');
    }

    public function show(Bed $bed)
    {
        return view('beds.show', compact('bed'));
    }

    public function edit(Bed $bed)
    {
        $rooms = Room::all();
        return view('beds.edit', compact('bed', 'rooms'));
    }

    public function update(Request $request, Bed $bed)
    {
        // Old normal CRUD code: update happened directly from the Blade form.
        $request->validate([
            'room_id' => 'required',
            'bed_number' => 'required',
            'status' => 'required',
        ]);

        $bed->update($request->all());
        return redirect()->route('beds.index')->with('success', 'Bed updated successfully.');
    }

    public function destroy(Bed $bed)
    {
        // Old normal CRUD code: delete happened directly from a web form.
        $bed->delete();
        return redirect()->route('beds.index')->with('success', 'Bed deleted successfully.');
    }
}
