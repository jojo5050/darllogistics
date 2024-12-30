<?php

namespace App\Http\Controllers;

use App\Models\AssignedLoad;
use Illuminate\Http\Request;

class AssignedLoadController extends Controller
{
    public function index()
    {
        return response()->json(AssignedLoad::with(['load', 'driver'])->get());
    }

    public function userLoads(Request $request)
    {
        $validatedData = $request->validate([
            'driver_id' => 'required|exists:users,id',
        ]);

        $loads = AssignedLoad::where('driver_id', $validatedData['driver_id'])->get();

        if ($loads->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No assigned loads found for this user.',
                'data' => [],
            ], 201);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Assigned loads retrieved successfully.',
            'data' => $loads,
        ], 201);
    }

    public function show(AssignedLoad $assignedLoad)
    {
        return response()->json($assignedLoad->load(['load', 'driver']));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'load_id' => 'required|exists:loads,id',
            'driver_id' => 'required|exists:users,id',
            'date_assigned' => 'required|date',
            'status' => 'nullable|integer',
        ]);

        $AssignedLoad = AssignedLoad::create($data);
        return response()->json($AssignedLoad, 201);
    }

    public function update(Request $request, AssignedLoad $assignedLoad)
    {
        $data = $request->validate([
            'load_id' => 'exists:loads,id',
            'driver_id' => 'exists:users,id',
            'date_assigned' => 'date',
            'status' => 'nullable|integer',
        ]);

        $assignedLoad->update($data);
        return response()->json($assignedLoad);
    }

    public function destroy(AssignedLoad $assignedLoad)
    {
        $assignedLoad->delete();
        return response()->json(['message' => 'Load assignment deleted successfully']);
    }
}
