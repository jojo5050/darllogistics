<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return response()->json($countries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:3|unique:countries',
        ]);

        $country = Country::create($validatedData);

        return response()->json(['message' => 'Country created successfully', 'data' => $country], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $country = Country::findOrFail($id);
        return response()->json($country);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'code' => 'nullable|string|size:3|unique:countries,code,' . $country->id,
        ]);

        $country->update($validatedData);

        return response()->json(['message' => 'Country updated successfully', 'data' => $country]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return response()->json(['message' => 'Country deleted successfully']);
    }
}
