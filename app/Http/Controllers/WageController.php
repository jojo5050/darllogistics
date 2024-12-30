<?php

namespace App\Http\Controllers;

use App\Models\Wage;
use Illuminate\Http\Request;

class WageController extends Controller
{
    // List all wages
    public function index()
    {
        $wages = Wage::all();
        return response()->json($wages, 201);
    }

    public function userWages(Request $request)
    {
        $validatedData = $request->validate([
            'driver_id' => 'required|exists:users,id',
        ]);

        $wages = Wage::where('driver_id', $validatedData['driver_id'])->get();

        if ($wages->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No wages found for this user.',
                'data' => [],
            ], 201);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Wages retrieved successfully.',
            'data' => $wages,
        ], 201);
    }

    // Show a specific wage by ID
    public function show($id)
    {
        $wage = Wage::find($id);

        if (!$wage) {
            return response()->json(['message' => 'Wage not found'], 404);
        }

        return response()->json($wage, 201);
    }

    // Store a new wage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'driver_id' => 'required|exists:users,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'gross_pay' => 'required|numeric|min:0',
            'amount_paid' => 'nullable|numeric|min:0',
            'date_paid' => 'required|date',
            'time_paid' => 'required',
            'comment' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'balance' => 'nullable|numeric|min:0',
            'balance_paid' => 'nullable|numeric|min:0',
            'balance_paid_date' => 'nullable|date',
            'balance_paid_time' => 'nullable'
        ]);

        $wage = Wage::create($validatedData);
        return response()->json($wage, 201);
    }

    // Update a specific wage
    public function update(Request $request, $id)
    {
        $wage = Wage::find($id);

        if (!$wage) {
            return response()->json(['message' => 'Wage not found'], 404);
        }

        $validatedData = $request->validate([
            'driver_id' => 'sometimes|required|exists:users,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'gross_pay' => 'sometimes|required|numeric|min:0',
            'amount_paid' => 'nullable|numeric|min:0',
            'date_paid' => 'sometimes|required|date',
            'time_paid' => 'sometimes|required',
            'comment' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'balance' => 'nullable|numeric|min:0',
            'balance_paid' => 'nullable|numeric|min:0',
            'balance_paid_date' => 'nullable|date',
            'balance_paid_time' => 'nullable'
        ]);

        $wage->update($validatedData);
        return response()->json($wage, 201);
    }

    // Delete a specific wage
    public function destroy($id)
    {
        $wage = Wage::find($id);

        if (!$wage) {
            return response()->json(['message' => 'Wage not found'], 404);
        }

        $wage->delete();
        return response()->json(['message' => 'Wage deleted successfully'], 201);
    }
}
