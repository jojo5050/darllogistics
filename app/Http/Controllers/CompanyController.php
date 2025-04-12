<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        try{
            $data = Company::all();
            return response()->json(['data' => $data, 'message' => 'Companies fetched successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch companies. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:companies,email',
                'country' => 'required|string|max:255',
                'tel' => 'nullable|string|max:20',
                'mobile' => 'nullable|string|max:20',
                'state' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'zip_code' => 'nullable|integer',
                'address' => 'nullable|string|max:500',
                'po_box' => 'nullable|string|max:50',
                'logo' => 'nullable|string|max:255',
                'email2' => 'nullable|email|max:255',
                'whatsapp' => 'nullable|string|max:20',
                'instagram' => 'nullable|string|max:255',
                'twitter' => 'nullable|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'website' => 'nullable|url|max:255',
            ]);

            $company = Company::create($validatedData);
            return response()->json(['data' => $company, 'code' => 1, 'message' => 'Success', 'status' => 'success'], 201);

        } catch(Exception $e) {
            return response()->json(['data' => [], 'code' => 0, 'message' => 'Failed. Error: '.$e->getMessage(), 'status' => 'failed'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try{
            $company = Company::findOrFail($request->id);
            return response()->json(['data' => $company, 'code' => 0, 'message' => 'Success', 'status' => 'success'], 201);
        } catch(Exception $e) {
            return response()->json(['data' => [], 'code' => 0, 'message' => 'Failed to find company. Error: '.$e->getMessage(), 'status' => 'failed'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $company = Company::findOrFail($request->id);

            $validatedData = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:companies,email,' . $company->id,
                'country' => 'sometimes|required|string|max:255',
                'tel' => 'nullable|string|max:20',
                'mobile' => 'nullable|string|max:20',
                'state' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'zip_code' => 'nullable|integer',
                'address' => 'nullable|string|max:500',
                'po_box' => 'nullable|string|max:50',
                'logo' => 'nullable|string|max:255',
                'email2' => 'nullable|email|max:255',
                'whatsapp' => 'nullable|string|max:20',
                'instagram' => 'nullable|string|max:255',
                'twitter' => 'nullable|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'website' => 'nullable|url|max:255',
            ]);

            $company->update($validatedData);

            return response()->json(['data' => $company, 'code' => 1, 'message' => 'Success', 'status' => 'success'], 201);
        } catch(Exception $e) {
            return response()->json(['data' => [], 'code' => 0, 'message' => 'Failed to update company. Error: '.$e->getMessage(), 'status' => 'failed'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $companyInfo = Company::findOrFail($request->id);
            $companyInfo->delete();

            return response()->json(['message' => 'Company deleted successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch(Exception $e) {
            return response()->json(['data' => [], 'code' => 0, 'message' => 'Failed to delete company. Error: '.$e->getMessage(), 'status' => 'failed'], 500);
        }
    }
}
