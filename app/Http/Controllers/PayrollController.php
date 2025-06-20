<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Route;
use Exception;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try{
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'route_ids' => 'required|array',
                'route_ids.*' => 'required|exists:routes,id',
                'vat' => 'nullable|numeric',
                'discount' => 'nullable|numeric',
                'comment' => 'nullable|string',
            ]);

            foreach($validated['route_ids'] as $route_id){

                $route = Route::find($route_id);

                $total = $route->rate;
                $discount = $request->input('discount', 0);
                $vat = $request->input('vat', 0);

                $discount_amount = ($discount/100) * $total;
                $netTotal = ($total - $discount_amount) - $vat;

            }

            $data = [];

            return response()->json(['data' => $data, 'message' => 'Invoice computed successfully', 'status' => 'success'], 201);

        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        //
    }
}
