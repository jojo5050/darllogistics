<?php

namespace App\Http\Controllers;

use App\Models\Drop;
use Illuminate\Http\Request;

class DropController extends Controller
{
    public function index(Request $request)
    {
        if($request->query('driver_id'))
        {
            return $this->userDrops($request->query('driver_id'));
        }else{
            $drops = Drop::with(['load', 'driver'])->get();
            return response()->json($drops);
        }
    }

    public function userDrops($driver_id)
    {
        $drops = Drop::where('driver_id', $driver_id)->get();

        if ($drops->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No drops found for this user.',
                'data' => [],
            ], 201);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Drops retrieved successfully.',
            'data' => $drops,
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
            'drop_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $drop = Drop::create($validatedData);

        return response()->json(['message' => 'Drop created successfully', 'data' => $drop], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $drop = Drop::with(['load', 'driver'])->findOrFail($id);
        return response()->json(['data' => $drop, 'status' => 'success', 'code' => 1], 201);
    }

    public function loads(Request $request)
    {
        $load_id = $request->load_id;
        try {
            $drop = Drop::where('load_id', $load_id)->get();
            return response()->json(['data' => $drop, 'message' => 'Drops fetched successfully for load', 'status' => 'success', 'code' => 1], 201);
        }catch(\Exception $e){
            return response()->json(['data' => [], 'message' => 'failed to fetch load drops', 'status' => 'failed', 'code' => 0], 201);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $drop = Drop::findOrFail($id);

        $validatedData = $request->validate([
            'load_id' => 'required|exists:loads,id',
            'driver_id' => 'required|exists:users,id',
            'location' => 'required|string|max:255',
            'drop_time' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $drop->update($validatedData);

        return response()->json(['message' => 'Drop updated successfully', 'data' => $drop]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $drop = Drop::findOrFail($id);
        $drop->delete();

        return response()->json(['message' => 'Drop deleted successfully']);
    }
}
