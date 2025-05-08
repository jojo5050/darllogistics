<?php

namespace App\Http\Controllers;

use App\Models\Bol;
use App\Models\ExtraFee;
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
            $data = Route::with(['user', 'company', 'dispatcher', 'driver', 'jobs', 'extraFees'])->paginate(30);
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

    public function deliveredRoutes(Request $request)
    {
        try{
            $data = Route::where('status', 'delivered')->with(['user', 'company', 'dispatcher', 'driver', 'jobs', 'extraFees'])->paginate(30);
            return response()->json([
                'status' => 'success',
                'message' => 'Delivered routes fecthed successfully.',
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

    public function pendingRoutes(Request $request)
    {
        try{
            $data = Route::where('status', 'pending')->with(['user', 'company', 'dispatcher', 'driver', 'jobs', 'extraFees'])->paginate(30);
            return response()->json([
                'status' => 'success',
                'message' => 'Pending routes fecthed successfully.',
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
            $data = Route::where('driver_id', $request->driver_id)->with(['driver', 'company', 'dispatcher', 'jobs', 'extraFees'])->paginate(30);
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
            'vehicle_id' => 'required|exists:vehicles,id',
            'company_id' => 'required|exists:companies,id',
            'driver_id' => 'required|exists:users,id',
            'dispatcher_id' => 'required|exists:users,id',
            'load_name' => 'required|string',
            'load_number' => 'required|string',
            'broker_name' => 'required|string',
            'broker_email' => 'required|email',
            'rate' => 'nullable|numeric|min:0',
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
            'route.*.quantity' => 'nullable|integer|min:1',
            'route.*.weightType' => 'nullable|string|max:50',
            'extra_fee' => 'array',
            'extra_fee.*.feeType' => 'nullable|string',
            'extra_fee.*.amount' => 'nullable|numeric|min:0',
        ]);

        // dd($validated);

        DB::beginTransaction();
        try {
            // Create the route entry
            $route = Route::create([
                'user_id' => $validated['user_id'],
                'vehicle_id' => $validated['vehicle_id'],
                'driver_id' => $validated['driver_id'],
                'company_id' => $validated['company_id'],
                'dispatcher_id' => $validated['dispatcher_id'],
                'load_name' => $validated['load_name'],
                'load_number' => $validated['load_number'],
                'broker_name' => $validated['broker_name'],
                'broker_email' => $validated['broker_email'],
                'rate' => $validated['rate'],
            ]);

            // Create related jobs for this route
            foreach ($validated['route'] as $jobData) {
                $jobData['route_id'] = $route->id;
                RouteJob::create($jobData);
            }

            // Create extra_fees for this route
            foreach ($validated['extra_fee'] as $extraFee) {
                $extraFee['route_id'] = $route->id;
                ExtraFee::create($extraFee);
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Route and jobs created successfully',
                'data' => $route->load(['user', 'dispatcher', 'driver', 'jobs', 'extraFees'])
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
            if (!$route) {
                return response()->json(['status' => 'failed', 'message' => 'Route not found'], 404);
            }
            $data = $route->load(['user', 'company', 'dispatcher', 'driver', 'jobs', 'extraFees']);
            return response()->json(['data' => $data, 'message' => 'Data fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function companyRoutes(Request $request)
    {
        try{
            $route = Route::where('company_id', $request->id)->paginate(30);
            if ($route->isEmpty()) {
                return response()->json(['status' => 'failed', 'message' => 'Routes not found'], 404);
            }
            $data = $route->load(['user', 'company', 'dispatcher', 'driver', 'jobs', 'extraFees']);
            return response()->json(['data' => $data, 'message' => 'Data fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function companyDeliveredRoutes(Request $request)
    {
        try{
            $route = Route::where('company_id', $request->id)->where('status', 'delivered')->paginate(30);
            if ($route->isEmpty()) {
                return response()->json(['status' => 'failed', 'message' => 'Routes not found'], 404);
            }
            $data = $route->load(['user', 'company', 'dispatcher', 'driver', 'jobs', 'extraFees']);
            return response()->json(['data' => $data, 'message' => 'Data fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function companyPendingRoutes(Request $request)
    {
        try{
            $route = Route::where('company_id', $request->id)->where('status', 'pending')->paginate(30);
            if ($route->isEmpty()) {
                return response()->json(['status' => 'failed', 'message' => 'Routes not found'], 404);
            }
            $data = $route->load(['user', 'company', 'dispatcher', 'driver', 'jobs', 'extraFees']);
            return response()->json(['data' => $data, 'message' => 'Data fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function dropRoute(Request $request)
    {
        try{
            $route = Route::find($request->id);
            if($route)
            {
                $route->status = 'delivered';
                $route->save();

                return response()->json(['data' => $route, 'message' => 'Route updated successfully', 'status' => 'success'], 201);
            }
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }

    }

    public function UploadBol(Request $request)
    {
        try{
            $validated = $request->validate([
                'company_id' => 'required|integer|exists:companies,id',
                'route_id' => 'required|integer|exists:routes,id',
                'driver_id' => 'required|integer|exists:users,id',
                'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $paths = [];

            foreach ($request->file('image') as $file) {
                $path = $file->store('bol/images', 'public');
                $paths[] = $path;
                $bol = new Bol();
                $bol->bol = $path;
                $bol->company_id = $request->company_d;
                $bol->user_id = $request->driver_id;
                $bol->route_id = $request->route_id;
                $bol->save();
            }

            $data = Bol::where('route_id', $request->route_id)->load(['route', 'user', 'company']);

            return response()->json([
                'message' => 'BOL file(s) uploaded successfully',
                'data' => $data,
                'files' => $paths,
                'status' => 'success'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'BOL file(s) upload failed. Error: '.$e->getMessage(),
                'status' => 'failed',
                'code' => 0,
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

    public function destroy(Request $request)
    {
        $route = Route::where('id', $request->id)->first();
        $route->delete();
        return response()->json(['status' => 'success', 'message' => 'Route not found or no deliveries'], 204);
    }
}
