<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-4xl text-[#1A1108] leading-tight tracking-tight uppercase">
                    KELOLA <span class="text-secondary">EVENT</span>
                </h2>
                <p class="text-accent font-bold uppercase tracking-widest text-[10px] mt-2">Pusat kendali seluruh event dalam sistem Eventify.</p>
            </div>
            <a href="{{ route('events.create') }}" class="bg-[#1A1108] text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-secondary transition-all shadow-xl flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                EVENT BARU
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        @if(session('success'))
            <div class="bg-secondary text-white p-6 rounded-3xl mb-8 font-black uppercase tracking-widest text-xs shadow-lg shadow-secondary-200 flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-secondary/20 overflow-hidden border border-white">
            <div class="p-8 md:p-12">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-[#1A1108]/50 border-b-2 border-gray-50">
                                <th class="px-6 py-4 text-left">The Event</th>
                                <th class="px-6 py-4 text-left">Penyelenggara</th>
                                <th class="px-6 py-4 text-left">Jadwal</th>
                                <th class="px-6 py-4 text-left">Status</th>
                                <th class="px-6 py-4 text-right">Konsol</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($events as $event)
                                <tr class="group hover:bg-secondary/10/30 transition-colors">
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <div class="flex items-center gap-4">
                                            <div class="w-14 h-14 bg-gray-100 rounded-2xl overflow-hidden border-2 border-white shadow-md">
                                                @if($event->banner)
                                                    <img src="{{ asset('storage/' . $event->banner) }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-lg font-black text-primary leading-none mb-1 uppercase tracking-tight">{{ $event->title }}</p>
                                                <p class="text-[10px] font-black text-secondary uppercase tracking-widest">{{ $event->category->name ?? 'Umum' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 font-black text-primary uppercase tracking-widest text-xs">
                                        {{ $event->organizer->name ?? 'Eventify' }}
                                    </td>
                                    <td class="px-6 py-6">
                                        <p class="text-sm font-black text-[#1A1108] tracking-tight uppercase">{{ \Carbon\Carbon::parse($event->start_time)->format('M d, Y') }}</p>
                                        <p class="text-[10px] font-bold text-primary/60 uppercase tracking-widest">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB</p>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex flex-col gap-2">
                                            @if($event->status === 'published')
                                                <span class="inline-flex px-4 py-1.5 rounded-full bg-secondary-100 text-secondary text-[10px] font-black uppercase tracking-widest shadow-sm">Aktif</span>
                                            @else
                                                <span class="inline-flex px-4 py-1.5 rounded-full bg-gray-100 text-gray-400 text-[10px] font-black uppercase tracking-widest shadow-sm">Draft</span>
                                            @endif

                                            @if($event->is_verified)
                                                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-blue-100 text-secondary text-[10px] font-black uppercase tracking-widest shadow-sm">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.9L9.03 17.003a2 2 0 003.456 0l6.865-12.1A2 2 0 0017.657 2H2.343a2 2 0 00-1.734 2.9h1.557z" clip-rule="evenodd"></path></svg>
                                                    Terverifikasi
                                                </span>
                                            @else
                                                <span class="inline-flex px-4 py-1.5 rounded-full bg-amber-100 text-amber-600 text-[10px] font-black uppercase tracking-widest shadow-sm">Menunggu</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-2">
                                            @if(Auth::user()->role === 'admin' && !$event->is_verified)
                                                <form action="{{ route('events.verify', $event->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="p-3 bg-secondary rounded-xl text-white hover:bg-[#1A1108] hover:shadow-lg transition flex items-center gap-2 font-black uppercase text-[10px] tracking-widest leading-none">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                        VERIFIKASI
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('events.show', $event->id) }}" class="p-3 bg-[#1A1108]/5 hover:bg-secondary hover:text-white rounded-xl text-primary transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                            <a href="{{ route('events.edit', $event->id) }}" class="p-3 bg-[#1A1108]/5 hover:bg-secondary hover:text-white rounded-xl text-primary transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus event ini selamanya?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-3 bg-rose-50 hover:bg-rose-600 hover:text-white rounded-xl text-rose-500 transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-20 text-center">
                                        <p class="text-gray-300 font-black uppercase tracking-tight">Belum Ada Data</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($events->hasPages())
                    <div class="mt-12 bg-gray-50 p-6 rounded-3xl border border-gray-100">
                        {{ $events->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
