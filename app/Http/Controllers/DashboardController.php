<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Transaction;
use App\Models\Ticket;
use App\Models\Waitlist;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $totalEvents = Event::count();
            $totalTickets = Ticket::count();
            $totalRevenue = Transaction::where('status', 'paid')->sum('total_amount');
            
            $recentEvents = Event::with('category')->latest()->take(5)->get();
            
            // For Chart: Last 7 Days Revenue
            $salesData = Transaction::where('status', 'paid')
                ->where('created_at', '>=', now()->subDays(7))
                ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();
            
            $chartLabels = $salesData->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M'))->toArray();
            $chartValues = $salesData->pluck('total')->toArray();

            return view('dashboard', compact('totalEvents', 'totalTickets', 'totalRevenue', 'chartLabels', 'chartValues', 'recentEvents'));

        } elseif ($user->isOrganizer()) {
            $myEventIds = Event::where('organizer_id', $user->id)->pluck('id');
            $activeEvents = $myEventIds->count();
            
            $recentEvents = Event::where('organizer_id', $user->id)->with('category')->latest()->take(5)->get();

            $transactions = Transaction::whereIn('event_id', $myEventIds)->where('status', 'paid');
            $totalRevenue = $transactions->sum('total_amount');
            
            $ticketsSold = Ticket::whereHas('transaction', function($q) use ($myEventIds) {
                $q->whereIn('event_id', $myEventIds)->where('status', 'paid');
            })->count();

            // For Chart: Their Event Sales Last 7 Days
            $salesData = Transaction::whereIn('event_id', $myEventIds)
                ->where('status', 'paid')
                ->where('created_at', '>=', now()->subDays(7))
                ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();

            $chartLabels = $salesData->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M'))->toArray();
            $chartValues = $salesData->pluck('total')->toArray();

            return view('dashboard', compact('activeEvents', 'ticketsSold', 'totalRevenue', 'chartLabels', 'chartValues', 'recentEvents'));
        } else {
            // User Dashboard
            $events = Event::with(['category', 'ticketTypes'])
                            ->where('status', 'published')
                            ->where('is_verified', true)
                            ->orderBy('start_time', 'asc')
                            ->get();
            
            $myTickets = Ticket::where('user_id', $user->id)->count();
            
            // Mengambil data waitlist user untuk notifikasi
            $myWaitlists = Waitlist::where('user_id', $user->id)
                                ->with(['event', 'ticketType'])
                                ->orderBy('updated_at', 'desc')
                                ->get();
            
            return view('dashboard', compact('events', 'myTickets', 'myWaitlists'));
        }
    }
}
