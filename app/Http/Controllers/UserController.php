<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMailer;
use App\Models\Company;
use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        try{
            $data = User::with('profile')->paginate(30);
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
            $data['profile'] = $data->profile;
            $data['profile']['avatar'] = 'https://ui-avatars.com/api/?name='.$user->name;
            return response()->json(['data' => $data, 'message' => 'User fetched successfully', 'code' => 1, 'status' => 'success'], 201);
        }
        return response()->json(['data' => [], 'message' => 'User not found', 'code' => 1, 'status' => 'success'], 201);
    }

    public function showCompanies(Request $request)
    {
        try{
            $user = User::find($request->id);
            $companies = Company::where('user_id', $user->id)->get();
            return response()->json(['data' => $companies, 'message' => 'Fetched user cpmpanies successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch(Exception $e) {
            return response()->json(['data' => [], 'message' => 'Companies not found', 'code' => 1, 'status' => 'success'], 500);
        }
    }

    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'role' => 'nullable|string',
                'company_type' => 'nullable|string',
                'company_id' => 'required|exists:companies,id',
                'country_id' => 'required|string',
                'state_id' => 'required|string',
                'city_id' => 'required|string',
                'percentage' => 'nullable|numeric',
                'dot_number' => 'nullable|string',
                'mc_number' => 'nullable|string',
            ]);

            $password = ucfirst(uniqid());

            $data['password'] = bcrypt($password);
            $user = User::create($data);

            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->company_type = $data['company_type'];
            $profile->company_id = $data['company_id'];
            $profile->country_id = $data['country_id'];
            $profile->state_id = $data['state_id'];
            $profile->city_id = $data['city_id'];
            $profile->percentage = $data['percentage'] ?? 0.00;

            if($data['role'] == 'driver'){
                $profile->dot_number = $data['dot_number'];
                $profile->mc_number = $data['mc_number'];
            }

            $profile->save();

            $company = Company::where('id', $data['company_id'])->first();

            $message = '<p>Dear '.$data['name'].'</p>';
            $message .= '<p>This is to inform you that you have been registered as '.$data['role'].' in '.$company->name.' on '.$_ENV['APP_NAME'].'</p>';
            $message .= '<p>Below are your login details:</p>';
            $message .= '<p>Email: '.$data['email'].'</p>';
            $message .= '<p>Password: '.$password.'</p>';

            Mail::to($data['email'])->send(new NotificationMailer($message));

            $d = ["user" => $user, "profile" => $profile, "company" => $company];

            return response()->json(['data' => $d, 'message' => 'User added successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch(Exception $e) {
            return response()->json(['data' => [], 'message' => 'Failed to add user. Error: '.$e->getMessage(), 'code' => 0, 'status' => 'failed'], 500);
        }
    }

    public function update(Request $request)
    {
        try{
            $user = $request->user();
            $data = $request->validate([
                'name' => 'string|max:255',
                'email' => 'email|unique:users,email,' . $user->id,
                'phone' => 'required|unique:users,phone,' . $user->id,
                'password' => 'nullable|string|min:8',
                'role' => 'nullable|string',
                'company_type' => 'nullable|string',
                'company_id' => 'required|exists:companies,id',
                'country_id' => 'required|string',
                'state_id' => 'required|string',
                'city_id' => 'required|string',
                'percentage' => 'required|numeric',
            ]);

            if (isset($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }

            $user->update($data);

            $profile = Profile::where('user_id', $user->id)->first();
            $profile->company_type = $data['company_type'];
            $profile->company_id = $data['company_id'];
            $profile->country_id = $data['country_id'];
            $profile->state_id = $data['state_id'];
            $profile->city_id = $data['city_id'];
            $profile->percentage = $data['percentage'];

            $profile->save();

            return response()->json(['data' => $user->load('profile', 'company'), 'message' => 'User updated successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (Exception $e) {
            return response()->json(['data' => [], 'message' => 'Failed to update user. Error: '.$e->getMessage(), 'code' => 0, 'status' => 'failed'], 500);
        }
    }

    public function drivers(Request $request)
    {
        try{
            $data = User::where('role', 'driver')->with('profile')->get();
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
            $data = User::where('role', 'dispatcher')->with('profile')->get();
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

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if($user){
            $user->delete();
            return response()->json(['message' => 'User deleted successfully', 'code' => 1, 'status' => 'success']);
        }
        return response()->json([
            'code' => 0,
            'status' => 'failed',
            'message' => 'User does not exist.',
        ], 500);
    }
}
