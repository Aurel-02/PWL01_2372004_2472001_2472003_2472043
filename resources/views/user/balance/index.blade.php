<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-4xl text-white leading-tight tracking-tight uppercase">
                    Saldo <span class="text-secondary">Akun</span>
                </h2>
                <p class="text-pearl font-bold uppercase tracking-widest text-[10px] mt-2">Kelola dana Anda untuk pembelian tiket yang lebih cepat.</p>
            </div>
            <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20">
                <div class="w-3 h-3 rounded-full bg-secondary animate-pulse shadow-[0_0_15px_rgba(16,185,129,0.6)]"></div>
                <span class="text-white text-xs font-black uppercase tracking-widest">Dompet Aman</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Balance Card -->
                <div class="lg:col-span-1">
                    <div class="bg-secondary rounded-[2.5rem] p-10 text-white relative overflow-hidden group shadow-2xl shadow-pearl">
                        <div class="absolute -right-6 -top-6 w-32 h-32 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                        <h4 class="text-pearl text-[10px] font-black uppercase tracking-[0.2em] mb-2 text-center">Saldo Saat Ini</h4>
                        <p class="text-5xl font-black tracking-tighter text-center">Rp {{ number_format($user->balance, 0, ',', '.') }}</p>
                        <div class="mt-10 pt-10 border-t border-white/10">
                            <p class="text-[9px] font-bold text-pearl uppercase tracking-widest leading-relaxed text-center">
                                Gunakan saldo Anda untuk pembayaran instan tanpa perlu transfer manual setiap kali membeli tiket.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Top Up Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[2.5rem] p-12 border border-gray-100 shadow-xl">
                        <h3 class="text-3xl font-black text-primary mb-8 tracking-tighter uppercase">Isi <span class="text-secondary italic">Saldo</span></h3>
                        
                        @if (session('success'))
                            <div class="mb-8 p-6 bg-secondary-50 border border-secondary-100 rounded-3xl flex items-center gap-4 animate-bounce">
                                <div class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center text-white shrink-0 shadow-lg shadow-secondary-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <p class="text-secondary-800 font-black uppercase tracking-widest text-xs">{{ session('success') }}</p>
                            </div>
                        @endif

                        <form action="{{ route('user.balance.topup') }}" method="POST" class="space-y-8">
                            @csrf
                            <div class="space-y-4">
                                <label for="amount" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">Jumlah Top Up (IDR)</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-8 flex items-center pointer-events-none">
                                        <span class="text-gray-400 font-black text-2xl">Rp</span>
                                    </div>
                                    <input type="number" name="amount" id="amount" step="1000" min="1000" required
                                        class="block w-full pl-24 pr-8 py-8 bg-gray-50 border-2 border-transparent focus:border-secondary focus:bg-white rounded-[2rem] text-3xl font-black text-primary transition-all placeholder-gray-300"
                                        placeholder="0">
                                </div>
                                @error('amount')
                                    <p class="text-accent text-[10px] font-black uppercase tracking-widest">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach([50000, 100000, 250000, 500000] as $preset)
                                    <button type="button" onclick="document.getElementById('amount').value = {{ $preset }}"
                                        class="py-4 rounded-2xl border-2 border-gray-100 font-black text-xs uppercase tracking-widest text-gray-500 hover:border-secondary hover:text-secondary hover:bg-secondary/10 transition-all">
                                        Rp {{ number_format($preset/1000, 0) }}rb
                                    </button>
                                @endforeach
                            </div>

                            <button type="submit" 
                                class="w-full bg-primary hover:bg-secondary text-white py-8 rounded-[2rem] font-black uppercase tracking-[0.3em] text-sm shadow-2xl transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-4 group">
                                KONFIRMASI PEMBAYARAN
                                <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </form>

                        <div class="mt-12 p-8 bg-gray-50 rounded-[2rem] border border-gray-100 flex items-start gap-6">
                            <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm shrink-0 border border-gray-100">
                                <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h5 class="font-black text-xs text-primary uppercase tracking-widest mb-1">Informasi Penting</h5>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-relaxed">Top up saldo akan diproses secara instan. Saldo tidak dapat diuangkan kembali namun dapat digunakan untuk membeli tiket event apapun di platform Eventify.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
