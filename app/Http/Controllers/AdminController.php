<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // SHOW SCAN FORM
    public function scanForm()
    {
        $user = auth()->user();
        $query = Ticket::where('checked_in', true);

        if ($user->role === 'organizer') {
            $query->whereHas('ticketType.event', function($q) use ($user) {
                $q->where('organizer_id', $user->id);
            });
        }

        $totalScans = (clone $query)->count();
        $todayScans = (clone $query)->whereDate('updated_at', today())->count();

        return view('admin.scan.index', compact('totalScans', 'todayScans'));
    }

    // PROCESS SCAN (SIMULATED BY SUBMITTING CODE)
    public function validateTicket(Request $request)
    {
        $request->validate([
            'ticket_code' => 'required|string'
        ]);

        $user = auth()->user();
        // Membersihkan kode tiket
        $code = strtoupper(trim(str_replace('#', '', $request->ticket_code)));

        $ticket = Ticket::with(['ticketType.event', 'user'])
                        ->where('ticket_code', $code)
                        ->first();

        if (!$ticket) {
            return back()->with('error', 'KODE TIKET TIDAK VALID. Data tidak ditemukan dalam sistem kami.');
        }

        // Role-based authorization for organizers
        if ($user->role === 'organizer' && $ticket->ticketType->event->organizer_id !== $user->id) {
            return back()->with('error', 'AKSES DITOLAK. Anda tidak memiliki otoritas untuk memvalidasi tiket milik event penyelenggara lain.');
        }

        if ($ticket->checked_in) {
            return back()->with('error', "PERINGATAN! Tiket ini sudah pernah digunakan (Check-in) pada {$ticket->updated_at->format('d M Y, H:i')} WIB.");
        }
        
        // Mark as checked in
        $ticket->update(['checked_in' => true]);

        return back()->with('success', "VERIFIKASI BERHASIL! Selamat Datang, {$ticket->user->name}. Akses diizinkan untuk {$ticket->ticketType->event->title} (Kategori: {$ticket->ticketType->name}). Silakan masuk.");
    }
}
