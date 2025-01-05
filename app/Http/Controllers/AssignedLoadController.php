<?php

namespace App\Http\Controllers;

use App\Models\AssignedLoad;
use Illuminate\Http\Request;

class AssignedLoadController extends Controller
{
    public function index(Request $request)
    {
        if($request->query('driver_id'))
        {
            return $this->userLoads($request->query('driver_id'));
        }else{

            try{
                return response()->json(['data'=> AssignedLoad::with(['_load', 'driver'])->get(), 'message' => 'Fetched assigned loads successfully', 'code' => 1, 'status' => 'success'], 201);
            } catch (\Exception $e) {
                return response()->json([
                    'code' => 0,
                    'status' => 'failed',
                    'message' => 'Failed to fetch assigned loads. Please try again.',
                    'error' => $e->getMessage(),
                ], 500);
            }

        }
    }

    public function userLoads($driver_id)
    {

        try{

            $loads = AssignedLoad::where('driver_id', $driver_id)->get();

            if ($loads->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'code' => 1,
                    'message' => 'No assigned loads found for this user.',
                    'data' => [],
                ], 201);
            }

            return response()->json([
                'status' => 'success',
                'code' => 1,
                'message' => 'Assigned loads retrieved successfully.',
                'data' => $loads,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch driver loads. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $assignedLoad = AssignedLoad::find($id);
        try{
            return response()->json(['data' => $assignedLoad->load(['_load', 'driver']), 'message' => 'Fetched assigned load successfully',  'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch driver assigned load. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'load_id' => 'required|exists:loads,id',
            'driver_id' => 'required|exists:users,id',
            'date_assigned' => 'required|date',
            'status' => 'nullable|integer',
        ]);

        try{

            $AssignedLoad = AssignedLoad::create($data);
            return response()->json(['data' => $AssignedLoad, 'message' => 'Successfully assigned load to driver', 'code' => 1, 'status' => 'success'], 201);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to create assigned load. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $assignedLoad = AssignedLoad::find($id);
        $data = $request->validate([
            'load_id' => 'exists:loads,id',
            'driver_id' => 'exists:users,id',
            'date_assigned' => 'date',
            'status' => 'nullable|integer',
        ]);

        try{
            $assignedLoad->update($data);
            return response()->json(['data' => $assignedLoad, 'message' => 'Successfully updated driver assigned load', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to update driver assigned load. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $assignedLoad = AssignedLoad::find($id);
        try{
            $assignedLoad->delete();
            return response()->json(['message' => 'Load assignment deleted successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to delete driver assigned load. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
