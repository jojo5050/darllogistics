<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
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
        try{

            $data = Payroll::with(['user', 'invoice.route.jobs'])->get();

            return response()->json(['data' => $data, 'message' => 'Payrolls fetched successfully', 'status' => 'success'], 201);

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
                'invoice_ids' => 'required|array',
                'invoice_ids.*' => 'required|exists:invoices,id',
                'comment' => 'nullable|string',
            ]);

            $gross_amount = 0.00;
            $net_amount = 0.00;
            $total_vat = 0.00;
            $total_discount = 0.00;

            $payroll_number = strtoupper(uniqid());

            foreach($validated['invoice_ids'] as $invoice_id){

                $invoice = Invoice::find($invoice_id);

                $total_amount = $invoice->total_earning;
                $gross_amount = $total_amount;

                $total_discount = $invoice->discount;
                $total_vat = $invoice->vat;

                // $net_amount = $invoice->total_earning - $invoice->discount - $invoice->vat - $invoice->dispatcher_earning - $invoice->driver_earning;

                $gross_amount_sum = round($gross_amount, 2);
                $net_amount_sum = round($net_amount, 2);
                $total_deductions = round(($total_discount + $total_vat), 2);
                $net_amount = round(($gross_amount - $total_deductions), 2);

                $payroll = Payroll::updateOrCreate(
                    [
                        'invoice_id' => $invoice->id,
                        'user_id' => $request->user_id,
                    ],
                    [
                        'total_earning' => $gross_amount_sum,
                        'driver_earning' => $invoice->driver_earning,
                        'payroll_number' => $payroll_number,
                        'gross' => $gross_amount,
                        'deductions' => $total_deductions,
                        'net' => $net_amount_sum,
                        'reimbursement' => 0.00,
                        'grand_total' => $total_amount,
                        'comment' => $request->comment,
                    ]
                );

            }

            $data = Payroll::where('payroll_number', $payroll_number)->with(['user', 'invoice.route.jobs'])->get();

            return response()->json(['data' => $data, 'message' => 'Payroll computed successfully', 'status' => 'success'], 201);

        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

    public function fetchPayroll(Request $request)
    {
        try{

            $data = Payroll::where('payroll_number', $request->payroll_number)->with(['user', 'invoice.route.jobs'])->get();

            return response()->json(['data' => $data, 'message' => 'Payroll fetched successfully', 'status' => 'success'], 201);

        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Error: '.$e->getMessage(),
                'data' => [],
            ], 201);
        }
    }

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
