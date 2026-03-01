<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-4xl text-white leading-tight tracking-tight uppercase">
                    EDIT <span class="text-secondary">EVENT</span>
                </h2>
                <p class="text-pearl font-bold uppercase tracking-widest text-[10px] mt-2">Perbarui konfigurasi event dalam sistem Eventify.</p>
            </div>
            <a href="{{ route('events.index') }}" class="text-pearl hover:text-white font-black uppercase tracking-widest text-xs flex items-center gap-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
            @csrf
            @method('PUT')
            
            <!-- Information Section -->
            <div class="bg-white rounded-[3rem] shadow-2xl shadow-secondary/20 overflow-hidden border border-white">
                <div class="p-12">
                    <h3 class="text-2xl font-black text-primary uppercase tracking-tight mb-8 flex items-center gap-3">
                        <span class="w-2 h-8 bg-secondary rounded-full"></span>
                        Informasi Umum
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Judul Event</label>
                            <input type="text" name="title" value="{{ old('title', $event->title) }}" 
                                class="w-full bg-gray-50 border-2 border-gray-100 focus:border-secondary focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all">
                            @error('title') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Deskripsi Lengkap</label>
                            <textarea name="description" rows="5" 
                                class="w-full bg-gray-50 border-2 border-gray-100 focus:border-secondary focus:ring-0 rounded-3xl px-6 py-4 font-medium text-gray-600 transition-all">{{ old('description', $event->description) }}</textarea>
                            @error('description') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Penyelenggara</label>
                            <select name="organizer_id" class="w-full bg-gray-50 border-2 border-gray-100 focus:border-secondary focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all">
                                @foreach($organizers as $organizer)
                                    <option value="{{ $organizer->id }}" {{ old('organizer_id', $event->organizer_id) == $organizer->id ? 'selected' : '' }}>{{ $organizer->name }}</option>
                                @endforeach
                            </select>
                            @error('organizer_id') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Kategori</label>
                            <select name="category_id" class="w-full bg-gray-50 border-2 border-gray-100 focus:border-secondary focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logistics Section -->
            <div class="bg-white rounded-[3rem] shadow-2xl shadow-secondary/20 overflow-hidden border border-white text-primary">
                <div class="p-12">
                    <h3 class="text-2xl font-black text-primary uppercase tracking-tight mb-8 flex items-center gap-3">
                        <span class="w-2 h-8 bg-accent rounded-full"></span>
                        Jadwal & Lokasi
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Waktu Mulai</label>
                            <input type="datetime-local" name="start_time" value="{{ old('start_time', \Carbon\Carbon::parse($event->start_time)->format('Y-m-d\TH:i')) }}"
                                class="w-full bg-gray-50 border-2 border-gray-100 focus:border-accent focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all">
                            @error('start_time') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Waktu Selesai</label>
                            <input type="datetime-local" name="end_time" value="{{ old('end_time', \Carbon\Carbon::parse($event->end_time)->format('Y-m-d\TH:i')) }}"
                                class="w-full bg-gray-50 border-2 border-gray-100 focus:border-accent focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all">
                            @error('end_time') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Nama Tempat / Gedung</label>
                            <input type="text" name="venue" value="{{ old('venue', $event->venue) }}"
                                class="w-full bg-gray-50 border-2 border-gray-100 focus:border-accent focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all">
                            @error('venue') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Kota</label>
                            <input type="text" name="city" value="{{ old('city', $event->city) }}"
                                class="w-full bg-gray-50 border-2 border-gray-100 focus:border-accent focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all">
                            @error('city') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Status Publikasi</label>
                            <select name="status" class="w-full bg-gray-50 border-2 border-gray-100 focus:border-accent focus:ring-0 rounded-2xl px-6 py-4 font-bold text-primary transition-all">
                                <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>Draft (Hanya Admin)</option>
                                <option value="published" {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Published (Publik)</option>
                            </select>
                            @error('status') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Section -->
            <div class="bg-white rounded-[3rem] shadow-2xl shadow-secondary/20 overflow-hidden border border-white">
                <div class="p-12">
                    <h3 class="text-2xl font-black text-primary uppercase tracking-tight mb-8 flex items-center gap-3">
                        <span class="w-2 h-8 bg-amber-500 rounded-full"></span>
                        Gambar Banner
                    </h3>
                    
                    @if($event->banner)
                        <div class="mb-8 rounded-3xl overflow-hidden border-4 border-white shadow-xl max-w-md">
                            <img src="{{ asset('storage/' . $event->banner) }}" class="w-full h-auto">
                        </div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Upload baru untuk mengganti:</p>
                    @endif

                    <div class="relative group">
                        <input type="file" name="banner" id="banner-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="bg-gray-50 border-4 border-dashed border-gray-100 rounded-[2rem] p-12 text-center group-hover:border-amber-500 group-hover:bg-amber-50 transition-all duration-300">
                             <div class="w-20 h-20 bg-white rounded-3xl shadow-md flex items-center justify-center mx-auto mb-4 text-gray-400 group-hover:text-amber-500 group-hover:scale-110 transition-all">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="font-black text-primary uppercase tracking-tight mb-1">Klik untuk Ganti Banner</p>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">PNG, JPG recommended (Max 2MB)</p>
                        </div>
                    </div>
                    @error('banner') <p class="text-red-500 text-xs mt-4 font-bold">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-6">
                <a href="{{ route('events.index') }}" class="text-gray-400 hover:text-gray-600 font-black uppercase tracking-widest text-xs transition-colors">Batalkan</a>
                <button type="submit" class="bg-secondary hover:bg-black text-white px-12 py-6 rounded-3xl font-black uppercase tracking-[0.2em] shadow-2xl shadow-pearl transition-all transform hover:-translate-y-1 active:scale-95 text-sm">
                    PERBARUI EVENT &rarr;
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
