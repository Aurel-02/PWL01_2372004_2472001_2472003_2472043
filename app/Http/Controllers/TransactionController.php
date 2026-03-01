<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\TicketType;
use App\Models\Transaction;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // SHOW EVENT DETIAL TO USER
    public function show(Event $event)
    {
        // Pastikan event published
        if ($event->status !== 'published') {
            return redirect()->route('dashboard')->with('error', 'Event tidak tersedia saat ini.');
        }

        return view('user.events.show', compact('event'));
    }

    // PROCESS TICKET SELECTION
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'quantity' => 'required|integer|min:1|max:5' // Max 5 tickets per txn
        ]);

        $ticketType = TicketType::findOrFail($request->ticket_type_id);
        
        // Cek Kuota & Waitlist (Basic implementation: reject if insufficient)
        if ($ticketType->quota < $request->quantity) {
            return back()->with('error', 'Kapasitas tiket tidak mencukupi. Silakan pilih jumlah yang lebih sedikit.');
        }

        // Hitung total dengan pajak/fee simulasi (opsional, disini 0)
        $totalAmount = $ticketType->price * $request->quantity;

        // Bikin transaksi pending
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_url' => Str::random(10), // fake link
        ]);

        // Simpan tiket sementara dalam session / format text biar mudah digenerate nanti pas paid
        session([
            'pending_trx_id' => $transaction->id,
            'selected_ticket_type_id' => $ticketType->id,
            'qty' => $request->quantity
        ]);

        return redirect()->route('transactions.payment', $transaction->id);
    }

    // SHOW PAYMENT SIMULATION
    public function payment(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id() || $transaction->status !== 'pending') {
            abort(403, 'Akses transaksi tidak valid.');
        }
        
        return view('user.transactions.payment', compact('transaction'));
    }

    // PROCESS PAYMENT (SIMULATED GATEWAY)
    public function processPayment(Request $request, Transaction $transaction)
    {
        if ($transaction->status !== 'pending') {
            return redirect()->route('dashboard')->with('error', 'Transaksi sudah pernah diproses.');
        }

        $user = auth()->user();

        // Check Balance
        if ($user->balance < $transaction->total_amount) {
            return back()->with('error', 'Saldo tidak mencukupi. Silakan isi saldo Anda terlebih dahulu.');
        }

        DB::beginTransaction();
        try {
            // Deduct Balance
            $user->balance -= $transaction->total_amount;
            $user->save();

            // Update transaksi jadi PAID
            $transaction->update(['status' => 'paid']);

            // Ambil data qty & tickettype
            $qty = session('qty');
            $ticketTypeId = session('selected_ticket_type_id');
            $ticketType = TicketType::findOrFail($ticketTypeId);

            // Double check kuota biar aman
            if ($ticketType->quota < $qty) {
                // Refund scenario (mock)
                throw new \Exception('Tiket habis saat proses checkout.');
            }

            // Kurangi stok
            $ticketType->decrement('quota', $qty);

            // Generate e-tickets (QR Code / Ticket Code)
            for ($i = 0; $i < $qty; $i++) {
                $code = strtoupper(Str::random(12));
                Ticket::create([
                    'transaction_id' => $transaction->id,
                    'event_id' => $transaction->event_id,
                    'ticket_type_id' => $ticketTypeId,
                    'user_id' => auth()->id(),
                    'ticket_code' => "TIX-{$transaction->event_id}-{$code}",
                    'status' => 'valid',
                    'checked_in' => false,
                ]);
            }

            // Cleanup session
            session()->forget(['pending_trx_id', 'selected_ticket_type_id', 'qty']);

            DB::commit();

            // Kirim Email E-Ticket
            try {
                // Check if TicketMail exists before sending
                if (class_exists('App\Mail\TicketMail')) {
                    \Illuminate\Support\Facades\Mail::to($transaction->user->email)->send(new \App\Mail\TicketMail($transaction));
                }
            } catch (\Exception $e) {
                // Log error but don't fail the transaction
                \Illuminate\Support\Facades\Log::error('Email failed: ' . $e->getMessage());
            }

            return redirect()->route('transactions.success', $transaction->id);

        } catch (\Exception $e) {
            DB::rollBack();
            // Refund balance if failed (auto-reverts because of transaction but let's be safe if it happened outside)
            // But here it's inside DB transaction so it's fine.
            return redirect()->route('dashboard')->with('error', $e->getMessage());
        }
    }

    // SHOW SUCCESS PAGE + E-TICKET
    public function success(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id() || $transaction->status !== 'paid') {
            abort(403);
        }

        $transaction->load('tickets.ticketType', 'event');

        return view('user.transactions.success', compact('transaction'));
    }
    
    // VIEW MY TICKETS (USER DB)
    public function myTickets()
    {
        $tickets = Ticket::with(['event', 'ticketType'])
                        ->where('user_id', auth()->id())
                        ->orderBy('created_at', 'desc')
                        ->get();
                        
        return view('user.tickets.index', compact('tickets'));
    }
}
