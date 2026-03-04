<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketCheckController extends Controller
{
    public function index()
    {
        return view('user.scan.index');
    }

    public function check(Request $request)
    {
        $request->validate([
            'ticket_code' => 'required|string'
        ]);

        // Membersihkan kode tiket dari spasi dan tanda '#'
        $code = strtoupper(trim(str_replace('#', '', $request->ticket_code)));

        $ticket = Ticket::with(['ticketType.event', 'user'])
                        ->where('ticket_code', $code)
                        ->first();

        if (!$ticket) {
            return back()->with('error', 'KODE TIKET TIDAK VALID.');
        }

        // For user scan, we assume it's self-service at the venue
        if ($ticket->checked_in) {
            return back()->with('error', "Tiket ini sudah pernah digunakan (Check-in) pada {$ticket->updated_at->format('d M Y, H:i')} WIB.");
        }
        
        $ticket->update(['checked_in' => true]);

        return back()->with('success', "CHECK-IN BERHASIL! Selamat Datang di {$ticket->ticketType->event->title}.");
    }
}
