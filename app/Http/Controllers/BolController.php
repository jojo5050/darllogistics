<?php

namespace App\Http\Controllers;

use App\Models\Bol;
use Illuminate\Http\Request;

class BolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data = BOL::with(['user', 'company'])->paginate(30);
            return response()->json([
                'status' => 'success',
                'message' => 'BOLs fecthed successfully.',
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

    public function driverBols(Request $request)
    {
        try{
            $data = BOL::where('user_id', $request->driver_id)->with(['user', 'company'])->paginate(30);
            return response()->json([
                'status' => 'success',
                'message' => 'BOLs fecthed successfully.',
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bol $bol)
    {
        try{
            $data = $bol->load(['user', 'company']);
            return response()->json([
                'status' => 'success',
                'message' => 'BOL fecthed successfully.',
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bol $bol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bol $bol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bol $bol)
    {
        try{
            $bol->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'BOL deleted successfully.',
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
