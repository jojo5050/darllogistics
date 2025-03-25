<?php

namespace App\Http\Controllers;

use App\Models\RouteJob;
use Illuminate\Http\Request;

class RouteJobController extends Controller
{
    public function index()
    {
        return response()->json(RouteJob::all());
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

    public function destroy(RouteJob $routeJob)
    {
        $routeJob->delete();
        return response()->json(null, 204);
    }
}
