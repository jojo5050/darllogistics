<?php

namespace App\Http\Controllers;

use App\Models\AssignedVehicle;
use Illuminate\Http\Request;

class AssignedVehicleController extends Controller
{
    public function index(Request $request)
    {
        if($request->query('driver_id'))
        {
            return $this->userVehicles($request->query('driver_id'));
        }else{
            try{
                $assignedVehicles = AssignedVehicle::with('driver')->get();
                return response()->json(['data'=>$assignedVehicles, 'message' => 'fetched assigned vehicles successfully', 'code' => 1, 'status' => 'success'], 201);
            } catch (\Exception $e) {
                return response()->json([
                    'code' => 0,
                    'status' => 'failed',
                    'message' => 'Failed to fetch assigned vehicles. Please try again.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }
    }

    public function userVehicles($driver_id)
    {
        try{

            $vehicles = AssignedVehicle::where('driver_id', $driver_id)->get();

            if ($vehicles->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No vehicles found for this user.',
                    'data' => [],
                ], 201);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Vehicles retrieved successfully.',
                'data' => $vehicles,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch assigned vehicles. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
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

        try{
            $assignedVehicle = AssignedVehicle::create($validatedData);

            return response()->json(['message' => 'Assigned Vehicle created successfully', 'code' => 1, 'status' => 'success', 'data' => $assignedVehicle], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to assign vehicle. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        try{
            $assignedVehicle = AssignedVehicle::with('driver')->findOrFail($id);
            return response()->json(['data'=>$assignedVehicle, 'message' => 'load created successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch assigned vehicle. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
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

        try{

            $assignedVehicle->update($validatedData);

            return response()->json(['message' => 'Assigned Vehicle updated successfully', 'code' => 1, 'status' => 'success', 'data' => $assignedVehicle], 201);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to update assigned vehicle. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        try{
            $assignedVehicle = AssignedVehicle::findOrFail($id);
            $assignedVehicle->delete();

            return response()->json(['message' => 'Assigned Vehicle deleted successfully', 'status' => 'success', 'code' => 1], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to delete assigned vehicle. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
