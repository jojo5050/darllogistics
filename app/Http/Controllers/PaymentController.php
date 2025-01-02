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
        $validated = $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'transaction_reference' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string',
            'payment_method' => 'required|string',
            'status' => 'required|string|in:success,pending,failed',
            'gateway_response' => 'nullable|array',
        ]);

        $gatewayResponse = $request->gateway_response;
        if (is_array($gatewayResponse)) {
            $gatewayResponse = json_encode($gatewayResponse);
        }

        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $plan = Plan::findOrFail($validated['plan_id']);

        $existingPayment = Payment::where('transaction_reference', $validated['transaction_reference'])->first();

        if ($existingPayment) {
            if ($existingPayment->status != 'success') {
                $existingPayment->update([
                    'status' => $validated['status'],
                    'gateway_response' => $gatewayResponse,
                ]);

                return response()->json(['message' => 'Payment updated successfully.', 'status' => 'success', 'code' => 1]);
            }

            return response()->json(['message' => 'Payment already confirmed.', 'status' => 'success', 'code' => 1]);
        }

        $payment = Payment::create([
            'user_id' => $user->id,
            'plan_id' => $validated['plan_id'],
            'amount' => $validated['amount'],
            'currency' => $validated['currency'],
            'transaction_reference' => $validated['transaction_reference'],
            'payment_method' => $validated['payment_method'],
            'status' => $validated['status'],
            'gateway_response' => $gatewayResponse,
        ]);

        return response()->json([
            'message' => 'Payment details saved successfully.',
            'data' => $payment,
            'status' => 'success',
            'code' => 1,
        ]);
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
