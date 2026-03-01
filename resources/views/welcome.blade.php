<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventify - Platform Ticketing Modern</title>

    <!-- Tailwind CDN for XAMPP users -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Premium Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#2E4365',     // Police Blue
                        'secondary': '#E59D2C',   // Marigold
                        'accent': '#8A3B08',      // Citrine Brown
                        'pearl': '#EBDDC5',       // Pearl
                        'buff': '#F3D58D',        // Buff
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav {
            background: rgba(243, 229, 208, 0.9); /* Parchment Gold */
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 2px solid rgba(138, 59, 8, 0.1);
        }
        .text-gradient {
            background: linear-gradient(135deg, #F3D58D 0%, #D4AF37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-mesh {
            background: 
                radial-gradient(at 0% 0%, hsla(37, 77%, 54%, 0.1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(42, 85%, 65%, 0.1) 0, transparent 50%),
                #F3E5D0; /* Rich Parchment Base */
        }
        .btn-glow {
            box-shadow: 0 10px 30px -10px rgba(229, 157, 44, 0.4);
        }
        .btn-glow:hover {
            box-shadow: 0 15px 40px -5px rgba(229, 157, 44, 0.6);
        }
        .feature-card {
            background: rgba(235, 221, 197, 0.02);
            border: 1px solid rgba(235, 221, 197, 0.05);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .feature-card:hover {
            background: rgba(138, 59, 8, 0.08); /* Darker Bronze/Gold */
            border-color: rgba(138, 59, 8, 0.2);
            transform: translateY(-10px);
        }
    </style>
</head>
<body class="antialiased bg-[#F3E5D0] text-[#1A1108] overflow-x-hidden selection:bg-secondary selection:text-white">
    <!-- Light Golden Ambient -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-[10%] -left-[10%] w-[70%] h-[70%] bg-buff/20 blur-[150px] rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[50%] h-[60%] bg-secondary/10 blur-[120px] rounded-full"></div>
    </div>

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex items-center justify-between h-24">
                <div class="flex items-center gap-4 group">
                    <div class="w-12 h-12 bg-gradient-to-tr from-secondary to-buff rounded-2xl flex items-center justify-center shadow-2xl shadow-secondary/20 rotate-12 group-hover:rotate-0 transition-transform duration-500">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <span class="text-3xl font-black text-primary tracking-tighter uppercase">Event<span class="text-secondary">ify</span></span>
                </div>

                <div class="hidden md:flex items-center gap-10">
                    <a href="#features" class="text-[10px] font-black uppercase tracking-[0.2em] text-[#1A1108]/60 hover:text-[#1A1108] transition">Fitur</a>
                    <a href="#stats" class="text-[10px] font-black uppercase tracking-[0.2em] text-[#1A1108]/60 hover:text-[#1A1108] transition">Statistik</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/redirect-role') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-secondary hover:text-[#1A1108] transition">Dashboard &rarr;</a>
                        @else
                            <a href="{{ route('register') }}" class="bg-secondary hover:bg-[#1A1108] hover:text-white px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] text-white transition-all shadow-xl shadow-secondary/20 btn-glow font-bold">Daftar Sekarang</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <header class="relative pt-48 pb-32 px-6 flex flex-col items-center justify-center text-center z-10 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10 pointer-events-none"></div>
        
        <div class="max-w-4xl space-y-12">
            <div class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-white/5 border border-white/10 text-[10px] font-black uppercase tracking-[0.5em] text-secondary animate-pulse">
                Platform Ticketing Digital
            </div>

            <h1 class="text-6xl md:text-8xl lg:text-9xl font-black text-[#1A1108] leading-[0.9] tracking-tighter uppercase drop-shadow-sm">
                KONTROL <br/> <span class="text-gradient italic">EVENT ANDA.</span>
            </h1>

            <p class="text-xl md:text-2xl text-primary font-bold max-w-2xl mx-auto leading-relaxed border-l-4 border-accent pl-8 tracking-tight">
                Eventify adalah infrastruktur manajemen event tercanggih untuk menampilkan Data real-time, scan instan, dan tiket premium.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-8 pt-8">
                @auth
                    <a href="{{ url('/redirect-role') }}" class="bg-secondary hover:bg-white text-primary px-12 py-7 rounded-[2rem] text-sm font-black uppercase tracking-[0.3em] transition-all transform hover:-translate-y-2 active:scale-95 shadow-2xl shadow-secondary/30 btn-glow flex items-center gap-3">
                        KEMBALI KE DASHBOARD
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-secondary hover:bg-white text-primary px-12 py-7 rounded-[2rem] text-sm font-black uppercase tracking-[0.3em] transition-all transform hover:-translate-y-2 active:scale-95 shadow-2xl shadow-secondary/30 btn-glow flex items-center gap-3">
                        MASUK KE AKUN SEKARANG
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Stats -->
    <section id="stats" class="py-24 px-6 z-10 relative bg-[#EBDDC5] border-y border-[#1A1108]/5 shadow-inner">
        <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-12">
            <div class="space-y-2 text-center">
                <div class="text-6xl font-black text-primary tracking-tighter italic">120+</div>
                <div class="text-[10px] font-black text-secondary uppercase tracking-[0.4em]">Event Aktif</div>
            </div>
            <div class="space-y-2 text-center">
                <div class="text-6xl font-black text-accent tracking-tighter italic">95K+</div>
                <div class="text-[10px] font-black text-secondary uppercase tracking-[0.4em]">Tiket Terjual</div>
            </div>
            <div class="space-y-2 text-center text-secondary">
                <div class="text-6xl font-black tracking-tighter italic">99<span class="text-3xl text-gray-500">.9</span>%</div>
                <div class="text-[10px] font-black uppercase tracking-[0.4em]">Server Uptime</div>
            </div>
            <div class="space-y-2 text-center">
                <div class="text-6xl font-black text-primary tracking-tighter italic">24/7</div>
                <div class="text-[10px] font-black text-secondary uppercase tracking-[0.4em]">Layanan Support</div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-40 px-6 z-10 relative bg-[#FEF9EC]">
        <div class="max-w-7xl mx-auto space-y-24">
            <div class="flex flex-col md:flex-row items-end justify-between gap-12 border-b border-white/10 pb-20">
                <h2 class="text-5xl md:text-7xl font-black text-primary uppercase tracking-tighter leading-none">
                    TEKNOLOGI <br/> <span class="text-secondary italic">TANPA BATAS.</span>
                </h2>
                <p class="max-w-md text-gray-400 font-bold uppercase tracking-tight leading-relaxed">
                    Kami membangun ekosistem tiket yang aman, cepat, dan didesain untuk menangani ribuan transaksi secara simultan tanpa lag.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="feature-card p-12 rounded-[3.5rem] group">
                    <div class="w-16 h-16 bg-accent/20 rounded-2xl flex items-center justify-center text-accent mb-8 group-hover:bg-accent group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-[#1A1108] uppercase mb-4 tracking-tight group-hover:text-accent transition-colors">Real-time Dashboard</h3>
                    <p class="text-primary/70 font-bold leading-relaxed text-sm uppercase tracking-tight group-hover:text-primary transition-colors">
                        Pantau setiap penjualan tiket detik demi detik. Lihat pendapatan Anda tumbuh secara transparan melalui grafik mutakhir.
                    </p>
                </div>

                <div class="feature-card p-12 rounded-[3.5rem] group">
                    <div class="w-16 h-16 bg-accent/20 rounded-2xl flex items-center justify-center text-accent mb-8 group-hover:bg-accent group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-[#1A1108] uppercase mb-4 tracking-tight group-hover:text-accent transition-colors">QR Verification</h3>
                    <p class="text-primary/70 font-bold leading-relaxed text-sm uppercase tracking-tight group-hover:text-primary transition-colors">
                        Simulasi validasi tiket dengan QR Code. Keamanan berlapis untuk mencegah tiket ganda dan memastikan entry lancar.
                    </p>
                </div>

                <div class="feature-card p-12 rounded-[3.5rem] group">
                    <div class="w-16 h-16 bg-accent/20 rounded-2xl flex items-center justify-center text-accent mb-8 group-hover:bg-accent group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-[#1A1108] uppercase mb-4 tracking-tight group-hover:text-accent transition-colors">Premium E-Ticket</h3>
                    <p class="text-primary/70 font-bold leading-relaxed text-sm uppercase tracking-tight group-hover:text-primary transition-colors">
                        Sistem generate e-tiket otomatis dengan desain premium. Memberikan pengalaman berkelas sejak pembeli menerima tiket mereka.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <section id="ready" class="py-32 px-6 z-10 relative bg-[#F3E5D0] border-t border-[#1A1108]/5 text-center">
        <h2 class="text-4xl md:text-6xl font-black text-[#1A1108] uppercase tracking-tighter mb-8">
            SIAP UNTUK <span class="text-secondary italic">MENGGUNAKAN EVENTIFY?</span>
        </h2>
        <a href="{{ route('register') }}" class="inline-block bg-[#1A1108] text-white px-12 py-6 rounded-2xl text-xs font-black uppercase tracking-[0.3em] hover:bg-secondary transition-all shadow-2xl">
            DAFTAR SEKARANG
        </a>
    </section>

    <footer class="py-20 px-6 bg-[#1A1108] z-10 relative">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-secondary rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </div>
                <span class="text-2xl font-black text-white tracking-tighter uppercase">Event<span class="text-secondary">ify</span></span>
            </div>
            
            <p class="text-[10px] font-black text-gray-600 uppercase tracking-[0.5em] text-center">
                &copy; {{ date('Y') }} EVENTIFY INFRASTRUCTURE. 2372004 2472001 2472003 2472043.
            </p>

            <div class="flex items-center gap-8">
                <a href="#" class="text-[10px] font-black text-gray-500 hover:text-white transition uppercase tracking-widest">Privacy</a>
                <a href="#" class="text-[10px] font-black text-gray-500 hover:text-white transition uppercase tracking-widest">Terms</a>
            </div>
        </div>
    </footer>

</body>
</html>
