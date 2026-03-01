<x-guest-layout>
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-extrabold text-white tracking-tighter uppercase mb-3 drop-shadow-lg">DAFTAR <span class="text-secondary italic">AKUN</span></h1>
        <p class="text-gray-400 font-bold text-xs uppercase tracking-widest leading-relaxed opacity-70">Mulai manajemen event Anda dengan Eventify hari ini.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="space-y-2 group">
            <label for="name" class="block text-[10px] font-bold text-gray-500 uppercase tracking-[0.3em] group-focus-within:text-secondary">Nama Lengkap</label>
            <input id="name" class="block w-full bg-[#1A1A1E] border-2 border-transparent focus:border-secondary focus:ring-0 rounded-[2rem] px-8 py-5 font-bold text-white shadow-2xl transition-all hover:bg-[#1E1E23]" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Nama Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-rose-500 text-[10px] font-bold uppercase tracking-widest" />
        </div>

        <!-- Registration Role -->
        <div class="space-y-2 group">
            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-[0.3em] mb-4">Mendaftar Sebagai</label>
            <div class="grid grid-cols-2 gap-4">
                <label class="relative cursor-pointer">
                    <input type="radio" name="role" value="user" checked class="peer sr-only">
                    <div class="p-4 rounded-2xl border-2 border-white/5 bg-[#1A1A1E] text-center peer-checked:border-secondary peer-checked:bg-secondary/10 transition-all">
                        <p class="text-[10px] font-black uppercase text-gray-400 peer-checked:text-white">Pembeli</p>
                    </div>
                </label>
                <label class="relative cursor-pointer">
                    <input type="radio" name="role" value="organizer" class="peer sr-only">
                    <div class="p-4 rounded-2xl border-2 border-white/5 bg-[#1A1A1E] text-center peer-checked:border-secondary peer-checked:bg-secondary/10 transition-all">
                        <p class="text-[10px] font-black uppercase text-gray-400 peer-checked:text-white">Penyelenggara</p>
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2 text-rose-500 text-[10px] font-bold uppercase tracking-widest" />
        </div>

        <!-- Email Address -->
        <div class="space-y-2 group">
            <label for="email" class="block text-[10px] font-bold text-gray-500 uppercase tracking-[0.3em] group-focus-within:text-secondary">Alamat Email</label>
            <input id="email" class="block w-full bg-[#1A1A1E] border-2 border-transparent focus:border-secondary focus:ring-0 rounded-[2rem] px-8 py-5 font-bold text-white shadow-2xl transition-all hover:bg-[#1E1E23]" type="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-500 text-[10px] font-bold uppercase tracking-widest" />
        </div>

        <!-- Password -->
        <div class="space-y-2 group">
            <label for="password" class="block text-[10px] font-bold text-gray-500 uppercase tracking-[0.3em] group-focus-within:text-secondary">Kata Sandi</label>
            <input id="password" class="block w-full bg-[#1A1A1E] border-2 border-transparent focus:border-secondary focus:ring-0 rounded-[2rem] px-8 py-5 font-bold text-white shadow-2xl transition-all hover:bg-[#1E1E23]" type="password" name="password" required placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-500 text-[10px] font-bold uppercase tracking-widest" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2 group">
            <label for="password_confirmation" class="block text-[10px] font-bold text-gray-500 uppercase tracking-[0.3em] group-focus-within:text-secondary">Konfirmasi Sandi</label>
            <input id="password_confirmation" class="block w-full bg-[#1A1A1E] border-2 border-transparent focus:border-secondary focus:ring-0 rounded-[2rem] px-8 py-5 font-bold text-white shadow-2xl transition-all hover:bg-[#1E1E23]" type="password" name="password_confirmation" required placeholder="••••••••" />
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full bg-secondary hover:bg-black text-white px-10 py-7 rounded-[2rem] font-black uppercase tracking-[0.3em] shadow-2xl transition-all transform hover:-translate-y-1 active:scale-95 text-xs">
                DAFTAR SEKARANG
            </button>
        </div>

        <div class="text-center pt-4">
            <p class="text-[10px] font-bold text-gray-600 uppercase tracking-widest leading-relaxed">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-white hover:text-secondary transition-colors border-b-2 border-white/10 hover:border-secondary px-1 ml-1 pb-1">MASUK DISINI &rarr;</a>
            </p>
        </div>
    </form>
</x-guest-layout>
