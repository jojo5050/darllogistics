<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class BrokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            return response()->json(['data' => Broker::with('company')->paginate(30), 'message' => 'Brokers fetched successfully', 'code' => 1, 'status' => 'success'], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'failed',
                'message' => 'Failed to fetch brokers. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function companyBrokers($company_id)
{
    try {
        $data = Broker::where('company_id', $company_id)
            ->with('company')
            ->get();

        if ($data->isNotEmpty()) {
            return response()->json([
                'data' => $data,
                'message' => 'Brokers fetched successfully',
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
            'message' => 'Failed to fetch brokers. Please try again.',
            'error' => $e->getMessage()
        ], 500);
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
            $validatedData = $request->validate([
                'broker_name' => 'required|string|max:100',
                'broker_phone1' => 'nullable|string|max:20',
                'broker_phone2' => 'nullable|string|max:20',
                'broker_email1' => 'nullable|email',
                'broker_email2' => 'nullable|email',
                'broker_city' => 'nullable|string|max:100',
                'broker_state' => 'nullable|string|max:100',
                'broker_country' => 'nullable|string|max:100',
                'company_id' => 'required|exists:companies,id',
            ]);

            $payload = [
                'name' => $validatedData['broker_name'],
                'phone1' => $validatedData['broker_phone1'],
                'phone2' => $validatedData['broker_phone2'],
                'email1' => $validatedData['broker_email1'],
                'email2' => $validatedData['broker_email2'],
                'city' => $validatedData['broker_city'],
                'state' => $validatedData['broker_state'],
                'country' => $validatedData['broker_country'],
                'company_id' => $validatedData['company_id'],
            ];

            $broker = Broker::create($payload);

            return response()->json(['status' => 'success', 'code' => 1, 'message' => 'Broker created successfully', 'data' => $broker], 201);
        }catch(Exception $e){
            return response()->json(['status' => 'failed', 'code' => 0, 'message' => 'Error creating broker: '.$e->getMessage(), 'data' => []], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Broker $broker)
    {
        $broker = $broker->load('company');

        return response()->json(
            [
                'status' => 'success',
                'code' => 1,
                'data' => $broker,
                'message' => 'Broker fetched successfully',
            ], 201
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Broker $broker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Broker $broker)
    {
        try{
            $validatedData = $request->validate([
                'broker_name' => 'required|string|max:100',
                'broker_phone1' => 'nullable|string|unique:brokers,phone1,' . $broker->id,
                'broker_phone2' => 'nullable|string|unique:brokers,phone2,' . $broker->id,
                'broker_email1' => 'nullable|email|unique:brokers,email1,' . $broker->id,
                'broker_email2' => 'nullable|email|unique:brokers,email2,' . $broker->id,
                'broker_city' => 'nullable|string|max:100',
                'broker_state' => 'nullable|string|max:100',
                'broker_country' => 'nullable|string|max:100',
                'company_id' => 'required|exists:companies,id',
            ]);

            $payload = [
                'name' => $validatedData['broker_name'],
                'phone1' => $validatedData['broker_phone1'],
                'phone2' => $validatedData['broker_phone2'],
                'email1' => $validatedData['broker_email1'],
                'email2' => $validatedData['broker_email2'],
                'city' => $validatedData['broker_city'],
                'state' => $validatedData['broker_state'],
                'country' => $validatedData['broker_country'],
                'company_id' => $validatedData['company_id'],
            ];

            $broker = $broker->update($payload);

            return response()->json(['status' => 'success', 'code' => 1, 'message' => 'Broker updated successfully', 'data' => $broker], 201);
        }catch(Exception $e){
            return response()->json(['status' => 'failed', 'code' => 0, 'message' => 'Error updating broker: '.$e->getMessage(), 'data' => []], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Broker $broker)
    {
        $broker->delete();
        return response()->json(['status' => 'success', 'code' => 1, 'message' => 'Broker deleted successfully']);
    }
}
