<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $query = Event::with(['organizer', 'category'])->latest();
        
        if ($user->role === 'organizer') {
            $query->where('organizer_id', $user->id);
        }

        $events = $query->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $organizers = User::where('role', 'organizer')->get();
        return view('admin.events.create', compact('categories', 'organizers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'venue' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'banner' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published,cancelled,completed',
            'ticket_link' => 'nullable|url'
        ];

        if ($user->role === 'admin') {
            $rules['organizer_id'] = 'required|exists:users,id';
        }

        $validated = $request->validate($rules);

        if ($user->role === 'organizer') {
            $validated['organizer_id'] = $user->id;
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('banners', 'public');
        }

        // Sync event_date with start_time
        $validated['event_date'] = date('Y-m-d', strtotime($validated['start_time']));

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $user = auth()->user();
        if ($user->role === 'organizer' && $event->organizer_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke event ini.');
        }

        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $user = auth()->user();
        if ($user->role === 'organizer' && $event->organizer_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke event ini.');
        }

        $categories = Category::all();
        $organizers = User::where('role', 'organizer')->get();
        return view('admin.events.edit', compact('event', 'categories', 'organizers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $user = auth()->user();
        if ($user->role === 'organizer' && $event->organizer_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke event ini.');
        }

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'venue' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'banner' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published,cancelled,completed',
            'ticket_link' => 'nullable|url'
        ];

        if ($user->role === 'admin') {
            $rules['organizer_id'] = 'required|exists:users,id';
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('banner')) {
            if ($event->banner) {
                Storage::disk('public')->delete($event->banner);
            }
            $validated['banner'] = $request->file('banner')->store('banners', 'public');
        }

        // Sync event_date with start_time
        $validated['event_date'] = date('Y-m-d', strtotime($validated['start_time']));

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $user = auth()->user();
        if ($user->role === 'organizer' && $event->organizer_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke event ini.');
        }

        if ($event->banner) {
            Storage::disk('public')->delete($event->banner);
        }
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
    }

    public function verify(Event $event)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $event->update(['is_verified' => true]);

        return back()->with('success', 'Event "' . $event->title . '" telah diverifikasi.');
    }
}
