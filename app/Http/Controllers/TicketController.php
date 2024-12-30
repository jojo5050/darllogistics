<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return response()->json($tickets, 200);
    }

    public function userTickets(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $tickets = Ticket::where('user_id', $validatedData['user_id'])->get();

        if ($tickets->isEmpty()) {
            return response()->json(['message' => 'No tickets found for this user.'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User tickets retrieved successfully.',
            'data' => $tickets,
        ], 200);
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'nullable|string|in:open,closed,pending', // Status validation
        ]);

        $ticket = Ticket::create($validatedData);

        return response()->json([
            'message' => 'Ticket created successfully.',
            'ticket' => $ticket,
        ], 201);
    }

    /**
     * Display the specified ticket.
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found.'], 404);
        }

        return response()->json($ticket, 200);
    }

    /**
     * Update the specified ticket in storage.
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found.'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:open,closed,pending', // Ensure valid status
        ]);

        $ticket->update($validatedData);

        return response()->json([
            'message' => 'Ticket updated successfully.',
            'ticket' => $ticket,
        ], 200);
    }

    /**
     * Remove the specified ticket from storage.
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found.'], 404);
        }

        $ticket->delete();

        return response()->json(['message' => 'Ticket deleted successfully.'], 200);
    }
}
