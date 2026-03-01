<section>
    <header>
        <h2 class="text-2xl font-black text-primary uppercase tracking-tight">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-2 text-[10px] font-black text-gray-400 uppercase tracking-widest leading-relaxed">
            {{ __("Perbarui informasi profil akun dan alamat email Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <div class="group">
            <x-input-label for="name" :value="__('Nama')" class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors" />
            <input id="name" name="name" type="text" 
                class="block w-full bg-gray-50 border-2 border-gray-100 focus:border-secondary focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all" 
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="group">
            <x-input-label for="email" :value="__('Email')" class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 group-focus-within:text-secondary transition-colors" />
            <input id="email" name="email" type="email" 
                class="block w-full bg-gray-50 border-2 border-gray-100 focus:border-secondary focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all" 
                value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-amber-50 rounded-2xl border border-amber-100">
                    <p class="text-[10px] font-bold text-amber-700 uppercase tracking-widest">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="underline hover:text-amber-900 block mt-1">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-black text-[10px] text-secondary uppercase tracking-widest">
                            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-6">
            <button type="submit" class="bg-secondary hover:bg-black text-white px-10 py-5 rounded-2xl font-black uppercase tracking-[0.2em] shadow-xl shadow-secondary/20 transition-all transform hover:-translate-y-1 active:scale-95 text-xs">
                {{ __('SIMPAN PERUBAHAN') }}
            </button>

            @if (session('status') === 'profile-updated')
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
