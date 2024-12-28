<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return response()->json($vehicles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vehicleType' => 'nullable|string|max:225',
            'number' => 'nullable|string|max:225',
            'vin' => 'nullable|string|max:225',
            'plateNumber' => 'nullable|string|max:225',
            'status' => 'nullable|integer',
        ]);

        $vehicle = Vehicle::create($validatedData);

        return response()->json(['message' => 'Vehicle created successfully', 'vehicle' => $vehicle], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }

        return response()->json($vehicle);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }

        $validatedData = $request->validate([
            'vehicleType' => 'nullable|string|max:225',
            'number' => 'nullable|string|max:225',
            'vin' => 'nullable|string|max:225',
            'plateNumber' => 'nullable|string|max:225',
            'status' => 'nullable|integer',
        ]);

        $vehicle->update($validatedData);

        return response()->json(['message' => 'Vehicle updated successfully', 'vehicle' => $vehicle]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found'], 404);
        }

        $vehicle->delete();

        return response()->json(['message' => 'Vehicle deleted successfully']);
    }
}
