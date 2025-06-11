<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Route;
use Exception;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data = Invoice::with(['user', 'route'])->paginate(30);
            return response()->json([
                'status' => 'success',
                'message' => 'All invoices fecthed successfully.',
                'data' => $data,
            ], 201);
        }catch(Exception $e){
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
        try{
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'route_id' => 'required|exists:routes,id',
                'vat' => 'nullable|numeric',
                'discount' => 'nullable|numeric',
                'comment' => 'nullable|string',
            ]);

            $route = Route::find($request->route_id);

            $total = $route->rate;
            $discount = $request->input('discount', 0);
            $vat = $request->input('vat', 0);

            $netTotal = ($total - $discount) + $vat;

            $driver_percentage = $route->driver ? $route->driver->percentage : null;
            $dispatcher_percentage = $route->dispatcher_fee;

            if($route->flat_rate != null || $route->flat_rate > 0)
            {
                $driverEarning = $route->flat_rate;
                $dispatcherEarning = round($route->rate * ($dispatcher_percentage / 100), 2);
            }else{
                if($route->mc_type == 'internal_mc')
                {
                    $driverEarning = round($route->rate * (100/100), 2);
                    $dispatcherEarning = round($driverEarning * ($dispatcher_percentage / 100), 2);
                    $driverEarning = $driverEarning - $dispatcherEarning;
                }else{
                    $driverEarning = round($route->rate * (90 / 100), 2);
                    $dispatcherEarning = round($driverEarning * ($dispatcher_percentage / 100), 2);
                    $driverEarning = $driverEarning - $dispatcherEarning;
                }
            }

            $invoice = Invoice::updateOrCreate(
                [
                    'route_id' => $request->route_id,
                    'user_id' => $request->user_id,
                ],
                [
                    'total_earning' => $netTotal,
                    'vat' => $vat,
                    'discount' => $discount,
                    'driver_earning' => $driverEarning,
                    'dispatcher_earning' => $dispatcherEarning,
                ]
            );

            $data = $invoice->load(['user', 'route']);
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
    public function show(Invoice $invoice)
    {
        try{
            if (!$invoice) {
                return response()->json(['status' => 'failed', 'message' => 'Invoice not found'], 404);
            }
            $data = $invoice->load(['user', 'route']);
            return response()->json(['data' => $data, 'message' => 'Invoice fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function userInvoices(Request $request)
    {
        $invoices = Invoice::where('user_id', $request->user_id)->with('route')->paginate(30);
        try{
            if (!$invoices) {
                return response()->json(['status' => 'failed', 'message' => 'Invoice not found'], 404);
            }
            $data = $invoices;
            return response()->json(['data' => $data, 'message' => 'User invoices fetched successfully', 'status' => 'success'], 201);
        }catch(Exception $e){
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
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
