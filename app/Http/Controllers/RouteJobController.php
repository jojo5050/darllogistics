<?php

namespace App\Http\Controllers;

use App\Models\RouteJob;
use Exception;
use Illuminate\Http\Request;

class RouteJobController extends Controller
{
    public function index()
    {
        $routeJobs = RouteJob::paginate(30);
        return response()->json(['data' => $routeJobs, 'message' => 'Route jobs fetched successfully', 'status' => 'success'], 201);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'jobType' => 'required|in:pickup,delivery',
            'address' => 'nullable|string',
            'date' => 'nullable|date',
            'time' => 'nullable',
            'jobDescription' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'appointmentID' => 'nullable|string',
            'trailerType' => 'nullable|string',
            'loadingMethod' => 'nullable|string',
            'goodsDescription' => 'nullable|string',
            'rate' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'weightType' => 'nullable|string',
        ]);

        $routeJob = RouteJob::create($validated);

        return response()->json($routeJob, 201);
    }

    public function pickups()
    {
        try{
            $data = RouteJob::where('jobType', 'pickup')->paginate(30);

            if (!$data) {
                return response()->json(['status' => 'failed', 'message' => 'Route job not found'], 404);
            }

            return response()->json(['data' => $data, 'message' => 'Data fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function deliveries()
    {
        try{
            $data = RouteJob::where('jobType', 'delivery')->paginate(30);

            if (!$data) {
                return response()->json(['status' => 'failed', 'message' => 'Route job not found'], 404);
            }

            return response()->json(['data' => $data, 'message' => 'Data fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function show(RouteJob $routeJob)
    {
        return response()->json($routeJob);
    }

    public function update(Request $request, RouteJob $routeJob)
    {
        $validated = $request->validate([
            'jobType' => 'sometimes|in:pickup,delivery',
            'address' => 'sometimes|string',
            'date' => 'sometimes|date',
            'time' => 'sometimes',
            'jobDescription' => 'sometimes|string',
            'email' => 'sometimes|email',
            'phone' => 'sometimes|string',
            'appointmentID' => 'sometimes|string',
            'trailerType' => 'sometimes|string',
            'loadingMethod' => 'sometimes|string',
            'goodsDescription' => 'sometimes|string',
            'rate' => 'sometimes|numeric',
            'quantity' => 'sometimes|integer',
            'weightType' => 'sometimes|string',
        ]);

        $routeJob->update($validated);

        return response()->json($routeJob);
    }

    public function destroy(Request $request)
    {
        try{
            $routeJob = RouteJob::where('id', $request->id)->first();
            $routeJob->delete();
            return response()->json(['status' => 'success', 'message' => 'Route Job deleted'],201);
        }catch(Exception $e){
            return response()->json(['status' => 'success', 'message' => 'Error: '.$e->getMessage()],201);
        }
    }
}
