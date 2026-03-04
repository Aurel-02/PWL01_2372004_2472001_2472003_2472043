<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Event') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12" x-data="{ showError: {{ session('error') ? 'true' : 'false' }} }">
        <!-- Error Modal -->
        <div x-show="showError" 
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-cloak>
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="showError = false"></div>
            
            <!-- Modal Content -->
            <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-md relative z-10 overflow-hidden border border-rose-100"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="scale-90 opacity-0"
                 x-transition:enter-end="scale-100 opacity-100">
                
                <div class="p-10 text-center">
                    <div class="w-20 h-20 bg-rose-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 text-rose-500 border border-rose-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    
                    <h4 class="text-2xl font-black text-primary uppercase tracking-tight mb-2">OPS! ADA <span class="text-rose-600">MASALAH</span></h4>
                    <p class="text-gray-500 font-bold text-xs uppercase tracking-widest mb-8 leading-relaxed">
                        {{ session('error') }}
                    </p>
                    
                    <button @click="showError = false" class="block w-full bg-primary hover:bg-black text-white font-black py-4 rounded-2xl shadow-xl transition-all transform active:scale-95 uppercase tracking-widest text-xs">
                        Mengerti
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] shadow-2xl shadow-secondary/20 overflow-hidden border border-white">
            <!-- Event Hero Section -->
            <div class="relative h-[32rem]">
                @if($event->banner)
                    <img src="{{ asset('storage/' . $event->banner) }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/40 to-transparent"></div>
                @else
                    <div class="w-full h-full bg-mesh flex items-center justify-center">
                        <svg class="w-32 h-32 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary to-transparent"></div>
                @endif
                
                <div class="absolute bottom-0 left-0 p-12 w-full">
                    <div class="flex flex-wrap items-center gap-4 mb-6">
                        <span class="bg-white/20 backdrop-blur-md text-white text-[10px] font-black px-6 py-2 rounded-full uppercase tracking-widest border border-white/30 shadow-xl">
                            {{ $event->category->name ?? 'Event Utama' }}
                        </span>
                        <div class="flex items-center gap-2 bg-secondary/20 backdrop-blur-md text-secondary-400 text-[10px] font-black px-6 py-2 rounded-full uppercase tracking-widest border border-secondary/30">
                            <div class="w-2 h-2 rounded-full bg-secondary animate-pulse"></div>
                            Tiket Tersedia
                        </div>
                    </div>
                    <h1 class="text-6xl font-black text-white uppercase tracking-tight leading-none mb-6">
                        {{ $event->title }}
                    </h1>
                    <div class="flex flex-wrap gap-8 text-white/80">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md">
                                <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-buff">Tanggal Event</p>
                                <p class="font-bold">{{ \Carbon\Carbon::parse($event->start_time)->format('d M, Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md">
                                <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-pink-300">Lokasi</p>
                                <p class="font-bold">{{ $event->venue }}, {{ $event->city }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3">
                <!-- Content Section -->
                <div class="lg:col-span-2 p-12 border-r border-gray-50">
                    <div class="mb-12">
                        <h3 class="text-xs font-black text-secondary uppercase tracking-[0.3em] mb-4">Tentang Event</h3>
                        <div class="prose prose-secondary max-w-none text-gray-600 font-medium leading-relaxed">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-gray-50 rounded-[2rem] p-8 border border-white shadow-inner">
                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Waktu & Jadwal
                            </h4>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs font-bold text-gray-500 uppercase tracking-tight">Mulai</p>
                                    <p class="font-black text-primary">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB</p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-500 uppercase tracking-tight">Selesai</p>
                                    <p class="font-black text-primary">{{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }} WIB</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-secondary/10/50 rounded-[2rem] p-8 border border-secondary/20 shadow-inner">
                            <h4 class="text-[10px] font-black text-secondary uppercase tracking-widest mb-6 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Penyelenggara
                            </h4>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-2xl shadow-md border border-secondary/20 flex items-center justify-center text-secondary font-black">
                                    {{ substr($event->organizer->name ?? 'T', 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-black text-primary uppercase tracking-tight">{{ $event->organizer->name ?? 'Eventify Team' }}</p>
                                    <p class="text-[10px] font-bold text-secondary uppercase tracking-widest">Penyelenggara Terverifikasi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Purchase Section -->
                <div class="p-12 bg-gray-50 flex flex-col items-center justify-center text-center relative overflow-hidden">
                    <div class="absolute inset-0 opacity-5 pointer-events-none">
                        <div class="absolute -top-24 -right-24 w-64 h-64 bg-secondary rounded-full blur-3xl"></div>
                    </div>

                    <div class="relative z-10 w-full max-w-sm">
                        @if($event->ticketTypes->count() > 0)
                            <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.3em] mb-4">Pilih Kategori Tiket</h3>
                            <form action="{{ route('user.events.buy', $event->id) }}" method="POST" id="purchase-form" class="space-y-4 mb-8">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <input type="hidden" name="quantity" value="1">
                                @foreach($event->ticketTypes as $type)
                                    @php $isSoldOut = $type->quota <= 0; @endphp
                                    <label class="block relative cursor-pointer group {{ $isSoldOut ? 'opacity-60 cursor-not-allowed' : '' }}">
                                        <input type="radio" name="ticket_type_id" value="{{ $type->id }}" class="peer absolute opacity-0" {{ $loop->first && !$isSoldOut ? 'checked' : '' }} {{ $isSoldOut ? 'disabled' : '' }}>
                                        <div class="bg-white border-2 border-transparent peer-checked:border-secondary peer-checked:bg-secondary/10 p-6 rounded-3xl transition-all shadow-sm group-hover:shadow-md">
                                            <div class="flex justify-between items-center">
                                                <div class="text-left">
                                                    <p class="font-black text-primary uppercase text-lg leading-none mb-1">{{ $type->name }}</p>
                                                    @if($isSoldOut)
                                                        <span class="text-[8px] font-black bg-rose-100 text-rose-600 px-2 py-0.5 rounded-full uppercase tracking-widest">TERJUAL HABIS</span>
                                                    @elseif($type->quota <= 10)
                                                        <span class="text-[8px] font-black bg-amber-100 text-amber-600 px-2 py-0.5 rounded-full uppercase tracking-widest">SISA {{ $type->quota }} LAGI!</span>
                                                    @else
                                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Stok: {{ $type->quota }} Tersedia</p>
                                                    @endif
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-black text-secondary text-lg leading-none mb-1">Rp {{ number_format($type->price, 0, ',', '.') }}</p>
                                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">/ Orang</p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                                
                                @if($event->ticketTypes->where('quota', '>', 0)->count() > 0)
                                    <button type="submit" class="w-full bg-secondary hover:bg-black text-white font-black uppercase tracking-[0.2em] py-6 rounded-3xl shadow-xl shadow-secondary/20 transition-all transform hover:-translate-y-1 active:scale-95 text-sm flex items-center justify-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        LANJUT KE PEMBAYARAN
                                    </button>
                                </form>
                                @else
                                </form>
                                <form action="{{ route('user.events.waitlist', $event->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="ticket_type_id" value="{{ $event->ticketTypes->first()->id }}">
                                    <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-black uppercase tracking-[0.2em] py-6 rounded-3xl shadow-xl transition-all flex items-center justify-center gap-3">
                                        MASUK DAFTAR TUNGGU (QUEUE)
                                    </button>
                                </form>
                                @endif
                        @else
                            <div class="bg-white/50 backdrop-blur-md border-2 border-dashed border-gray-200 rounded-[2rem] p-12 mb-8">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-gray-400 font-black uppercase tracking-tight italic">Tiket segera hadir! Nantikan pengumuman resminya.</p>
                            </div>
                        @endif
                        
                        <div class="flex items-center justify-center gap-6 opacity-40">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full border-2 border-primary flex items-center justify-center mb-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"></path></svg>
                                </div>
                                <span class="text-[8px] font-black uppercase tracking-widest text-primary">Aman</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full border-2 border-primary flex items-center justify-center mb-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path></svg>
                                </div>
                                <span class="text-[8px] font-black uppercase tracking-widest text-primary">Mudah</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full border-2 border-primary flex items-center justify-center mb-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span class="text-[8px] font-black uppercase tracking-widest text-primary">Resmi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-primary py-10 px-12 flex flex-col md:flex-row items-center justify-between text-white/40 border-t border-white/5">
                <p class="text-[10px] font-bold uppercase tracking-[0.4em]">Official Ticket Marketplace &mdash; EVENTIFY Infrastructure v1.0</p>
                <div class="flex gap-10 mt-6 md:mt-0 font-black uppercase text-[10px] tracking-widest">
                    <a href="#" class="hover:text-white transition-colors">Kebijakan Pengembalian</a>
                    <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
