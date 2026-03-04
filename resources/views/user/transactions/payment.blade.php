<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-white uppercase tracking-tight">
            SIMULASI <span class="text-secondary">PEMBAYARAN</span>
        </h2>
    </x-slot>

    <div class="py-12 px-4" x-data="{ showError: {{ session('error') ? 'true' : 'false' }} }">
        <!-- Error Modal (Saldo Tidak Cukup) -->
        <div x-show="showError" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-cloak>
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="showError = false"></div>
            
            <!-- Modal Content -->
            <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-md relative z-10 overflow-hidden border border-rose-100"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="scale-90 opacity-0"
                 x-transition:enter-end="scale-100 opacity-100">
                
                <div class="p-10 text-center">
                    <div class="w-20 h-20 bg-rose-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 text-rose-500 border border-rose-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    
                    <h4 class="text-2xl font-black text-primary uppercase tracking-tight mb-2">PEMBELIAN <span class="text-rose-600">GAGAL</span></h4>
                    <p class="text-gray-500 font-bold text-xs uppercase tracking-widest mb-8 leading-relaxed">
                        {{ session('error') }}
                    </p>
                    
                    <div class="space-y-3">
                        <a href="{{ route('user.balance') }}" class="block w-full bg-rose-600 hover:bg-rose-700 text-white font-black py-4 rounded-2xl shadow-xl shadow-rose-200 transition-all transform active:scale-95 uppercase tracking-widest text-xs">
                            Isi Saldo Sekarang &rarr;
                        </a>
                        <button @click="showError = false" class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-500 font-black py-4 rounded-2xl transition-all uppercase tracking-widest text-xs">
                            Coba nanti
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[3rem] shadow-2xl shadow-secondary/20 overflow-hidden border border-white">
                <div class="p-10 md:p-14">
                    <div class="text-center mb-10">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-[2rem] bg-secondary/10 text-secondary mb-6 border border-secondary/20 shadow-sm transition-transform hover:scale-110">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-3xl font-black text-primary uppercase tracking-tight mb-2">Pintu Pembayaran</h3>
                        <p class="text-gray-500 font-bold text-sm uppercase tracking-widest leading-relaxed">
                            Selesaikan pembayaran Anda untuk event:<br>
                            <span class="text-secondary border-b-2 border-secondary/20">{{ $transaction->event->title }}</span>
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-[2.5rem] p-10 border border-gray-100 mb-10 relative overflow-hidden group">
                        <!-- Decorative glow -->
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-secondary/5 blur-3xl rounded-full transition-all group-hover:scale-150"></div>
                        
                        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Total Tagihan</span>
                            <span class="text-4xl font-black text-primary tracking-tighter italic">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-[10px] border-t border-gray-100 pt-6">
                            <span class="font-black text-gray-400 uppercase tracking-widest">Nomor Transaksi</span>
                            <span class="font-black text-secondary bg-secondary/10 px-3 py-1.5 rounded-lg border border-secondary/20">#TRX-{{ $transaction->id }}</span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Metode Pembayaran (Simulasi):</h4>
                        <div class="grid grid-cols-1 gap-4">
                            <div class="bg-white border-2 border-secondary rounded-3xl p-6 flex items-center gap-6 shadow-xl shadow-secondary/20 relative group cursor-default">
                                <div class="w-14 h-14 bg-secondary rounded-2xl flex items-center justify-center shadow-lg text-white transform group-hover:rotate-6 transition-transform">
                                    <span class="font-black text-xl italic uppercase">VA</span>
                                </div>
                                <div class="flex-grow">
                                    <p class="text-sm font-black text-primary uppercase tracking-tight">Virtual Account</p>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Verifikasi Instan & Otomatis</p>
                                </div>
                                <div class="text-secondary">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('transactions.pay', $transaction->id) }}" method="POST" class="mt-12">
                        @csrf
                        <button type="submit" class="w-full bg-secondary hover:bg-black text-white font-black py-6 rounded-3xl shadow-2xl shadow-secondary/20 transition-all transform hover:-translate-y-1 active:scale-95 text-lg flex items-center justify-center gap-4 group">
                            <svg class="w-6 h-6 animate-pulse group-hover:animate-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04kM12 21a9.003 9.003 0 008.313-5.547M12 21a9.003 9.003 0 01-8.313-5.547"></path></svg>
                            KONFIRMASI BAYAR (SIMULASI) &rarr;
                        </button>
                    </form>

                    <div class="mt-10 pt-10 border-t border-gray-50 flex flex-col items-center gap-4">
                        <div class="bg-amber-50 text-amber-600 border border-amber-100 px-6 py-4 rounded-2xl flex items-center gap-3 max-w-lg">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-[10px] font-bold uppercase tracking-widest leading-relaxed">
                                Klik tombol di atas untuk menyimulasikan pembayaran nyata. Status transaksi akan langsung berubah menjadi 'Berhasil'.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <p class="mt-8 text-center text-[10px] font-black text-gray-400 uppercase tracking-[0.4em]">
                EVENTIFY SECURE PAYMENT INFRASTRUCTURE
            </p>
        </div>
    </div>
</x-app-layout>
