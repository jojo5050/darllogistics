<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryProof;

class DeliveryProofController extends Controller
{
    public function index()
    {
        try{
            $data =DLPRV::with(['user', 'company'])->paginate(30);
            return response()->json([
                'status' => 'success',
                'message' => 'Delivery Proof fecthed successfully.',
                'data' => $data,
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function driverDeliveryProof(Request $request)
    {
        try{
            $data = DLPRV::where('user_id', $request->driver_id)->with(['user', 'company'])->paginate(30);
            return response()->json([
                'status' => 'success',
                'message' => 'Delivery Proof fecthed successfully.',
                'data' => $data,
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(DeliveryProof $delivery_proof)
    {
        try{
            $data = $delivery_proof->load(['user', 'company']);
            return response()->json([
                'status' => 'success',
                'message' => 'Delivery Proof fecthed successfully.',
                'data' => $data,
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

   
    public function edit(DeliveryProof $delivery_proof)
    {
        //
    }

   
    public function update(Request $request, DeliveryProof $delivery_proof)
    {
        //
    }


    public function destroy(DeliveryProof $delivery_proof)
    {
        try{
            $delivery_proof->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Delivery Proof deleted successfully.',
                'data' => [],
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }
}
