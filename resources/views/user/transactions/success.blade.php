<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-2xl text-white uppercase tracking-tight">
                PEMBAYARAN <span class="text-secondary">BERHASIL</span>
            </h2>
            <a href="{{ route('dashboard') }}" class="text-pearl font-black uppercase text-xs hover:text-white transition-colors">&larr; Beranda</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-secondary rounded-[3rem] p-12 text-center text-white mb-12 shadow-2xl relative overflow-hidden border border-white/10">
                <div class="absolute inset-0 bg-gradient-to-r from-buff/20 to-accent/20 blur-3xl rounded-full scale-150 animate-pulse"></div>
                
                <div class="flex items-center justify-center w-24 h-24 rounded-full bg-white/10 mx-auto mb-8 border-4 border-white/20 relative z-10 shadow-xl">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                
                <h3 class="text-4xl font-black mb-4 relative z-10 uppercase tracking-tighter">Terima Kasih Atas Pembelian Anda!</h3>
                <p class="text-xl opacity-80 relative z-10 font-medium">Transaksi Anda telah berhasil diproses. Silakan lihat E-Tiket Anda di bawah ini.</p>
            </div>

            <h4 class="text-2xl font-black text-primary mb-8 uppercase tracking-tight flex items-center gap-3">
                <span class="w-2 h-8 bg-secondary rounded-full"></span>
                E-Tiket Anda
            </h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($transaction->tickets as $ticket)
                    <!-- Ticket Design -->
                    <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl border border-gray-100 transform hover:scale-[1.02] transition-all flex flex-col h-full relative group">
                        <!-- Perforation dots decoration -->
                        <div class="absolute top-1/2 -left-3 w-6 h-6 bg-gray-50 rounded-full border border-gray-100 z-10"></div>
                        <div class="absolute top-1/2 -right-3 w-6 h-6 bg-gray-50 rounded-full border border-gray-100 z-10"></div>
                        
                        <div class="p-8 flex-grow">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <span class="bg-secondary/10 text-secondary text-[10px] font-black uppercase px-3 py-1.5 rounded-lg tracking-[0.2em] border border-secondary/20 inline-block mb-3 transition-colors group-hover:bg-secondary group-hover:text-white">{{ $ticket->ticketType->name }}</span>
                                    <h5 class="text-2xl font-black text-primary leading-none uppercase tracking-tighter mb-1">{{ $transaction->event->title }}</h5>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $transaction->event->city }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-6 mt-8">
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Lokasi</p>
                                    <p class="text-xs font-bold text-gray-800 leading-snug">{{ $transaction->event->venue }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Waktu</p>
                                    <p class="text-xs font-bold text-gray-800">{{ \Carbon\Carbon::parse($transaction->event->start_time)->format('d M Y, H:i') }} WIB</p>
                                </div>
                            </div>
                            
                            <div class="mt-8 pt-6 border-t border-dashed border-gray-100">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Pemegang Tiket</p>
                                <p class="text-sm font-black text-secondary uppercase tracking-tight">{{ auth()->user()->name }}</p>
                            </div>
                        </div>

                        <!-- Lower Section (QR Code Area) -->
                        <div class="bg-secondary/10/30 p-8 flex flex-col items-center justify-center border-t-2 border-dashed border-gray-100 text-center">
                            <div class="bg-white p-4 rounded-3xl shadow-xl border border-gray-100 mb-4 transition transform group-hover:rotate-1 group-hover:scale-105">
                                {!! QrCode::size(120)->generate($ticket->ticket_code) !!}
                            </div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.5em]">{{ $ticket->ticket_code }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-16 text-center space-y-6">
                <div class="inline-block bg-gray-50 border border-gray-100 px-8 py-6 rounded-[2rem] max-w-xl">
                    <p class="text-gray-500 font-bold text-sm leading-relaxed">
                        E-Tiket telah disimpan di akun Anda. Anda dapat mengaksesnya kapan saja di bagian 
                        <a href="{{ route('user.tickets') }}" class="text-secondary hover:text-secondary-800 transition-colors underline decoration-2">Tiket Saya</a>.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <button onclick="window.print()" class="px-10 py-5 bg-white border-2 border-gray-100 text-primary font-black uppercase tracking-widest rounded-2xl hover:bg-gray-50 transition-all flex items-center gap-2 text-xs shadow-xl shadow-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        CETAK / SIMPAN PDF
                    </button>
                    <a href="{{ route('dashboard') }}" class="px-10 py-5 bg-secondary text-white font-black uppercase tracking-widest rounded-2xl hover:bg-black transition-all text-xs shadow-xl shadow-secondary/20">
                        BERANDA SEKARANG &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
