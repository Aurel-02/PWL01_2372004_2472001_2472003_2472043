<section>
    <header>
        <h2 class="text-2xl font-black text-primary uppercase tracking-tight">
            {{ __('Keamanan Kata Sandi') }}
        </h2>

        <p class="mt-2 text-[10px] font-black text-gray-400 uppercase tracking-widest leading-relaxed">
            {{ __('Gunakan kata sandi yang panjang dan acak untuk menjaga keamanan akun Anda.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div class="group">
            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors" />
            <input id="update_password_current_password" name="current_password" type="password" 
                class="block w-full bg-gray-50 border-2 border-gray-100 focus:border-secondary focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all" 
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="group">
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors" />
            <input id="update_password_password" name="password" type="password" 
                class="block w-full bg-gray-50 border-2 border-gray-100 focus:border-secondary focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="group">
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors" />
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="block w-full bg-gray-50 border-2 border-gray-100 focus:border-secondary focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-6">
            <button type="submit" class="bg-secondary hover:bg-black text-white px-10 py-5 rounded-2xl font-black uppercase tracking-[0.2em] shadow-xl shadow-secondary/20 transition-all transform hover:-translate-y-1 active:scale-95 text-xs">
                {{ __('GANTI KATA SANDI') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-[10px] font-black text-secondary uppercase tracking-widest"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
