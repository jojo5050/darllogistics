<?php

namespace App\Http\Controllers;

use App\Models\DriversLog;
use Illuminate\Http\Request;

class DriversLogController extends Controller
{
    public function index()
    {
        $driversLogs = DriversLog::all();
        return response()->json($driversLogs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'driver_id' => 'nullable|exists:drivers,id',
            'rate_confirmation_id' => 'nullable|string|unique:drivers_logs',
            'rate_confirmation' => 'nullable|string|unique:drivers_logs',
            'date_uploaded' => 'nullable|date',
            'time_uploaded' => 'nullable|date_format:H:i:s',
            'uploaded_by' => 'nullable|exists:users,id',
            'status' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        $driversLog = DriversLog::create($validatedData);

        return response()->json(['message' => 'Drivers log created successfully', 'data' => $driversLog], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $driversLog = DriversLog::findOrFail($id);
        return response()->json($driversLog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $driversLog = DriversLog::findOrFail($id);

        $validatedData = $request->validate([
            'driver_id' => 'nullable|exists:drivers,id',
            'rate_confirmation_id' => 'nullable|string|unique:drivers_logs,rate_confirmation_id,' . $driversLog->id,
            'rate_confirmation' => 'nullable|string|unique:drivers_logs,rate_confirmation,' . $driversLog->id,
            'date_uploaded' => 'nullable|date',
            'time_uploaded' => 'nullable|date_format:H:i:s',
            'uploaded_by' => 'nullable|exists:users,id',
            'status' => 'required|boolean',
            'comment' => 'nullable|string',
        ]);

        $driversLog->update($validatedData);

        return response()->json(['message' => 'Drivers log updated successfully', 'data' => $driversLog]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $driversLog = DriversLog::findOrFail($id);
        $driversLog->delete();

        return response()->json(['message' => 'Drivers log deleted successfully']);
    }
}
