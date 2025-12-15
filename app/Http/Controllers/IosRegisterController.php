<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\Company;

class IosRegisterController extends Controller
{
    /**
     * STEP 0: Load iOS signup page
     */
    public function showSignupForm()
    {
        return view('register-ios');
    }


    public function registerUser(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'required|string|unique:users,phone',
            'password'  => 'required|string|min:8|confirmed',
            'role'      => 'required|string',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'],
            'role'     => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('web')->plainTextToken;

        session([
            'user_email' => $user->email,
            'user_id'    => $user->id,
            'api_token'  => $token,
        ]);

        return response()->json([
            'success' => true,
            'user_id' => $user->id,
            'email'   => $user->email,
        ]);
    }

    /* ===================== COMPANY ===================== */
    public function registerCompany(Request $request)
    {
        $validated = $request->validate([
            'user_id'    => 'required|exists:users,id',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email',
            'country'    => 'required|string',
            'state'      => 'required|string',
            'city'       => 'required|string',
            'zip_code'   => 'required|string',
            'address1'   => 'required|string',

            // Optional (VERY IMPORTANT)
            'tel'        => 'nullable|string',
            'mobile'     => 'nullable|string',
            'dot_number' => 'nullable|string',
            'mc_number'  => 'nullable|string',
        ]);

        $company = Company::create([
            'user_id'    => $validated['user_id'],
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'country'    => $validated['country'],
            'state'      => $validated['state'],
            'city'       => $validated['city'],
            'zip_code'   => $validated['zip_code'],
            'address'    => $validated['address1'],
            'tel'        => $validated['tel'] ?? null,
            'mobile'     => $validated['mobile'] ?? null,
            'dot_number' => $validated['dot_number'] ?? null,
            'mc_number'  => $validated['mc_number'] ?? null,
        ]);

        

        return response()->json([
            'success'     => true,
            'company_id'  => $company->id,
        ]);
    }
      
    
}
