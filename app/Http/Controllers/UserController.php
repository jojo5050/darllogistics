<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        try{
            $data = User::with('profile')->get();
            return response()->json(['data' => $data, 'message' => 'Users fetched successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch users. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Request $request)
    {
        $user = User::find($request->id);
        if($user){
            $data = $user;
            $data['avatar'] = 'https://ui-avatars.com/api/?name='.$user->name;
            return response()->json(['data' => $data, 'message' => 'User fetched successfully', 'code' => 1, 'status' => 'success'], 201);
        }
        return response()->json(['data' => [], 'message' => 'User not found', 'code' => 1, 'status' => 'success'], 201);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'nullable|string',
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|string',
        ]);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);
        return response()->json($user);
    }

    public function drivers(Request $request)
    {
        try{
            $data = User::where('role', 'driver')->get();
            return response()->json(['data' => $data, 'message' => 'Drivers fetched successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch drivers. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function dispatchers(Request $request)
    {
        try{
            $data = User::where('role', 'dispatcher')->get();
            return response()->json(['data' => $data, 'message' => 'Dispatchers fetched successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch dispatchers. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
