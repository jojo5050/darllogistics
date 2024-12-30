<?php

namespace App\Http\Controllers;

use App\Models\StaffSalary;
use Illuminate\Http\Request;

class StaffSalaryController extends Controller
{
    // Fetch all staff salaries
    public function index()
    {
        $staffSalaries = StaffSalary::all();
        return response()->json($staffSalaries);
    }

    public function userSalaries(Request $request)
    {
        $user = $request->user();

        // Assuming the user has one profile
        $staffSalaries = $user->salaries;

        if (!$staffSalaries) {
            return response()->json(['message' => 'Salary not found'], 404);
        }

        return response()->json(['message' => 'Staff salaries fetched successfully', 'data' => $staffSalaries], 201);
    }

    // Fetch a specific staff salary by ID
    public function show($id)
    {
        $staffSalary = StaffSalary::find($id);

        if (!$staffSalary) {
            return response()->json(['message' => 'Staff salary not found'], 404);
        }

        return response()->json($staffSalary);
    }

    // Create a new staff salary
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'gross_salary' => 'required|numeric',
            'deductions' => 'nullable|numeric',
            'net_salary' => 'required|numeric',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'comment' => 'nullable|string',
        ]);

        $staffSalary = StaffSalary::create($validated);

        return response()->json($staffSalary, 201);
    }

    // Update an existing staff salary by ID
    public function update(Request $request, $id)
    {
        $staffSalary = StaffSalary::find($id);

        if (!$staffSalary) {
            return response()->json(['message' => 'Staff salary not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'gross_salary' => 'required|numeric',
            'deductions' => 'nullable|numeric',
            'net_salary' => 'required|numeric',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',
            'comment' => 'nullable|string',
        ]);

        $staffSalary->update($validated);

        return response()->json($staffSalary);
    }

    // Delete a staff salary by ID
    public function destroy($id)
    {
        $staffSalary = StaffSalary::find($id);

        if (!$staffSalary) {
            return response()->json(['message' => 'Staff salary not found'], 404);
        }

        $staffSalary->delete();

        return response()->json(['message' => 'Staff salary deleted successfully']);
    }
}
