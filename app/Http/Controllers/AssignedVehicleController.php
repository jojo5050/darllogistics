<?php

namespace App\Http\Controllers;

use App\Models\AssignedVehicle;
use Illuminate\Http\Request;

class AssignedVehicleController extends Controller
{
    public function index()
    {
        $assignedVehicles = AssignedVehicle::with('driver')->get();
        return response()->json($assignedVehicles);
    }

    public function userVehicles(Request $request)
    {
        $validatedData = $request->validate([
            'driver_id' => 'required|exists:users,id',
        ]);

        $vehicles = AssignedVehicle::where('driver_id', $validatedData['driver_id'])->get();

        if ($vehicles->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No vehicles found for this user.',
                'data' => [],
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Vehicles retrieved successfully.',
            'data' => $vehicles,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'driver_id' => 'required|exists:users,id',
            'date_assigned' => 'required|date',
            'status' => 'nullable|integer',
            'dropped_date' => 'required|date',
            'load_id' => 'required|integer',
            'layover' => 'nullable|string',
            'layover_amount' => 'nullable|numeric',
            'payment_status' => 'nullable|integer',
            'payroll_status' => 'nullable|integer',
            'truck' => 'nullable|string',
            'trailer' => 'nullable|string',
            'tractor' => 'nullable|string',
        ]);

        $assignedVehicle = AssignedVehicle::create($validatedData);

        return response()->json(['message' => 'Assigned Vehicle created successfully', 'data' => $assignedVehicle], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $assignedVehicle = AssignedVehicle::with('driver')->findOrFail($id);
        return response()->json($assignedVehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $assignedVehicle = AssignedVehicle::findOrFail($id);

        $validatedData = $request->validate([
            'driver_id' => 'required|exists:users,id',
            'date_assigned' => 'required|date',
            'status' => 'nullable|integer',
            'dropped_date' => 'required|date',
            'load_id' => 'required|integer',
            'layover' => 'nullable|string',
            'layover_amount' => 'nullable|numeric',
            'payment_status' => 'nullable|integer',
            'payroll_status' => 'nullable|integer',
            'truck' => 'nullable|string',
            'trailer' => 'nullable|string',
            'tractor' => 'nullable|string',
        ]);

        $assignedVehicle->update($validatedData);

        return response()->json(['message' => 'Assigned Vehicle updated successfully', 'data' => $assignedVehicle]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $assignedVehicle = AssignedVehicle::findOrFail($id);
        $assignedVehicle->delete();

        return response()->json(['message' => 'Assigned Vehicle deleted successfully']);
    }
}
