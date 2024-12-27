<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return response()->json($plans);
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

        $plan = Plan::create($validatedData);

        return response()->json(['message' => 'Plan created successfully', 'data' => $plan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $plan = Plan::findOrFail($id);
        return response()->json($plan);
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

        $plan->update($validatedData);

        return response()->json(['message' => 'Plan updated successfully', 'data' => $plan]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return response()->json(['message' => 'Plan deleted successfully']);
    }
}
