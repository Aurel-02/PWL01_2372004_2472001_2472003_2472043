<?php

namespace App\Http\Controllers;

use App\Models\Waitlist;
use App\Models\Event;
use Illuminate\Http\Request;

class WaitlistController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'user') {
            abort(403);
        }

        $query = Waitlist::with(['user', 'event', 'ticketType'])->latest();

        if ($user->role === 'organizer') {
            $query->whereHas('event', function($q) use ($user) {
                $q->where('organizer_id', $user->id);
            });
        }

        $waitlists = $query->paginate(15);
        return view('admin.waitlists.index', compact('waitlists'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'ticket_type_id' => 'required|exists:ticket_types,id',
        ]);

        // Check if already in waitlist
        $exists = Waitlist::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->where('ticket_type_id', $request->ticket_type_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah terdaftar di waiting list untuk tiket ini.');
        }

        Waitlist::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'ticket_type_id' => $request->ticket_type_id,
            'status' => 'waiting',
        ]);

        return back()->with('success', 'Berhasil bergabung ke waiting list. Kami akan mengabari Anda jika tiket tersedia.');
    }

    public function promote(Waitlist $waitlist)
    {
        $user = auth()->user();
        if ($user->role === 'organizer' && $waitlist->event->organizer_id !== $user->id) {
            abort(403);
        }

        $waitlist->update(['status' => 'notified']);
        
        // Mock notification logic here
        
        return back()->with('success', 'User ' . $waitlist->user->name . ' telah dinotifikasi.');
    }
}
