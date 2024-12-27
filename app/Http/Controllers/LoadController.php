<?php

namespace App\Http\Controllers;

use App\Models\Load;
use Illuminate\Http\Request;

class LoadController extends Controller
{
    public function index()
    {
        return response()->json(Load::all());
    }

    public function show(Load $load)
    {
        return response()->json($load);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'nullable|string',
            'pickup_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'weight' => 'nullable|numeric',
        ]);

        $load = Load::create($data);
        return response()->json($load, 201);
    }

    public function update(Request $request, Load $load)
    {
        $data = $request->validate([
            'description' => 'nullable|string',
            'pickup_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'weight' => 'nullable|numeric',
        ]);

        $load->update($data);
        return response()->json($load);
    }

    public function destroy(Load $load)
    {
        $load->delete();
        return response()->json(['message' => 'Load deleted successfully']);
    }
}
