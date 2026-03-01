<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-2xl text-white uppercase tracking-tight">
                DAFTAR <span class="text-secondary">EVENT SAYA</span>
            </h2>
            <a href="{{ route('events.create') }}" class="bg-secondary hover:bg-black text-white px-6 py-3 rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl shadow-secondary/20 transition-all transform hover:-translate-y-1">
                + BUAT EVENT BARU
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($events as $event)
                    <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl shadow-secondary/20 border border-white group transform hover:scale-[1.03] transition-all">
                        <div class="h-48 bg-gray-100 relative overflow-hidden">
                            @if($event->banner)
                                <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->title }}" class="w-full h-full object-cover transition-transform group-hover:scale-110 duration-700">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-secondary/20 to-secondary/10 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-buff opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4">
                                <span class="bg-white/90 backdrop-blur-md px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest text-secondary shadow-xl border border-white">
                                    {{ $event->category->name ?? $event->category }}
                                </span>
                            </div>
                        </div>

                        <div class="p-8">
                            <h3 class="text-xl font-black text-primary uppercase tracking-tighter mb-4 leading-tight group-hover:text-secondary transition-colors">{{ $event->title }}</h3>
                            
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center border border-gray-100">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    </div>
                                    <p class="text-xs font-bold text-gray-600 uppercase tracking-tight">{{ $event->city }}</p>
                                </div>
                                
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center border border-gray-100">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    </div>
                                    <p class="text-xs font-bold text-gray-600 uppercase tracking-tight">{{ $event->quota }} Kapasitas</p>
                                </div>
                            </div>
                            
                            <div class="mt-8 pt-6 border-t border-dashed border-gray-100 flex items-center justify-between">
                                <div class="flex gap-2">
                                    <a href="{{ route('events.edit', $event->id) }}" class="p-3 bg-gray-50 hover:bg-amber-100 text-gray-400 hover:text-amber-600 rounded-xl transition-all border border-gray-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-3 bg-gray-50 hover:bg-rose-100 text-gray-400 hover:text-rose-600 rounded-xl transition-all border border-gray-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                                <a href="{{ route('events.show', $event->id) }}" class="text-[10px] font-black uppercase tracking-widest text-secondary hover:underline">Detail Event &rarr;</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 bg-white rounded-[3rem] border-2 border-dashed border-gray-100 flex flex-col items-center">
                        <div class="w-20 h-20 rounded-full bg-secondary/10 flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-buff" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <p class="text-lg font-black text-primary uppercase tracking-tighter mb-2">Belum ada event</p>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-8 text-center px-8">Mulai publikasikan event Anda sekarang dengan menekan tombol plus di atas.</p>
                        <a href="{{ route('events.create') }}" class="px-8 py-4 bg-secondary text-white rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl shadow-secondary/20 transition-all hover:bg-black">
                            Mulai Sekarang
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
