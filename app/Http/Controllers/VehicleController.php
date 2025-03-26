<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        try{
            $vehicles = Vehicle::all();
            return response()->json(['message' => 'Vehicle registered successfully', 'data' => $vehicles, 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to register vehicle. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
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

        try{
            $vehicle = Vehicle::create($validatedData);
            return response()->json(['message' => 'Vehicle registered successfully', 'data' => $vehicle, 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to register vehicle. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found', 'data' => [], 'code' => 1, 'status' => 'success'], 201);
        }

        try{
            return response()->json(['message' => 'Vehicle fetched successfully', 'data' => $vehicle, 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch vehicle. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }

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
            return response()->json(['message' => 'Vehicle not found', 'data' => [], 'code' => 0, 'status' => 'failed'], 404);
        }

        $validatedData = $request->validate([
            'vehicleType' => 'nullable|string|max:225',
            'number' => 'nullable|string|max:225',
            'vin' => 'nullable|string|max:225',
            'plateNumber' => 'nullable|string|max:225',
            'status' => 'nullable|integer',
        ]);

        try{
            $vehicle->update($validatedData);
            return response()->json(['message' => 'Vehicle updated successfully', 'data' => $vehicle, 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to update vehicle. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Vehicle not found', 'data' => [], 'code' => 0, 'status' => 'failed'], 404);
        }

        try{
            $vehicle->delete();
            return response()->json(['message' => 'Vehicle deleted successfully', 'data' => $vehicle, 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to delete vehicle. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
