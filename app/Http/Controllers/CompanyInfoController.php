<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function index()
    {
        $companyInfos = CompanyInfo::all();
        return response()->json($companyInfos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:company_infos,email',
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

        $companyInfo = CompanyInfo::create($validatedData);

        return response()->json($companyInfo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $companyInfo = CompanyInfo::findOrFail($id);
        return response()->json($companyInfo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $companyInfo = CompanyInfo::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:company_infos,email,' . $companyInfo->id,
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

        $companyInfo->update($validatedData);

        return response()->json($companyInfo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $companyInfo = CompanyInfo::findOrFail($id);
        $companyInfo->delete();

        return response()->json(['message' => 'Company info deleted successfully']);
    }
}
