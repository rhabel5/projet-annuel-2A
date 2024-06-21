<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            Log::info('Authenticated user', ['user' => $user]);
            if ($user) {
                if ($user->hasRole('admin')) {
                    $tickets = Ticket::with('user')->get();
                } else {
                    $tickets = Ticket::where('user_id', $user->id)->with('user')->get();
                }
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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'priority' => 'required|string|in:low,medium,high',
            'tags' => 'array'
        ]);
    
        $ticket = Ticket::create([
            'title' => $request->title,
            'message' => $request->message,
            'status' => 'open',
            'priority' => $request->priority,
            'user_id' => Auth::id(),
        ]);
    
        if ($request->has('tags')) {
            $tags = Tag::whereIn('name', $request->tags)->get();
            $ticket->tags()->sync($tags);
        }
    
        return response()->json($ticket, 201);
    }    

    public function update(Request $request, Ticket $ticket)
    {
        $user = Auth::user();
        if ($user->hasRole('admin') || $ticket->user_id === $user->id) {
            $request->validate([
                'title' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            $ticket->update($request->all());

            return response()->json($ticket, 200);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function destroy(Ticket $ticket)
    {
        $user = Auth::user();
        if ($user->hasRole('admin') || $ticket->user_id === $user->id) {
            $ticket->delete();
            return response()->json(['message' => 'Ticket deleted successfully'], 200);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function changeStatus(Request $request, Ticket $ticket)
    {
        $user = Auth::user();
        if ($user->hasRole('admin') || $ticket->user_id === $user->id) {
            $request->validate([
                'status' => 'required|in:open,closed,on hold,resolved',
            ]);

            $ticket->update(['status' => $request->status]);

            return response()->json(['message' => 'Status updated successfully'], 200);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function respond(Request $request, Ticket $ticket)
    {
        $user = Auth::user();
        if ($user->hasRole('admin') || $ticket->user_id === $user->id) {
            $request->validate([
                'message' => 'required|string',
            ]);

            TicketResponse::create([
                'message' => $request->message,
                'user_id' => $user->id,
                'ticket_id' => $ticket->id,
            ]);

            return response()->json(['message' => 'Response sent successfully'], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $ticket->assigned_to = $user->id;
            $ticket->save();
    
            return response()->json(['message' => 'Ticket assigned successfully'], 200);
        }
    
        return response()->json(['message' => 'Unauthorized'], 403);
    }
    
    public function search(Request $request)
    {
        $query = Ticket::query();

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('message')) {
            $query->where('message', 'like', '%' . $request->message . '%');
        }

        if ($request->has('tags')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->whereIn('name', $request->tags);
            });
        }

        $tickets = $query->get();

        return response()->json($tickets, 200);
    }

    public function show(Ticket $ticket)
    {
        $user = Auth::user();
        if ($user->hasRole('admin') || $ticket->user_id === $user->id) {
            $ticket->load('tags'); // Assurez-vous de charger les tags
            return response()->json($ticket->load('user'), 200);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}