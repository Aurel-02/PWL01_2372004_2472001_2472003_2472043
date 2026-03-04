<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-4xl text-white leading-tight tracking-tight uppercase">
                    SELF <span class="text-secondary">CHECK-IN</span>
                </h2>
                <p class="text-pearl font-bold uppercase tracking-widest text-[10px] mt-2">Gunakan terminal ini untuk check-in tiket Anda di venue.</p>
            </div>
            <div class="flex items-center gap-2 bg-secondary/20 backdrop-blur-md px-6 py-3 rounded-2xl border border-secondary/30 shadow-[0_0_30px_rgba(16,185,129,0.2)]">
                <div class="w-2 h-2 rounded-full bg-secondary animate-pulse"></div>
                <span class="text-secondary-400 text-xs font-black uppercase tracking-widest">Sistem Aktif</span>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-[3rem] shadow-2xl shadow-secondary/20 overflow-hidden border border-white">
            <div class="p-12">
                <div class="text-center mb-12">
                    <div class="w-24 h-24 bg-secondary/10 rounded-[2rem] flex items-center justify-center mx-auto mb-6 text-secondary">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-black text-primary uppercase tracking-tight mb-2">VALIDASI MANDIRI</h3>
                    <p class="text-gray-500 font-bold text-xs uppercase tracking-widest">Masukkan KODE TIKET Anda untuk masuk ke lokasi.</p>
                </div>

                @if(session('success'))
                    <div class="mb-8 bg-secondary-50 border-2 border-secondary-100 p-8 rounded-[2rem] flex flex-col items-center text-center animate-bounce-short">
                        <div class="w-16 h-16 bg-secondary text-white rounded-full flex items-center justify-center mb-4 shadow-lg shadow-secondary-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <h4 class="text-secondary-900 font-black uppercase tracking-tight text-xl mb-1">Check-in Berhasil</h4>
                        <p class="text-secondary font-bold text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-8 bg-rose-50 border-2 border-rose-100 p-8 rounded-[2rem] flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-rose-500 text-white rounded-full flex items-center justify-center mb-4 shadow-lg shadow-rose-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </div>
                        <h4 class="text-rose-900 font-black uppercase tracking-tight text-xl mb-1">Terjadi Kesalahan</h4>
                        <p class="text-rose-600 font-bold text-sm">{{ session('error') }}</p>
                    </div>
                @endif

                <form action="{{ route('user.scan.process') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <input type="text" name="ticket_code" 
                            class="w-full bg-gray-50 border-2 border-gray-100 focus:border-secondary focus:ring-0 rounded-3xl px-8 py-6 text-center text-xl font-black tracking-[0.2em] text-primary placeholder-gray-300 transition-all font-mono"
                            placeholder="TIX-4-ABCDE12345"
                            required
                            autofocus>
                    </div>
                    
                    <button type="submit" class="w-full bg-secondary hover:bg-black text-white font-black uppercase tracking-[0.2em] py-6 rounded-3xl shadow-xl shadow-secondary/20 transition-all transform hover:-translate-y-1 active:scale-95 text-sm">
                        MASUK &rarr;
                    </button>
                </form>

                <div class="mt-12 text-center p-8 bg-primary rounded-[2.5rem] text-white">
                    <p class="text-[10px] font-black text-secondary uppercase tracking-[0.3em] mb-4">Petunjuk</p>
                    <p class="text-xs font-bold text-gray-400 uppercase leading-relaxed">
                        Silakan masukkan kode tiket lengkap seperti yang tertera pada bagian atas tiket Anda (misal: TIX-4-6ICPJZENQSB2).
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
