<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-white uppercase tracking-tight">
                DETAIL <span class="text-secondary">EVENT</span>
            </h2>
            <a href="{{ route('events.index') }}" class="text-pearl hover:text-white font-black uppercase text-xs transition-colors flex items-center gap-2">
                &larr; KEMBALI KE DAFTAR
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Event Basic Info -->
            <div class="bg-white rounded-[3rem] shadow-2xl shadow-secondary/20 overflow-hidden border border-white mb-10 group">
                <div class="relative h-[400px]">
                    @if($event->banner)
                        <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-secondary to-secondary"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-12">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="bg-secondary text-white text-[10px] font-black uppercase px-4 py-2 rounded-xl tracking-widest shadow-xl">{{ $event->category->name ?? 'Kategori' }}</span>
                            <span class="bg-white/20 backdrop-blur-md text-white text-[10px] font-black uppercase px-4 py-2 rounded-xl tracking-widest border border-white/20">{{ strtoupper($event->status) }}</span>
                        </div>
                        <h3 class="text-5xl font-black text-white uppercase tracking-tighter mb-4">{{ $event->title }}</h3>
                        <div class="flex flex-wrap gap-8 text-white/80 text-[10px] font-black uppercase tracking-widest">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ \Carbon\Carbon::parse($event->start_time)->format('d M Y, H:i') }}
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                {{ $event->venue }}, {{ $event->city }}
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Oleh: {{ $event->organizer->name ?? 'System' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-12">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                        <div class="lg:col-span-2">
                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 flex items-center gap-3">
                                <span class="w-2 h-4 bg-secondary rounded-full"></span>
                                Deskripsi Event
                            </h4>
                            <div class="prose prose-secondary max-w-none text-gray-600 font-medium leading-relaxed">
                                {!! nl2br(e($event->description)) !!}
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-[2.5rem] p-8 border border-gray-100 h-fit">
                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6">Tautan Eksternal</h4>
                            @if($event->ticket_link)
                                <a href="{{ $event->ticket_link }}" target="_blank" class="flex items-center justify-between bg-white p-6 rounded-3xl border-2 border-secondary/20 text-secondary font-black uppercase text-xs hover:bg-secondary hover:text-white transition-all shadow-xl shadow-secondary/20 group">
                                    Link Tiket Eksternal
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            @else
                                <p class="text-xs font-bold text-gray-400 uppercase italic">Tidak ada tautan eksternal.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Types Management -->
            <div class="bg-white rounded-[3rem] shadow-2xl shadow-secondary/20 overflow-hidden border border-white mb-10">
                <div class="p-12">
                    <div class="flex items-center justify-between mb-10">
                        <h4 class="text-2xl font-black text-primary uppercase tracking-tight flex items-center gap-3">
                            <span class="w-2 h-8 bg-secondary rounded-full"></span>
                            Tipe Tiket & Harga
                        </h4>
                    </div>

                    @if(session('success'))
                        <div class="bg-secondary-50 border border-secondary-100 text-secondary px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 text-xs font-bold uppercase tracking-widest">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto mb-12">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left border-b border-gray-100">
                                    <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Nama Tiket</th>
                                    <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Harga</th>
                                    <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Kapasitas</th>
                                    <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($event->ticketTypes as $ticketType)
                                    <tr class="group">
                                        <td class="px-6 py-6">
                                            <p class="text-sm font-black text-primary uppercase tracking-tight">{{ $ticketType->name }}</p>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">{{ $ticketType->description }}</p>
                                        </td>
                                        <td class="px-6 py-6 font-black text-secondary">
                                            Rp {{ number_format($ticketType->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-6">
                                            <span class="bg-gray-50 px-4 py-2 rounded-xl text-xs font-black text-gray-600 border border-gray-100">
                                                {{ $ticketType->quota }} Tiket
                                            </span>
                                        </td>
                                        <td class="px-6 py-6">
                                            <form action="{{ route('events.ticket-types.destroy', [$event->id, $ticketType->id]) }}" method="POST" onsubmit="return confirm('Hapus tipe tiket ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-500 hover:text-white bg-rose-50 hover:bg-rose-500 p-3 rounded-xl transition-all border border-rose-100">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest italic">
                                            Belum ada tipe tiket yang dibuat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Add Ticket Form -->
                    <div class="bg-secondary/10/50 p-10 rounded-[2.5rem] border border-secondary/20">
                        <h5 class="text-[10px] font-black text-secondary uppercase tracking-[0.3em] mb-8">Tambah Tipe Tiket Baru</h5>
                        <form action="{{ route('events.ticket-types.store', $event->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                            @csrf
                            <div class="md:col-span-1 group">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">Nama</label>
                                <input type="text" name="name" class="w-full bg-white border-2 border-secondary/10 focus:border-secondary focus:ring-0 rounded-2xl px-5 py-4 font-bold text-xs" required placeholder="Contoh: VIP/Gold">
                            </div>
                            <div class="md:col-span-1 group">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">Harga (IDR)</label>
                                <input type="number" name="price" class="w-full bg-white border-2 border-secondary/10 focus:border-secondary focus:ring-0 rounded-2xl px-5 py-4 font-bold text-xs" required placeholder="Contoh: 150000">
                            </div>
                            <div class="md:col-span-1 group">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">Kuota</label>
                                <input type="number" name="quota" class="w-full bg-white border-2 border-secondary/10 focus:border-secondary focus:ring-0 rounded-2xl px-5 py-4 font-bold text-xs" required min="1" placeholder="Contoh: 50">
                            </div>
                            <div class="md:col-span-1">
                                <button type="submit" class="bg-secondary hover:bg-black text-white w-full rounded-2xl py-5 font-black uppercase tracking-widest text-[10px] shadow-xl shadow-secondary/20 transition-all transform hover:-translate-y-1 active:scale-95">
                                    TAMBAH TIKET
                                </button>
                            </div>
                            <div class="md:col-span-4 group mt-2">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors">Deskripsi Singkat (Opsional)</label>
                                <input type="text" name="description" class="w-full bg-white border-2 border-secondary/10 focus:border-secondary focus:ring-0 rounded-2xl px-5 py-4 font-bold text-xs" placeholder="Contoh: Akses Baris Depan + Minum">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
