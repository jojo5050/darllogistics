<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMailer;
use App\Models\Company;
use App\Models\PasswordResetToken;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
                'country_id' => 'nullable|string',
                'state_id' => 'nullable|string',
                'city_id' => 'nullable|string',
                'address1' => 'nullable|string',
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
                'country_id' => $validatedData['country_id'] ?? null,
                'state_id' => $validatedData['state_id'] ?? null,
                'city_id' => $validatedData['city_id'] ?? null,
                'address1' => $validatedData['address1'] ?? null,
                'address2' => $validatedData['address2'] ?? null,
                'gender' => $validatedData['gender'] ?? null,
                'dot_number' => $validatedData['dot_number'] ?? null,
                'mc_number' => $validatedData['mc_number'] ?? null,
                'zip_code' => $validatedData['zip_code'] ?? null,
                'payment_method' => $validatedData['payment_method'] ?? null,
                'currency' => $validatedData['currency'] ?? null,
                'image_path' => $validatedData['image_path'] ?? null,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'code' => 1,
                'message' => 'User registered successfully!',
                'user' => $user->load('profile'),
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

    public function registerWithGoogle(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'userEmail' => 'required|string|email|max:65|unique:users,email',
                'idToken' => 'nullable|string',
                'accessToken' => 'nullable|string',
            ]);

            $name = substr(0,strpos('@', $request->userEmail),$request->userEmail);

            // Create the user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make(ucfirst(uniqid())),
                'role' => 'google user',
            ]);

            // Create the profile
            Profile::create([
                'user_id' => $user->id,
                'country_id' => $validatedData['country_id'] ?? null,
                'state_id' => $validatedData['state_id'] ?? null,
                'city_id' => $validatedData['city_id'] ?? null,
                'address1' => $validatedData['address1'] ?? null,
                'address2' => $validatedData['address2'] ?? null,
                'gender' => $validatedData['gender'] ?? null,
                'dot_number' => $validatedData['dot_number'] ?? null,
                'mc_number' => $validatedData['mc_number'] ?? null,
                'zip_code' => $validatedData['zip_code'] ?? null,
                'payment_method' => $validatedData['payment_method'] ?? null,
                'currency' => $validatedData['currency'] ?? null,
                'image_path' => $validatedData['image_path'] ?? null,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'code' => 1,
                'message' => 'User registered successfully!',
                'user' => $user->load('profile'),
                'token' => $token,
            ], 201);

        }catch (\Exception $e) {

            return response()->json([
                'code' => 0,
                'message' => 'Registration failed. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function registerCompanyStaff(Request $request)
    {
        try {
            $validatedData = $request->validate([
                // User fields
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:65|unique:users,email',
                'phone' => 'required|string|max:22|unique:users,phone',
                'role' => 'required|string',

                // Profile fields
                'company_id' => 'required|exists:companies,id',
                'country_id' => 'nullable|string',
                'state_id' => 'nullable|string',
                'city_id' => 'nullable|string',
                'address1' => 'nullable|string',
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
            $profile = Profile::create([
                'user_id' => $user->id,
                'company_id' => $validatedData['company_id'] ?? null,
                'country_id' => $validatedData['country_id'] ?? null,
                'state_id' => $validatedData['state_id'] ?? null,
                'city_id' => $validatedData['city_id'] ?? null,
                'address1' => $validatedData['address1'] ?? null,
                'address2' => $validatedData['address2'] ?? null,
                'gender' => $validatedData['gender'] ?? null,
                'dot_number' => $validatedData['dot_number'] ?? null,
                'mc_number' => $validatedData['mc_number'] ?? null,
                'zip_code' => $validatedData['zip_code'] ?? null,
                'payment_method' => $validatedData['payment_method'] ?? null,
                'currency' => $validatedData['currency'] ?? null,
                'image_path' => $validatedData['image_path'] ?? null,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'code' => 1,
                'message' => 'User registered successfully!',
                'user' => $user,
                'company' => $user->profile->company,
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

    public function requestOtp(Request $request)
    {
        try{

            $validatedData = $request->validate([
                'email' => 'required|string|email',
            ]);

            $user = User::where('email', $validatedData['email'])->first();

            if (!$user) {
                throw ValidationException::withMessages([
                    'email' => ['The provided email does not match any user.'],
                ]);
            }

            $otp = rand(100000, 999999);

            PasswordResetToken::updateOrCreate(
                ['email' => $user->email],
                ['token' => $otp, 'created_at' => now()]
            );

            $message = '<p>Dear '.$user->name.'</p>';
            $message .= '<p>Someone has requested a password reset on '.$_ENV['APP_NAME'].'. If it was not you, kindly disregard this message. But if it was you, proceed with the OTP below:</p>';
            $message .= '<p>OTP: <b>'.$otp.'</b></p>';

            Mail::to($user->email)->send(new NotificationMailer($message));

            return response()->json([
                'code' => 1,
                'status' => 'success',
                'message' => 'OTP sent successfully!',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to send OTP. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|string|email',
                'otp' => 'required|integer',
                'new_password' => 'required|string|min:8|confirmed',
                'new_password_confirmation' => 'required|string|min:8',
            ]);

            $user = User::where('email', $validatedData['email'])->first();

            if (!$user) {
                throw ValidationException::withMessages([
                    'email' => ['The provided email does not match any user.'],
                ]);
            }

            $token = PasswordResetToken::where('email', $user->email)
                ->where('token', $validatedData['otp'])
                ->first();

            if (!$token || now()->diffInMinutes($token->created_at) > 10) {
                throw ValidationException::withMessages([
                    'otp' => ['The provided OTP is invalid or has expired.'],
                ]);
            }

            $user->password = Hash::make($validatedData['new_password']);
            $user->save();

            // Delete the token after successful password change
            PasswordResetToken::where('email', $user->email)
                ->where('token', $validatedData['otp'])
                ->delete();

            return response()->json([
                'code' => 1,
                'status' => 'success',
                'message' => 'Password changed successfully!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'message' => 'Failed to change password. Please try again.',
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
        if(Company::where('user_id', $user->id)->exists()){
            $company = Company::where('user_id', $user->id)->first();
        }else{
            $company = Company::where('id', $user->profile->company_id)->first();
        }
        $profile['avatar'] = 'https://ui-avatars.com/api/?name='.$user->name;
        $payment = Payment::where('user_id', $user->id)->orderBy('id', 'desc')->first();

        return response()->json([
            'code' => 1,
            'message' => 'Login successful!',
            'token' => $token,
            'user' => $user,
            'profile' => $profile,
            'company' => $company,
            'payment' => $payment
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
