<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-4xl text-white leading-tight tracking-tight uppercase">
            DAFTAR <span class="text-secondary">TIKET SAYA</span>
        </h2>
        <p class="text-pearl font-bold uppercase tracking-widest text-[10px] mt-2">Seluruh tiket event aktif Anda tersimpan rapi di sini.</p>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($tickets as $ticket)
                <div class="relative group">
                    <!-- Ticket Glow Effect -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-secondary to-accent rounded-[2.5rem] blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                    
                    <div class="relative bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-pearl/20 flex flex-col xl:flex-row h-full">
                        <!-- Left Side (Event Info) -->
                        <div class="p-8 flex-grow">
                            <div class="flex justify-between items-start mb-6">
                                <span class="bg-secondary/10 text-secondary text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-widest">{{ $ticket->event->category->name ?? 'Akses Masuk' }}</span>
                                <p class="text-[10px] font-black text-gray-400 border border-gray-100 px-3 py-1 rounded-lg uppercase tracking-widest">#{{ $ticket->ticket_code }}</p>
                            </div>
                            
                            <h3 class="text-3xl font-black text-primary tracking-tight uppercase leading-none mb-2">{{ $ticket->event->title }}</h3>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-6">{{ $ticket->event->venue }}, {{ $ticket->event->city }}</p>

                            <div class="grid grid-cols-2 gap-4 mb-8">
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Jenis Tiket</p>
                                    <p class="font-black text-secondary uppercase">{{ $ticket->ticketType->name }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tanggal</p>
                                    <p class="font-black text-primary uppercase">{{ \Carbon\Carbon::parse($ticket->event->start_time)->format('M d, Y') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 pt-6 border-t border-gray-50 mt-auto">
                                @if($ticket->checked_in)
                                     <div class="flex items-center gap-2 text-rose-500 font-black text-xs uppercase tracking-widest">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Sudah Digunakan
                                    </div>
                                @else
                                    <div class="flex items-center gap-2 text-secondary font-black text-xs uppercase tracking-widest">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Tiket Valid
                                    </div>
                                @endif
                                <a href="{{ route('transactions.success', $ticket->transaction_id) }}" class="ml-auto text-secondary hover:text-accent font-black text-[10px] uppercase tracking-widest">Lihat Bukti &rarr;</a>
                            </div>
                        </div>

                        <!-- Right Side (QR Section) -->
                        <div class="bg-accent w-full xl:w-64 p-8 flex flex-col items-center justify-center border-l border-white/5 relative overflow-hidden">
                            <!-- Artistic Background Element -->
                            <div class="absolute inset-0 opacity-10 pointer-events-none">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-secondary rounded-full blur-3xl"></div>
                                <div class="absolute bottom-0 left-0 w-32 h-32 bg-accent rounded-full blur-3xl"></div>
                            </div>

                            <div class="bg-white p-3 rounded-3xl shadow-2xl relative z-10 mb-6 font-sans">
                                {!! QrCode::size(120)->generate($ticket->ticket_code) !!}
                            </div>
                            
                            <p class="text-white text-[10px] font-black uppercase tracking-[0.3em] opacity-50 mb-6 font-sans">Scan di Pintu Masuk</p>
                            
                            <button onclick="window.print()" class="w-full bg-white/10 hover:bg-white/20 text-white font-black uppercase text-[10px] tracking-widest py-3 rounded-xl transition backdrop-blur-md border border-white/10">
                                Simpan Tiket
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 text-center py-32 bg-white rounded-[3rem] shadow-2xl border border-dashed border-gray-200">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-primary tracking-tight uppercase">Belum Ada Tiket</h3>
                    <p class="text-gray-400 font-bold text-xs uppercase tracking-widest mt-2">Daftar tiket Anda akan muncul di sini setelah pembelian.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
