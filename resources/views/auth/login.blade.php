<x-guest-layout>
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-black text-[#1A1108] tracking-tighter uppercase mb-3 drop-shadow-sm">MASUK <span class="text-secondary italic">Eventify</span></h1>
        <p class="text-[#1A1108]/70 font-bold text-[10px] uppercase tracking-[0.3em] leading-relaxed">Akses pusat manajemen tiket event tersentralisasi.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 bg-secondary/10 border border-secondary/20 p-5 rounded-3xl text-secondary-400 text-xs font-bold leading-relaxed" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-8">
        @csrf

        <!-- Email Address -->
        <div class="space-y-3 group">
            <label for="email" class="block text-[10px] font-black text-[#1A1108] uppercase tracking-[0.3em] group-focus-within:text-accent transition-colors">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-7 flex items-center pointer-events-none text-[#1A1108]/40 group-focus-within:text-accent transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email', 'admin@gmail.com') }}" required autofocus autocomplete="username" 
                    class="block w-full bg-white border-2 border-[#1A1108]/5 focus:border-accent focus:ring-0 rounded-[2rem] pl-16 pr-8 py-6 font-bold text-[#1A1108] shadow-sm transition-all placeholder-[#1A1108]/20 hover:bg-white/90"
                    placeholder="nama@email.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="text-rose-600 text-[10px] font-bold uppercase tracking-widest mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-3 group">
            <div class="flex items-center justify-between">
                <label for="password" class="block text-[10px] font-black text-[#1A1108] uppercase tracking-[0.3em] group-focus-within:text-accent transition-colors">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-black text-accent border-b border-accent/20 uppercase tracking-widest hover:text-[#1A1108] hover:border-[#1A1108] transition-all" href="{{ route('password.request') }}">
                        Lupa Sandi?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-7 flex items-center pointer-events-none text-[#1A1108]/40 group-focus-within:text-accent transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password" value="password"
                    class="block w-full bg-white border-2 border-[#1A1108]/5 focus:border-accent focus:ring-0 rounded-[2rem] pl-16 pr-8 py-6 font-bold text-[#1A1108] shadow-sm transition-all hover:bg-white/90">
            </div>
            <x-input-error :messages="$errors->get('password')" class="text-rose-600 text-[10px] font-bold uppercase tracking-widest mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" class="w-full bg-[#1A1108] hover:bg-accent text-white px-10 py-7 rounded-[2rem] font-black uppercase tracking-[0.3em] shadow-xl shadow-[#1A1108]/20 transition-all transform hover:-translate-y-1 active:scale-95 text-xs flex items-center justify-center gap-3 group">
                MASUK SEKARANG
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </button>
        </div>

        <!-- Help Info -->
        <div class="mt-8 bg-[#1A1108]/5 p-6 rounded-[2rem] border-2 border-[#1A1108]/5">
            <p class="text-[10px] font-black text-[#1A1108]/40 uppercase tracking-[0.2em] text-center leading-relaxed">
                <span class="text-accent">ADMIN LOGIN:</span><br/>
                admin@gmail.com / password
            </p>
        </div>

        <div class="text-center pt-2">
            <p class="text-[10px] font-black text-[#1A1108]/50 uppercase tracking-widest">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-accent hover:text-[#1A1108] transition-colors border-b-2 border-accent/10 hover:border-[#1A1108] px-1 ml-1 pb-1">Daftar Akun Gratis &rarr;</a>
            </p>
        </div>
    </form>
</x-guest-layout>
