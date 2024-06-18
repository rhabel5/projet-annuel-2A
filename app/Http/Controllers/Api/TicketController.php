<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    /**
     * Display a listing of the tickets.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            Log::info('Authenticated user', ['user' => $user]);
            if ($user) {
                $tickets = Ticket::where('user_id', $user->id)->get();
                Log::info('Tickets fetched successfully', ['tickets' => $tickets]);
                return response()->json($tickets, 200);
            } else {
                Log::warning('User not authenticated');
                return response()->json(['message' => 'User not authenticated'], 401);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching tickets: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'title' => $request->title,
            'message' => $request->message,
            'status' => 'open',
            'user_id' => Auth::id(),
        ]);

        return response()->json($ticket, 201);
    }

    /**
     * Display the specified ticket.
     */
    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($ticket, 200);
    }

    /**
     * Update the specified ticket in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $ticket->update($request->all());

        return response()->json($ticket, 200);
    }

    /**
     * Remove the specified ticket from storage.
     */
    public function destroy(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $ticket->delete();
        return response()->json(['message' => 'Ticket deleted successfully'], 200);
    }

    /**
     * Change the status of the specified ticket.
     */
    public function changeStatus(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'status' => 'required|in:open,closed,on hold',
        ]);

        $ticket->update(['status' => $request->status]);

        return response()->json(['message' => 'Status updated successfully'], 200);
    }

    /**
     * Respond to a ticket.
     */
    public function respond(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        $ticket->responses()->create([
            'message' => $request->message,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'Response sent successfully'], 200);
    }
}