<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function index(Request $request)
    {
        if($request->query('driver_id'))
        {
            return $this->userPickups($request->query('driver_id'));
        }else{
            $pickups = Pickup::with(['load', 'driver'])->get();
            return response()->json($pickups);
        }
    }

    public function userPickups($driver_id)
    {
        $pickups = Pickup::where('driver_id', $driver_id)->get();

        if ($pickups->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No pickups found for this user.',
                'data' => [],
            ], 201);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Pickups retrieved successfully.',
            'data' => $pickups,
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'load_id' => 'required|exists:loads,id',
            'driver_id' => 'required|exists:users,id',
            'location' => 'required|string|max:255',
            'pickup_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $pickup = Pickup::create($validatedData);

        return response()->json(['message' => 'Pickup created successfully', 'data' => $pickup], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pickup = Pickup::with(['load', 'driver'])->findOrFail($id);
        return response()->json($pickup);
    }

    public function loads(Request $request)
    {
        $load_id = $request->load_id;
        try {
            $drop = Pickup::where('load_id', $load_id)->get();
            return response()->json(['data' => $drop, 'message' => 'Pickups fetched successfully for load', 'status' => 'success', 'code' => 1], 201);
        }catch(\Exception $e){
            return response()->json(['data' => [], 'message' => 'failed to fetch load pickups', 'status' => 'failed', 'code' => 0], 201);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pickup = Pickup::findOrFail($id);

        $validatedData = $request->validate([
            'load_id' => 'required|exists:loads,id',
            'driver_id' => 'required|exists:users,id',
            'location' => 'required|string|max:255',
            'pickup_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $pickup->update($validatedData);

        return response()->json(['message' => 'Pickup updated successfully', 'data' => $pickup]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pickup = Pickup::findOrFail($id);
        $pickup->delete();

        return response()->json(['message' => 'Pickup deleted successfully']);
    }
}
