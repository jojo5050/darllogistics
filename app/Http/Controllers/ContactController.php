<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        $contact = Contact::create($validatedData);

        return response()->json(['message' => 'Contact created successfully', 'data' => $contact], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'status' => 'nullable|boolean',
            'reply' => 'nullable|string',
            'date_reply' => 'nullable|date',
        ]);

        $contact->update($validatedData);

        return response()->json(['message' => 'Contact updated successfully', 'data' => $contact]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['message' => 'Contact deleted successfully']);
    }

    /**
     * Send a reply to a contact.
     */
    public function reply(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $validatedData = $request->validate([
            'reply' => 'required|string',
        ]);

        $contact->update([
            'reply' => $validatedData['reply'],
            'date_reply' => now(),
            'status' => true,
        ]);

        return response()->json(['message' => 'Reply sent successfully', 'data' => $contact]);
    }
}
