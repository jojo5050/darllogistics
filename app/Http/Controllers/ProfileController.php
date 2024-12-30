<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return response()->json($profiles);
    }

    public function userProfile(Request $request)
    {
        $user = $request->user();

        // Assuming the user has one profile
        $profile = $user->profile;

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        return response()->json(['message' => 'Profile fetched successfully', 'data' => $profile], 201);
    }

    // Show a single profile by id
    public function show($id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        return response()->json($profile);
    }

    // Create a new profile
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'country_id' => 'required|string',
            'state_id' => 'required|string',
            'city_id' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'gender' => 'nullable|string|max:10',
            'dot_number' => 'nullable|string',
            'mc_number' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'currency' => 'nullable|string',
        ]);

        $profile = Profile::create($validated);

        return response()->json($profile, 201);
    }

    // Update an existing profile
    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'country_id' => 'required|string',
            'state_id' => 'required|string',
            'city_id' => 'required|string',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'gender' => 'nullable|string|max:10',
            'dot_number' => 'nullable|string',
            'mc_number' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'currency' => 'nullable|string',
        ]);

        $profile->update($validated);

        return response()->json($profile);
    }

    // Delete a profile
    public function destroy($id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        $profile->delete();

        return response()->json(['message' => 'Profile deleted successfully']);
    }
}
