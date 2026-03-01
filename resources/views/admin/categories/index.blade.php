<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-4xl text-white leading-tight tracking-tight uppercase">
                    KELOLA <span class="text-secondary">KATEGORI</span>
                </h2>
                <p class="text-pearl font-bold uppercase tracking-widest text-[10px] mt-2">Atur jenis event yang tersedia di platform Eventify.</p>
            </div>
            <button onclick="document.getElementById('category-modal').classList.remove('hidden')" class="bg-white text-secondary-900 px-8 py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-secondary/10 transition-all shadow-xl flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                TAMBAH KATEGORI
            </button>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($categories as $cat)
                <div class="bg-white rounded-[2.5rem] p-10 border border-white shadow-2xl shadow-secondary/20 flex items-center justify-between group hover:border-secondary transition-all">
                    <div>
                        <h4 class="text-2xl font-black text-primary uppercase tracking-tighter">{{ $cat->name }}</h4>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $cat->events_count ?? $cat->events()->count() }} Event Aktif</p>
                    </div>
                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-300 hover:bg-rose-50 hover:text-rose-600 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-gray-100 italic text-gray-300 font-black">
                    Belum ada kategori yang dibuat.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Simple Modal for adding category -->
    <div id="category-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-primary/80 backdrop-blur-sm p-4">
        <div class="bg-white rounded-[3rem] p-12 max-w-md w-full shadow-2xl">
            <h3 class="text-3xl font-black text-primary mb-8 uppercase tracking-tighter">TAMBAH <span class="text-secondary">KATEGORI</span></h3>
            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Kategori</label>
                    <input type="text" name="name" required class="w-full bg-gray-50 border-transparent focus:border-secondary focus:bg-white rounded-2xl px-6 py-4 font-bold text-primary placeholder-gray-300 transition-all">
                </div>
                <div class="flex gap-4">
                    <button type="button" onclick="document.getElementById('category-modal').classList.add('hidden')" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-black uppercase tracking-widest py-5 rounded-2xl transition-all">Batal</button>
                    <button type="submit" class="flex-2 bg-secondary hover:bg-secondary-700 text-white font-black uppercase tracking-widest py-5 px-10 rounded-2xl transition-all shadow-xl shadow-secondary/20">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
