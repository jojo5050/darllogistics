<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                // User fields
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:65|unique:users,email',
                'phone' => 'required|string|max:22|unique:users,phone',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string',

                // Profile fields
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

            // Create the user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'password' => Hash::make($validatedData['password']),
                'role' => $validatedData['role'],
            ]);

            // Create the profile
            Profile::create([
                'user_id' => $user->id,
                'country_id' => $validatedData['country_id'],
                'state_id' => $validatedData['state_id'],
                'city_id' => $validatedData['city_id'],
                'address1' => $validatedData['address1'],
                'address2' => $validatedData['address2'] ?? null,
                'gender' => $validatedData['gender'] ?? null,
                'dot_number' => $validatedData['dot_number'],
                'mc_number' => $validatedData['mc_number'],
                'zip_code' => $validatedData['zip_code'],
                'payment_method' => $validatedData['payment_method'] ?? null,
                'currency' => $validatedData['currency'] ?? null,
                'image_path' => $validatedData['image_path'] ?? null,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'code' => 1,
                'message' => 'User registered successfully!',
                'user' => $user,
                'token' => $token,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'message' => 'Registration failed. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $profile = Profile::where('user_id', $user->id)->first();

        return response()->json([
            'code' => 1,
            'message' => 'Login successful!',
            'token' => $token,
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
            'code' => 1
        ]);
    }
}
