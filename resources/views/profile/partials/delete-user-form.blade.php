<section class="space-y-6">
    <header>
        <h2 class="text-2xl font-black text-rose-900 uppercase tracking-tight">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-2 text-[10px] font-bold text-rose-600 uppercase tracking-widest leading-relaxed">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun, harap cadangkan data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-rose-600 hover:bg-black text-white px-10 py-5 rounded-2xl font-black uppercase tracking-[0.2em] shadow-xl shadow-rose-200 transition-all transform hover:-translate-y-1 active:scale-95 text-xs"
    >{{ __('HAPUS AKUN SAYA') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-12 bg-white">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-primary uppercase tracking-tight">
                {{ __('Apakah Anda yakin ingin menghapus akun?') }}
            </h2>

            <p class="mt-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-relaxed">
                {{ __('Setelah akun Anda dihapus, semua data akan hilang selamanya. Harap masukkan kata sandi Anda untuk mengonfirmasi penghapusan permanen.') }}
            </p>

            <div class="mt-8">
                <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="sr-only" />

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full bg-gray-50 border-2 border-gray-100 focus:border-rose-600 focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all"
                    placeholder="{{ __('Kata Sandi Konfirmasi') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')" class="px-8 py-4 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-gray-600 transition-colors">
                    {{ __('BATAL') }}
                </button>

                <button type="submit" class="bg-rose-600 hover:bg-black text-white px-8 py-4 rounded-xl font-black uppercase tracking-widest shadow-lg shadow-rose-100 transition-all text-[10px]">
                    {{ __('HAPUS PERMANEN') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
