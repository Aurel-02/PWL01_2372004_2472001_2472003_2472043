<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-white uppercase tracking-tight">
            PENGATURAN <span class="text-secondary">PROFIL</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            <div class="bg-secondary rounded-[3rem] p-10 text-white flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl shadow-secondary/20">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-white/10 rounded-[2rem] flex items-center justify-center border border-white/20">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-pearl">Saldo Akun Eventify</p>
                        <h3 class="text-4xl font-black tracking-tighter">Rp {{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>
                <a href="{{ route('user.balance') }}" class="bg-white text-secondary-900 px-10 py-5 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-secondary/10 transition-all shadow-xl">
                    ISI SALDO &rarr;
                </a>
            </div>

            <div class="p-8 sm:p-12 bg-white shadow-2xl shadow-secondary/20 sm:rounded-[3rem] border border-white">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 sm:p-12 bg-white shadow-2xl shadow-secondary/20 sm:rounded-[3rem] border border-white">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-8 sm:p-12 bg-rose-50 border-2 border-rose-100 sm:rounded-[3rem]">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
