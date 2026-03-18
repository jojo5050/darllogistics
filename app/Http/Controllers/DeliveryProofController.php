<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function show(DeliveryProof $deliveryProof)
    {
        try{
            $data = $deliveryProof->load(['user', 'company']);
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

   
    public function edit(Bol $deliveryProof)
    {
        //
    }

   
    public function update(Request $request, DeliveryProof $deliveryProof)
    {
        //
    }


    public function destroy(DeliveryProof $deliveryProof)
    {
        try{
            $deliveryProof->delete();
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
