<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrier;
use Exception;
use App\Models\Company;
use PhpParser\Node\Stmt\Catch_;

class CarrierController extends Controller
{
    public function index()
    {
       
        try{
            return response()->json(['data' => Carrier::with('company')->paginate(30), 'message' => 'Carriers fetched successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch Carriers. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function companyCarriers(Request $request)
    {
        try {
            $company_id = $request->comp_id;
            $data = Carrier::where('company_id', $company_id)->get();

            if ($data->isNotEmpty()) {
                return response()->json([
                    'data' => $data,
                    'message' => 'Carriers fetched successfully',
                    'code' => 1,
                    'status' => 'success'
                ], 201);
            }

            return response()->json([
                'data' => [],
                'message' => 'Invalid company ID.',
                'code' => 1,
                'status' => 'success'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch Carriers. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'carrier_name' => 'required|string|max:100',
                'carrier_phone' => 'required|string|max:20',
                'carrier_email' => 'required|email',
                'mc_number' => 'nullable|string',
                'dot_number' => 'nullable|string',
                'carrier_country' => 'nullable|string',
                'carrier_state' => 'nullable|string',
                'carrier_city' => 'nullable|string',
                'company_id' => 'required|exists:companies,id',
            ]);

            $carrier = Carrier::create([
                'name' => $validatedData['carrier_name'],
                'email' => $validatedData['carrier_email'],
                'mc_number' => $validatedData['mc_number'],
                'dot_number' => $validatedData['dot_number'],
                'phone' => $validatedData['carrier_phone'],
                'city' => $validatedData['carrier_city'],
                'state' => $validatedData[ 'carrier_state'],
                'country' => $validatedData['carrier_country'],
                'company_id' => $validatedData['company_id'],
            ]);

            return response()->json([
                'status' => 'success', 
                'code' => 1, 
                'message' => 'Carrier registered successfully', 
                'data' => $carrier
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed', 
                'code' => 0, 
                'message' => 'Error: '.$e->getMessage()
            ], 500);
        }
    }

     /**
     * Display the specified resource.
     */
    public function show(Carrier $carrier)
    {
        $carrier = $carrier->load('company');

        return response()->json(
            [
                'status' => 'success',
                'code' => 1,
                'data' => $carrier,
                'message' => 'Carrier fetched successfully',
            ], 201
        );
    }

    public function update(Request $request, Carrier $carrier)
    {
        try{
            $validatedData = $request->validate([
                'carrier_name' => 'required|string|max:100',
                'carrier_phone' => 'nullable|string|unique:carriers,phone,' . $carrier->id,        
                'carrier_email' => 'required|email|unique:carriers,email,' . $carrier->id,    
                'carrier_city' => 'nullable|string|max:100',
                'carrier_state' => 'nullable|string|max:100',
                'mc_number' => 'nullable|string|max:100',
                'dot_number' => 'nullable|string|max:100',
                'carrier_country' => 'nullable|string|max:100',
                'company_id' => 'required|exists:companies,id',
            ]);

            $payload = [
                'name' => $validatedData['carrier_name'],
                'phone' => $validatedData['carrier_phone'],         
                'email' => $validatedData['carrier_email'],
                'city' => $validatedData['carrier_city'],
                'state' => $validatedData['carrier_state'],
                'country' => $validatedData['carrier_country'],
                'mc_number' => $validatedData['mc_number'],
                'dot_number' => $validatedData['dot_number'],
                'company_id' => $validatedData['company_id'],
            ];

            $carrier = $carrier->update($payload);

            return response()->json(['status' => 'success', 'code' => 1, 'message' => 'carrier updated successfully', 'data' => $carrier], 201);
        }catch(Exception $e){
            return response()->json(['status' => 'failed', 'code' => 0, 'message' => 'Error updating carrier: '.$e->getMessage(), 'data' => []], 500);
        }
    }

    public function destroy(Carrier $carrier)
    {
        $carrier->delete();
        return response()->json(['status' => 'success', 'code' => 1, 'message' => 'Carrier deleted successfully']);
    }
}
