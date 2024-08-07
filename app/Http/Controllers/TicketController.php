<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $tags = Tag::all(); // Récupère tous les tags
        return view('tickets.create', compact('tags'));
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
            $tags = Tag::find($request->tags);
            $ticket->tags()->sync($tags);
        }
    
        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }    

    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $ticket->update($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }

    public function changeStatus(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $request->validate([
            'status' => 'required|string|in:open,closed,on hold',
        ]);

        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->route('tickets.index')->with('success', 'Ticket status updated successfully.');
    }

    public function respond(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $request->validate([
            'message' => 'required|string',
        ]);

        $ticket->responses()->create([
            'message' => $request->message,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tickets.show', $ticket)->with('success', 'Response sent successfully.');
    }
}