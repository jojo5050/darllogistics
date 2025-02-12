<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        try{
            $plans = Plan::all();
            return response()->json(['message' => 'Plans fetched successfully', 'code' => 1, 'status' => 'success', 'data' => $plans], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch plans. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'features' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'coupon' => 'nullable|string|max:255',
        ]);

        try{

            $plan = Plan::create($validatedData);

            return response()->json(['message' => 'Plan created successfully', 'data' => $plan, 'status' => 'success', 'code' => 1], 201);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to create plan. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $plan = Plan::findOrFail($id);
            return response()->json($plan);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch plan. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'features' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'coupon' => 'nullable|string|max:255',
        ]);

        try{
            $plan->update($validatedData);

            return response()->json(['message' => 'Plan updated successfully', 'data' => $plan, 'status' => 'success', 'code' => 1]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to update plan. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $plan = Plan::findOrFail($id);
            $plan->delete();

            return response()->json(['message' => 'Plan deleted successfully', 'status' => 'success', 'code' => 1]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to delete plan. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
