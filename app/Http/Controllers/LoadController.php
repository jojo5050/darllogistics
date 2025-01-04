<?php

namespace App\Http\Controllers;

use App\Models\Load;
use Illuminate\Http\Request;

class LoadController extends Controller
{
    public function index()
    {
        try{
            return response()->json(['data'=>Load::paginate(30), 'message' => 'load created successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch loads. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Request $request)
    {
        $load = Load::find($request->load_id);
        try{
            return response()->json(['data'=>$load, 'message' => 'load fetched successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch load. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'nullable|string',
            'pickup_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'weight' => 'nullable|numeric',
        ]);
        try{
            $load = Load::create($data);
            return response()->json(['data'=>$load, 'message' => 'load created successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to create load. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $load = Load::find($request->load_id);
        $data = $request->validate([
            'description' => 'nullable|string',
            'pickup_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'weight' => 'nullable|numeric',
        ]);
        try{
            $load->update($data);
            return response()->json(['message' => 'Load updated successfully', 'data' => $load, 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch update load. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        $load = Load::find($request->load_id);
        try{
            $load->delete();
            return response()->json(['message' => 'Load deleted successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to delete load. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
