<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Eventify') }}</title>

        <!-- Tailwind CDN & Fonts (For instant styling on XAMPP) -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;700;800&display=swap" rel="stylesheet">

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
                            'fade-in-down': 'fade-in-down 0.5s ease-out',
                        },
                        keyframes: {
                            'fade-in-down': {
                                '0%': { opacity: '0', transform: 'translateY(-10px)' },
                                '100%': { opacity: '1', transform: 'translateY(0)' },
                            }
                        }
                    }
                }
            }
        </script>

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .bg-glow-custom { background: radial-gradient(circle at 50% 50%, rgba(229, 157, 44, 0.05) 0%, transparent 80%); }
        </style>
    </head>
    <body class="antialiased selection:bg-secondary selection:text-white bg-[#F3E5D0] text-[#1A1108]">
        <div class="min-h-screen flex flex-col justify-center items-center p-6 relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute inset-0 bg-glow-custom pointer-events-none"></div>
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-secondary/5 blur-[120px] rounded-full"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-accent/5 blur-[120px] rounded-full"></div>

            <div class="w-full sm:max-w-md relative z-10">
                <!-- Logo -->
                <div class="text-center mb-12">
                    <a href="/" class="inline-flex items-center gap-4 transition-transform hover:scale-105 duration-300">
                        <div class="w-14 h-14 bg-gradient-to-tr from-secondary to-accent rounded-2xl flex items-center justify-center shadow-2xl shadow-secondary/20 transform rotate-12">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <span class="text-3xl font-bold tracking-tighter uppercase italic text-[#1A1108] font-black tracking-tight">Event<span class="text-secondary">ify</span></span>
                    </a>
                </div>

                <!-- Form Card -->
                <div class="bg-white/80 backdrop-blur-3xl border-2 border-[#1A1108]/10 shadow-2xl rounded-[2.5rem] p-10 md:p-14 text-[#1A1108]">
                    {{ $slot }}
                </div>
                
                <p class="text-center mt-12 text-[10px] font-bold text-gray-600 uppercase tracking-[0.4em] opacity-50">
                    &copy; {{ date('Y') }} EVENTIFY INFRASTRUCTURE
                </p>
            </div>
        </div>
    </body>
</html>
