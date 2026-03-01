<nav x-data="{ open: false }" class="bg-[#F3E5D0]/95 border-b-2 border-[#1A1108]/5 sticky top-0 z-[100] shadow-md backdrop-blur-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-gradient-to-tr from-primary to-secondary rounded-xl flex items-center justify-center shadow-lg transform rotate-3 group-hover:rotate-0 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <span class="text-2xl font-black tracking-tighter text-[#1A1108] uppercase">Event<span class="text-secondary">ify</span></span>
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-black text-[10px] uppercase tracking-[0.2em] border-0 hover:text-secondary px-5 py-2.5 rounded-2xl !inline-flex hover:bg-buff/30 transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-secondary !text-primary shadow-xl shadow-secondary/10 translate-y-[-2px]' : '' }}">
                        {{ __('Beranda') }}
                    </x-nav-link>

                    @if(Auth::user()->isAdmin())
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')" class="font-black text-[10px] uppercase tracking-[0.2em] border-0 hover:text-secondary px-5 py-2.5 rounded-2xl !inline-flex hover:bg-buff/30 transition-all duration-300 {{ request()->routeIs('events.*') ? 'bg-secondary !text-primary shadow-xl shadow-secondary/10 translate-y-[-2px]' : '' }}">
                        {{ __('Kelola Event') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.scan')" :active="request()->routeIs('admin.scan')" class="font-black text-[10px] uppercase tracking-[0.2em] border-0 hover:text-secondary px-5 py-2.5 rounded-2xl !inline-flex hover:bg-buff/30 transition-all duration-300 {{ request()->routeIs('admin.scan') ? 'bg-secondary !text-primary shadow-xl shadow-secondary/10 translate-y-[-2px]' : '' }}">
                        {{ __('Scan Tiket') }}
                    </x-nav-link>
                    @endif

                    @if(Auth::user()->isOrganizer())
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')" class="font-black text-[10px] uppercase tracking-[0.2em] border-0 hover:text-secondary px-5 py-2.5 rounded-2xl !inline-flex hover:bg-buff/30 transition-all duration-300 {{ request()->routeIs('events.*') ? 'bg-secondary !text-primary shadow-xl shadow-secondary/10 translate-y-[-2px]' : '' }}">
                        {{ __('Event Saya') }}
                    </x-nav-link>
                    <x-nav-link :href="route('organizer.scan')" :active="request()->routeIs('organizer.scan')" class="font-black text-[10px] uppercase tracking-[0.2em] border-0 hover:text-secondary px-5 py-2.5 rounded-2xl !inline-flex hover:bg-buff/30 transition-all duration-300 {{ request()->routeIs('organizer.scan') ? 'bg-secondary !text-primary shadow-xl shadow-secondary/10 translate-y-[-2px]' : '' }}">
                        {{ __('Terminal Scan') }}
                    </x-nav-link>
                    @endif

                    @if(!Auth::user()->isAdmin() && !Auth::user()->isOrganizer())
                    <x-nav-link :href="route('user.tickets')" :active="request()->routeIs('user.tickets')" class="font-black text-[10px] uppercase tracking-[0.2em] border-0 hover:text-secondary px-5 py-2.5 rounded-2xl !inline-flex hover:bg-buff/30 transition-all duration-300 {{ request()->routeIs('user.tickets') ? 'bg-secondary !text-primary shadow-xl shadow-secondary/10 translate-y-[-2px]' : '' }}">
                        {{ __('Tiket Saya') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings & Logout (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-6">
                <a href="{{ route('profile.edit') }}" class="flex items-center bg-[#1A1108]/5 px-5 py-2.5 rounded-2xl border-2 border-[#1A1108]/5 hover:bg-[#1A1108]/10 transition-all group">
                    <div class="w-2 h-2 rounded-full bg-secondary mr-3 shadow-[0_0_10px_rgba(229,157,44,0.3)] group-hover:scale-125 transition-transform"></div>
                    <span class="text-[10px] font-black text-[#1A1108] uppercase tracking-widest">{{ Auth::user()->name }}</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-accent/5 hover:bg-accent text-accent hover:text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] transition-all duration-300 shadow-sm border border-accent/10 hover:border-accent active:scale-95 flex items-center gap-2">
                        Keluar
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-2xl text-gray-400 hover:text-secondary hover:bg-secondary/5 focus:outline-none transition duration-150 ease-in-out border border-transparent hover:border-secondary/10">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-white/5 bg-[#0A0D14]/95 backdrop-blur-2xl">
        <div class="pt-6 pb-4 space-y-2 px-6">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-2xl font-black uppercase tracking-widest text-[10px] py-4">
                {{ __('Beranda') }}
            </x-responsive-nav-link>

            @if(Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')" class="rounded-2xl font-black uppercase tracking-widest text-[10px] py-4">
                    {{ __('Kelola Event') }}
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->isOrganizer())
                <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')" class="rounded-2xl font-black uppercase tracking-widest text-[10px] py-4">
                    {{ __('Event Saya') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-6 pb-10 border-t border-gray-50 px-6">
            <div class="flex items-center px-6 mb-8">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-2xl bg-secondary flex items-center justify-center text-primary font-black shadow-lg shadow-secondary/20">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <div class="ms-4">
                    <div class="font-black text-white uppercase tracking-tighter text-lg leading-none">{{ Auth::user()->name }}</div>
                    <div class="font-bold text-[10px] text-pearl/50 uppercase tracking-widest mt-1">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-3">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-2xl font-black uppercase tracking-widest text-[10px] py-4 bg-white/[0.03] text-pearl border border-white/5">
                    {{ __('Profil Saya') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center px-6 py-4 bg-rose-50 text-rose-600 rounded-2xl font-black uppercase tracking-widest text-[10px] hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        {{ __('Keluar dari Sistem') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
