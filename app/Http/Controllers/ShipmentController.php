<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::all();
        return response()->json($shipments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tracking_number' => 'required|string|unique:shipments,tracking_number',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'status' => 'nullable|string|in:pending,in_transit,delivered,cancelled',
            'weight' => 'nullable|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'driver_id' => 'nullable|exists:drivers,id',
        ]);

        $shipment = Shipment::create($validatedData);

        return response()->json(['message' => 'Shipment created successfully', 'data' => $shipment], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $shipment = Shipment::findOrFail($id);
        return response()->json($shipment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $shipment = Shipment::findOrFail($id);

        $validatedData = $request->validate([
            'tracking_number' => 'nullable|string|unique:shipments,tracking_number,' . $id,
            'origin' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:pending,in_transit,delivered,cancelled',
            'weight' => 'nullable|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'driver_id' => 'nullable|exists:drivers,id',
        ]);

        $shipment->update($validatedData);

        return response()->json(['message' => 'Shipment updated successfully', 'data' => $shipment]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $shipment = Shipment::findOrFail($id);
        $shipment->delete();

        return response()->json(['message' => 'Shipment deleted successfully']);
    }
}
