<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Eventify') }}</title>

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Fonts -->
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
                        }
                    }
                }
            }
        </script>

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .bg-mesh {
                background: 
                    radial-gradient(at 0% 0%, hsla(37, 77%, 54%, 0.1) 0, transparent 50%), 
                    radial-gradient(at 100% 0%, hsla(42, 85%, 65%, 0.1) 0, transparent 50%),
                    #F3E5D0;
            }
            @media print {
                nav, footer, button, .print-hidden {
                    display: none !important;
                }
                body { background: white !important; color: black !important; }
                header { background: #f3f4f6 !important; border: 1px solid #e5e7eb !important; }
                h2, h3, h4, p { color: black !important; }
                .max-w-7xl { max-width: 100% !important; margin: 0 !important; width: 100% !important; padding: 0 !important; }
                .shadow-2xl, .shadow-xl, .shadow-md { box-shadow: none !important; border: 1px solid #eee !important; }
                .bg-secondary { background: #4f46e5 !important; color: white !important; -webkit-print-color-adjust: exact; }
                canvas { max-width: 100% !important; }
            }
            .feature-card {
            background: rgba(235, 221, 197, 0.02);
            border: 1px solid rgba(235, 221, 197, 0.05);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .feature-card:hover {
            background: rgba(229, 157, 44, 0.05);
            border-color: rgba(229, 157, 44, 0.2);
            transform: translateY(-10px);
        }
    </style>
    </head>
    <body class="antialiased text-[#1A1108] bg-[#F3E5D0] selection:bg-secondary selection:text-white">
        <div class="min-h-screen">
            <div class="print-hidden">
                @include('layouts.navigation')
            </div>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-mesh border-b border-white/5 py-16 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <footer class="py-12 border-t border-gray-100 mt-12 print-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p class="text-[10px] font-black text-primary uppercase tracking-[0.5em]">&copy; {{ date('Y') }} EVENTIFY INFRASTRUCTURE</p>
                </div>
            </footer>
        </div>
    </body>
</html>
