<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Plan;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $payments = Payment::all();
            return response()->json(['data'=>$payments, 'message' => 'payments fetched successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch payments. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function userPayments(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $payments = Payment::where('user_id', $validatedData['user_id'])->get();

        if ($payments->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No payments found for this user.',
                'data' => [],
            ], 201);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Payments retrieved successfully.',
            'data' => $payments,
        ], 201);
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
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $plan = Plan::findOrFail($request->plan_id);

        $planId = $request->plan_id;
        $ref = $request->transaction_reference;
        $userId = $request->user()->id;

        if(Payment::where('transaction_reference', $ref)->exists()){
            $payment = Payment::where('transaction_reference', $ref)->first();
            if ($payment->status != 'success') {
                $payment->status = $request->status;
                $payment->gateway_response = $request->gateway_response;
                return response()->json(['message' => 'Payment updated successfully.', 'status' => 'success', 'code' => 1]);
            }

            return response()->json(['message' => 'Payment already confirmed.', 'status' => 'success', 'code' => 1]);
        }else{
            $payment = Payment::create([
                'user_id' => $userId,
                'plan_id' => $planId,
                'amount' => $request->amount,
                'currency' => $request->currency,
                'transaction_reference' => $request->transaction_reference,
                'payment_method' => $request->payment_method,
                'status' => $request->status,
                'gateway_response' => $request->gateway_response,
            ]);

            return response()->json(['message' => 'Payment details saved successfully.', 'data' => $payment, 'status' => 'success', 'code' => 1]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        return response()->json($payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
