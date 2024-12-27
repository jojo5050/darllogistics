<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function index()
    {
        $pickups = Pickup::with(['load', 'driver'])->get();
        return response()->json($pickups);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'load_id' => 'required|exists:loads,id',
            'driver_id' => 'required|exists:users,id',
            'location' => 'required|string|max:255',
            'pickup_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $pickup = Pickup::create($validatedData);

        return response()->json(['message' => 'Pickup created successfully', 'data' => $pickup], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pickup = Pickup::with(['load', 'driver'])->findOrFail($id);
        return response()->json($pickup);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pickup = Pickup::findOrFail($id);

        $validatedData = $request->validate([
            'load_id' => 'required|exists:loads,id',
            'driver_id' => 'required|exists:users,id',
            'location' => 'required|string|max:255',
            'pickup_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $pickup->update($validatedData);

        return response()->json(['message' => 'Pickup updated successfully', 'data' => $pickup]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pickup = Pickup::findOrFail($id);
        $pickup->delete();

        return response()->json(['message' => 'Pickup deleted successfully']);
    }
}
