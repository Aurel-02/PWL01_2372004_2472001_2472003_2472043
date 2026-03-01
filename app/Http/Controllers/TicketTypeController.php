<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\TicketType;

class TicketTypeController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        $event->ticketTypes()->create($validated);

        return back()->with('success', 'Ticket Type added successfully.');
    }

    public function destroy(Event $event, TicketType $ticketType)
    {
        $ticketType->delete();
        return back()->with('success', 'Ticket Type removed successfully.');
    }
}
