<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        // New API CRUD: send rooms as JSON for AJAX table.
        $rooms = Room::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $rooms,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number',
            'room_type' => 'required',
            'price_per_day' => 'required|numeric',
        ]);

        $room = Room::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Room added successfully.',
            'data' => $room,
        ]);
    }

    public function show(Room $room)
    {
        return response()->json([
            'status' => true,
            'data' => $room,
        ]);
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $room->id,
            'room_type' => 'required',
            'price_per_day' => 'required|numeric',
        ]);

        $room->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Room updated successfully.',
            'data' => $room,
        ]);
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json([
            'status' => true,
            'message' => 'Room deleted successfully.',
        ]);
    }
}
