<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Event;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function exportDashboard(Request $request)
    {
        $user = auth()->user();
        $totalRevenue = 0;
        $totalTickets = 0;
        $events = [];

        if ($user->isAdmin()) {
            $totalRevenue = Transaction::where('status', 'paid')->sum('total_amount');
            $totalTickets = Transaction::where('status', 'paid')->count();
            $events = Event::with('category')->latest()->get();
        } elseif ($user->isOrganizer()) {
            $myEventIds = Event::where('organizer_id', $user->id)->pluck('id');
            $totalRevenue = Transaction::whereIn('event_id', $myEventIds)->where('status', 'paid')->sum('total_amount');
            $totalTickets = Transaction::whereIn('event_id', $myEventIds)->where('status', 'paid')->count();
            $events = Event::where('organizer_id', $user->id)->with('category')->latest()->get();
        }

        $data = [
            'title' => 'Laporan Penjualan Eventify',
            'date' => date('d M Y'),
            'user' => $user->name,
            'totalRevenue' => $totalRevenue,
            'totalTickets' => $totalTickets,
            'events' => $events
        ];

        $pdf = Pdf::loadView('admin.reports.dashboard', $data);
        return $pdf->download('laporan-penjualan-' . date('Ymd') . '.pdf');
    }
}
