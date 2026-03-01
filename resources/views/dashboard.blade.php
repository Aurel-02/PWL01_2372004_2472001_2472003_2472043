<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-4xl text-[#1A1108] leading-tight tracking-tight uppercase">
                    Selamat Datang, <span class="text-secondary">{{ Auth::user()->name }}</span>
                </h2>
                <p class="text-accent font-bold uppercase tracking-widest text-[10px] mt-2">Pantau dan kelola aktivitas event Anda di sini.</p>
            </div>
            <div class="flex items-center gap-2 bg-[#1A1108]/5 backdrop-blur-md px-6 py-3 rounded-2xl border border-[#1A1108]/10">
                <div class="w-3 h-3 rounded-full bg-secondary animate-pulse shadow-[0_0_15px_rgba(229,157,44,0.4)]"></div>
                <span class="text-[#1A1108] text-xs font-black uppercase tracking-widest">Sistem Aktif</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(Auth::user()->isAdmin() || Auth::user()->isOrganizer())
                <!-- Admin & Organizer Dashboard -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                    <div>
                        <h3 class="text-3xl font-black text-primary tracking-tight uppercase">
                            {{ Auth::user()->isAdmin() ? 'Ringkasan Sistem' : 'Analisis Penyelenggara' }}
                        </h3>
                        <p class="text-gray-500 font-bold uppercase tracking-widest text-[10px] mt-1">Data analitik real-time infrastruktur Eventify.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        @php $exportRoute = Auth::user()->isAdmin() ? route('admin.report.export') : route('organizer.report.export'); @endphp
                        <a href="{{ $exportRoute }}" class="bg-white border-2 border-gray-100 hover:border-secondary px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-gray-600 hover:text-secondary transition-all flex items-center gap-2 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Export Laporan (PDF)
                        </a>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-primary rounded-[2.5rem] p-10 text-white relative overflow-hidden group shadow-2xl shadow-primary/10">
                        <div class="absolute -right-6 -top-6 w-32 h-32 bg-secondary/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                        <h4 class="text-buff text-[10px] font-black uppercase tracking-[0.2em] mb-2">Total Pendapatan</h4>
                        <p class="text-5xl font-black tracking-tighter">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                        <div class="mt-6 flex items-center gap-3">
                            <span class="bg-white/10 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">+12.5% vs bulan lalu</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-10 border border-gray-100 shadow-xl group hover:border-secondary/20 transition-all">
                        <h4 class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Tiket Terjual</h4>
                        <p class="text-5xl font-black text-primary tracking-tighter">{{ Auth::user()->isAdmin() ? ($totalTickets ?? 0) : ($ticketsSold ?? 0) }}</p>
                        <div class="mt-6 flex items-center gap-3">
                            <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-secondary h-full rounded-full" style="width: 75%"></div>
                            </div>
                            <span class="text-[10px] font-black text-secondary">75%</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-10 border border-gray-100 shadow-xl group hover:border-secondary/20 transition-all">
                        <h4 class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mb-2">{{ Auth::user()->isAdmin() ? 'Total Event' : 'Event Anda' }}</h4>
                        <p class="text-5xl font-black text-primary tracking-tighter">{{ Auth::user()->isAdmin() ? ($totalEvents ?? 0) : ($activeEvents ?? 0) }}</p>
                        <div class="mt-6 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-secondary"></span>
                            <span class="text-[10px] font-black text-secondary uppercase tracking-widest">Seluruhnya Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Chart & Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                    <div class="lg:col-span-2 bg-white rounded-[2.5rem] p-10 border border-gray-100 shadow-xl">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-xl font-black text-primary uppercase tracking-tight flex items-center gap-3">
                                <span class="w-2 h-6 bg-secondary rounded-full"></span>
                                Grafik Penjualan 7 Hari Terakhir
                            </h3>
                        </div>
                        <div class="h-80">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div class="bg-primary rounded-[2.5rem] p-10 text-white shadow-2xl relative overflow-hidden group">
                            <div class="relative z-10">
                                <h4 class="text-secondary text-[10px] font-black uppercase tracking-[0.3em] mb-4">Aksi Cepat</h4>
                                <div class="grid grid-cols-1 gap-4">
                                    <a href="{{ route('events.index') }}" class="flex items-center justify-between p-5 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/5 transition-all group">
                                        <span class="font-black uppercase tracking-widest text-xs">Kelola Event</span>
                                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                    @php $scanRoute = Auth::user()->isAdmin() ? route('admin.scan') : route('organizer.scan'); @endphp
                                    <a href="{{ $scanRoute }}" class="flex items-center justify-between p-5 rounded-2xl bg-secondary hover:bg-secondary transition-all shadow-xl shadow-secondary/20 group">
                                        <span class="font-black uppercase tracking-widest text-xs">Terminal Validasi</span>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                    </a>
                                    <a href="{{ route('waitlists.index') }}" class="flex items-center justify-between p-5 rounded-2xl bg-white/5 hover:bg-white/10 border border-white/5 transition-all group">
                                        <span class="font-black uppercase tracking-widest text-xs">Waiting List</span>
                                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    </a>
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('admin.users.index') }}" class="flex items-center justify-between p-5 rounded-2xl bg-secondary/20 hover:bg-secondary/30 border border-secondary/30 transition-all group">
                                            <span class="font-black uppercase tracking-widest text-xs">Kelola User</span>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        </a>
                                        <a href="{{ route('admin.categories.index') }}" class="flex items-center justify-between p-5 rounded-2xl bg-secondary/20 hover:bg-secondary/30 border border-secondary/30 transition-all group">
                                            <span class="font-black uppercase tracking-widest text-xs">Kelola Kategori</span>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Recent Events List -->
                        <div class="bg-white rounded-[2.5rem] p-10 border border-gray-100 shadow-xl">
                            <h4 class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mb-6 italic">Daftar Event Terbaru</h4>
                            <div class="space-y-6">
                                @forelse($recentEvents ?? [] as $rev)
                                    <div class="flex items-center gap-4 group">
                                        <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary font-black text-xs">
                                            {{ substr($rev->title, 0, 1) }}
                                        </div>
                                        <div class="flex-grow min-w-0">
                                            <p class="font-black text-primary truncate uppercase tracking-tight text-sm">{{ $rev->title }}</p>
                                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest group-hover:text-secondary transition-colors">
                                                {{ $rev->category->name ?? 'Umum' }} • {{ \Carbon\Carbon::parse($rev->start_time)->format('d M') }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-xs font-bold text-gray-300 uppercase tracking-widest italic text-center py-4">Belum ada event.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- User Dashboard -->
                <div class="mb-12">
                    <div class="bg-gradient-to-br from-secondary-900 via-purple-900 to-pink-900 rounded-[3.5rem] p-16 text-center text-white relative overflow-hidden shadow-2xl">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                        <div class="relative z-10 text-center">
                            <h3 class="text-6xl font-black mb-6 tracking-tighter uppercase drop-shadow-sm text-[#1A1108]">Cari Event <span class="bg-clip-text text-transparent bg-gradient-to-r from-secondary to-accent italic">Terbaik.</span></h3>
                            <p class="text-xl text-primary font-bold mb-12 max-w-2xl mx-auto uppercase tracking-tight">Platform ticketing generasi baru untuk pengalaman tak terlupakan.</p>
                            
                            <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-4 bg-white/5 backdrop-blur-3xl p-4 rounded-[3rem] border border-white/10 shadow-2xl">
                                <div class="flex-grow flex items-center px-8 w-full">
                                    <svg class="w-6 h-6 text-secondary mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    <input type="text" placeholder="Cari konser, webinar, atau sport..." class="bg-transparent border-none text-primary placeholder-primary/30 w-full focus:ring-0 font-black text-xl uppercase tracking-tighter">
                                </div>
                                <button class="w-full md:w-auto bg-[#1A1108] text-white px-12 py-6 rounded-[2.5rem] font-black uppercase tracking-[0.2em] hover:bg-secondary transition-all shadow-2xl active:scale-95">TEMUKAN</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 px-2">
                    <div>
                        <h3 class="text-4xl font-black text-primary tracking-tighter uppercase">Rekomendasi <span class="text-secondary italic">Eksklusif</span></h3>
                        <p class="text-gray-400 font-bold uppercase tracking-[0.3em] text-[10px] mt-1">Dikurasi khusus berdasarkan minat Anda hari ini.</p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('user.balance') }}" class="group bg-white border-2 border-gray-100 hover:border-secondary p-2 pl-8 rounded-[2rem] flex items-center font-black text-gray-600 hover:text-secondary transition-all shadow-xl uppercase tracking-widest text-xs">
                            SALDO (Rp {{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }})
                            <div class="ml-6 w-14 h-14 bg-gray-50 group-hover:bg-secondary group-hover:text-white rounded-full flex items-center justify-center transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </a>
                        <a href="{{ route('user.tickets') }}" class="group bg-secondary hover:bg-black p-2 pl-8 rounded-[2rem] flex items-center font-black text-white transition-all shadow-xl shadow-pearl uppercase tracking-widest text-xs">
                            TIKET SAYA ({{ $myTickets ?? 0 }})
                            <div class="ml-6 w-14 h-14 bg-white/10 group-hover:bg-white group-hover:text-secondary rounded-full flex items-center justify-center transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </a>
                        <a href="{{ route('user.scan') }}" class="group bg-rose-600 hover:bg-black p-2 pl-8 rounded-[2rem] flex items-center font-black text-white transition-all shadow-xl shadow-rose-200 uppercase tracking-widest text-xs">
                            SCAN TIKET
                            <div class="ml-6 w-14 h-14 bg-white/10 group-hover:bg-white group-hover:text-rose-600 rounded-full flex items-center justify-center transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @forelse($events ?? [] as $event)
                        <div class="group bg-white rounded-[3rem] shadow-[0_30px_60px_rgba(0,0,0,0.04)] overflow-hidden flex flex-col border border-white hover:border-secondary/20 transition-all duration-700 hover:-translate-y-4">
                            <div class="h-64 bg-gray-100 relative overflow-hidden">
                                @if($event->banner)
                                    <img src="{{ asset('storage/' . $event->banner) }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-125 group-hover:rotate-2" alt="{{ $event->title }}">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-secondary/10 to-secondary/20 flex items-center justify-center text-pearl">
                                        <svg class="w-24 h-24 opacity-30" fill="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div class="absolute top-6 left-6">
                                    <span class="bg-secondary text-white text-[9px] font-black px-5 py-2.5 rounded-full shadow-2xl uppercase tracking-[0.2em] backdrop-blur-md">
                                        {{ $event->category->name ?? 'UMUM' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-10 flex-grow flex flex-col">
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                                    <p class="text-[10px] font-black text-accent uppercase tracking-[0.2em]">
                                        {{ \Carbon\Carbon::parse($event->start_time)->format('D, d M Y • H:i') }} WIB
                                    </p>
                                </div>
                                <h4 class="font-black text-2xl text-primary mb-3 leading-none uppercase tracking-tighter group-hover:text-secondary transition-colors">{{ $event->title }}</h4>
                                <div class="flex items-center gap-2 text-primary/60 mb-8">
                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                     <p class="font-bold text-[10px] uppercase tracking-widest">{{ $event->venue }}, {{ $event->city }}</p>
                                </div>
                                
                                <div class="mt-auto pt-8 border-t border-gray-50 flex justify-between items-center">
                                    @php $minPrice = $event->ticketTypes->min('price'); @endphp
                                    <div>
                                        <p class="text-[9px] font-black text-primary/40 uppercase tracking-widest mb-1">Entry mulai</p>
                                        <p class="text-2xl font-black text-[#1A1108] tracking-tighter">
                                            {{ $minPrice > 0 ? 'Rp ' . number_format($minPrice, 0, ',', '.') : 'GRATIS' }}
                                        </p>
                                    </div>
                                    <a href="{{ route('user.events.show', $event->id) }}" class="bg-primary group-hover:bg-secondary text-white px-8 py-5 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-xl transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                                        BELI TIKET
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 md:col-span-3 text-center py-32 bg-white rounded-[3.5rem] shadow-xl border-2 border-dashed border-gray-100">
                            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-gray-400 text-2xl font-black tracking-tighter uppercase">Hening Seperti Danau...</p>
                            <p class="text-gray-400 text-xs font-bold uppercase mt-2 opacity-60">Belum ada event tersedia. Kami akan segera kembali!</p>
                        </div>
                    @endforelse
                </div>
            @endif

        </div>
    </div>

    @if(Auth::user()->isAdmin() || Auth::user()->isOrganizer())
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('salesChart');
                if (ctx) {
                    new Chart(ctx.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: {!! json_encode($chartLabels ?? []) !!},
                            datasets: [{
                                label: 'Pendapatan (IDR)',
                                data: {!! json_encode($chartValues ?? []) !!},
                                borderColor: '#4f46e5',
                                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                                borderWidth: 4,
                                pointBackgroundColor: '#fff',
                                pointBorderColor: '#4f46e5',
                                pointRadius: 6,
                                pointHoverRadius: 8,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    backgroundColor: '#111827',
                                    titleFont: { size: 12, weight: 'bold' },
                                    bodyFont: { size: 14, weight: 'bold' },
                                    padding: 16,
                                    cornerRadius: 12,
                                    displayColors: false,
                                    callbacks: {
                                        label: function(context) {
                                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                                    ticks: {
                                        font: { weight: 'bold', size: 10 },
                                        callback: function(value) {
                                            if (value >= 1000000) return 'Rp ' + (value/1000000) + 'jt';
                                            if (value >= 1000) return 'Rp ' + (value/1000) + 'rb';
                                            return 'Rp ' + value;
                                        }
                                    }
                                },
                                x: {
                                    grid: { display: false },
                                    ticks: { font: { weight: 'bold', size: 10 } }
                                }
                            }
                        }
                    });
                }
            });
        </script>
    @endif
</x-app-layout>
