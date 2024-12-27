<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        return response()->json($drivers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'license' => 'nullable|string|max:50',
            'license_expiry' => 'nullable|date',
            'email' => 'nullable|email|unique:drivers',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        $driver = Driver::create($validatedData);

        return response()->json(['message' => 'Driver created successfully', 'data' => $driver], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $driver = Driver::findOrFail($id);
        return response()->json($driver);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'license' => 'nullable|string|max:50',
            'license_expiry' => 'nullable|date',
            'email' => 'nullable|email|unique:drivers,email,' . $driver->id,
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        $driver->update($validatedData);

        return response()->json(['message' => 'Driver updated successfully', 'data' => $driver]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return response()->json(['message' => 'Driver deleted successfully']);
    }
}
