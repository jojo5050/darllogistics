<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Subscription; 
use App\Models\User;
use App\Models\Payment;
use App\Models\Company;
use Carbon\Carbon;



class AppleIAPController extends Controller
{
   
    public function verifyPurchase(Request $request)
    {
        $request->validate([
            'receipt_data' => 'required',
            'plan_id' => 'required',
            'amount' => 'nullable|numeric' // Accept the amount from Flutter
        ]);

        $user = $request->user();
        $receiptData = $request->receipt_data;
        $planId = $request->plan_id;
        
        // If the mobile app doesn't send the amount, try to find it from your Plans table
        $amount = $request->amount;
        if (!$amount) {
            $plan = Plan::find($planId);
            $amount = $plan ? $plan->price : 0;
        }
        
        // Determine URL based on environment
        $appleUrl = config('app.env') === 'production' 
            ? 'https://buy.itunes.apple.com/verifyReceipt' 
            : 'https://sandbox.itunes.apple.com/verifyReceipt';

        $password = config('services.apple.shared_secret');

        try {
            $response = Http::post($appleUrl, [
                'receipt-data' => $receiptData,
                'password' => $password,
                'exclude-old-transactions' => true
            ]);

            $result = $response->json();

            if (isset($result['status']) && $result['status'] === 0) {
                // Get the latest transaction info
                $latestInfo = $result['latest_receipt_info'][0] ?? $result['receipt']['in_app'][0];
                
                // Identify the company associated with the user
                $company = Company::where('user_id', $user->id)->first() 
                        ?? Company::where('id', $user->profile?->company_id)->first();

                if (!$company) {
                    return response()->json([
                        'code' => 0, 
                        'message' => 'Company profile not found.'
                    ], 404);
                }

                // Update or Create the payment record with the correct amount and reference
                Payment::updateOrCreate(
                    ['user_id' => $company->id], // Match existing logic: Payment user_id = Company ID
                    [
                        'status' => 'success',
                        'amount' => $amount, // Now using the passed or looked-up amount
                        'reference' => $latestInfo['transaction_id'],
                        'plan_id' => $planId,
                        'payment_method' => 'apple_iap',
                        'updated_at' => Carbon::now(),
                    ]
                );

                return response()->json([
                    'code' => 1,
                    'status' => 'success',
                    'message' => 'Payment verified and subscription activated.',
                    'data' => [
                        'transaction_id' => $latestInfo['transaction_id'],
                        'amount' => $amount,
                        'plan_id' => $planId
                    ]
                ]);
            }

            return response()->json([
                'code' => 0,
                'status' => 'error',
                'message' => 'Apple verification failed. Status: ' . ($result['status'] ?? 'unknown'),
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 0, 
                'message' => 'Internal Server Error during verification.'
            ], 500);
        }
    }
}
