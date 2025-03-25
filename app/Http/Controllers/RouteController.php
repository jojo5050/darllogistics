<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\RouteJob;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function index()
    {
        try{
            $data = Route::with(['user', 'driver', 'jobs'])->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Routes fecthed successfully.',
                'data' => $data,
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function driverRoutes(Request $request)
    {
        try{
            $data = Route::where('driver_id', $request->driver_id)->with(['user', 'driver', 'jobs'])->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Driver assigned routes fecthed successfully.',
                'data' => $data,
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|string|max:225',
            'driver_id' => 'required|string|max:225',
            'route' => 'required|array',
            'route.*.jobType' => 'required|in:pickup,delivery',
            'route.*.address' => 'required|string|max:255',
            'route.*.date' => 'required|date',
            'route.*.time' => 'required|string',
            'route.*.jobDescription' => 'nullable|string',
            'route.*.email' => 'nullable|email',
            'route.*.phone' => 'nullable|string|max:20',
            'route.*.appointmentID' => 'nullable|string|max:50',
            'route.*.trailerType' => 'nullable|string|max:100',
            'route.*.loadingMethod' => 'nullable|string|max:100',
            'route.*.goodsDescription' => 'nullable|string',
            'route.*.rate' => 'nullable|numeric|min:0',
            'route.*.quantity' => 'nullable|integer|min:1',
            'route.*.weightType' => 'nullable|string|max:50',
        ]);

        // dd($validated);

        DB::beginTransaction();
        try {
            // Create the route entry
            $route = Route::create([
                'user_id' => $validated['user_id'],
                'vehicle_id' => $validated['vehicle_id'],
                'driver_id' => $validated['driver_id'],
            ]);

            // Create related jobs for this route
            foreach ($validated['route'] as $jobData) {
                $jobData['route_id'] = $route->id;
                RouteJob::create($jobData);
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Route and jobs created successfully',
                'data' => $route->load(['user', 'driver', 'jobs']) // Load jobs relationship
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'failed',
                'error' => 'Failed to create route',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Request $request)
    {
        try{
            $route = Route::where('id', $request->id)->first();
            $data = $route->load(['user', 'driver', 'jobs']);
            return response()->json(['data' => $data, 'message' => 'Data fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function pickup()
    {
        try{
            $data = Route::whereHas('routeJobs', function ($query) {
                $query->where('jobType', 'pickup');
            })->with('routeJobs')->get();

            return response()->json(['data' => $data, 'message' => 'Data fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function delivery()
    {
        try{
            $data = Route::whereHas('routeJobs', function ($query) {
                $query->where('jobType', 'delivery');
            })->with('routeJobs')->get();

            return response()->json(['data' => $data, 'message' => 'Data fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function update(Request $request, Route $route)
    {
        $validated = $request->validate([
            'vehicle_id' => 'sometimes|string',
            'driver_id' => 'sometimes|string',
        ]);

        $route->update($validated);

        return response()->json($route);
    }

    public function singleDelivery(Request $request)
    {
        try{
            $route = Route::where('id', $request->id)
                ->whereHas('routeJobs', function ($query) {
                    $query->where('jobType', 'delivery');
                })
                ->with('routeJobs')
                ->first();

            if (!$route) {
                return response()->json(['status' => 'failed', 'message' => 'Route not found or no deliveries'], 404);
            }

            return response()->json(['data' => $route, 'message' => 'Data fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function singlePickup(Request $request)
    {
        try{
            $route = Route::where('id', $request->id)
                ->whereHas('routeJobs', function ($query) {
                    $query->where('jobType', 'pickup');
                })
                ->with('routeJobs')
                ->first();

            if (!$route) {
                return response()->json(['status' => 'failed', 'message' => 'Route not found or no deliveries'], 404);
            }

            return response()->json(['data' => $route, 'message' => 'Data fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function destroy(Request $request)
    {
        $route = Route::where('id', $request->id)->first();
        $route->delete();
        return response()->json(['status' => 'success', 'message' => 'Route not found or no deliveries'], 204);
    }
}
