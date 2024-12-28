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
        $validatedData = $request->validate([
            // User fields
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:65|unique:users,email',
            'phone' => 'required|string|max:22|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',

            // Profile fields
            'country_id' => 'required|string|max:255',
            'state_id' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'gender' => 'required|string|max:10',
            'zip_code' => 'required|string|max:20',
            'payment_method' => 'required|string|max:50',
            'currency' => 'required|string|max:10',
            'image_path' => 'nullable|string|max:255',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Create the profile
        Profile::create([
            'user_id' => $user->id,
            'country_id' => $validatedData['country_id'],
            'state_id' => $validatedData['state_id'],
            'address1' => $validatedData['address1'],
            'address2' => $validatedData['address2'] ?? null,
            'gender' => $validatedData['gender'],
            'zip_code' => $validatedData['zip_code'],
            'payment_method' => $validatedData['payment_method'],
            'currency' => $validatedData['currency'],
            'image_path' => $validatedData['image_path'] ?? 'default.png',
        ]);

        return response()->json([
            'code' => 1,
            'message' => 'User registered successfully!',
            'user' => $user,
        ], 201);
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

        return response()->json([
            'code' => 1,
            'message' => 'Login successful!',
            'token' => $token,
            'user' => $user,
            'profile' => $user->profile
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
