<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-4xl text-white leading-tight tracking-tight uppercase">
                    DAFTAR <span class="text-secondary">WAITING LIST</span>
                </h2>
                <p class="text-pearl font-bold uppercase tracking-widest text-[10px] mt-2">Kelola calon pembeli yang menunggu ketersediaan tiket.</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        @if(session('success'))
            <div class="bg-secondary text-white p-6 rounded-3xl mb-8 font-black uppercase tracking-widest text-xs shadow-lg shadow-secondary-200 flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-secondary/20 overflow-hidden border border-white">
            <div class="p-8 md:p-12">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 border-b-2 border-gray-50">
                                <th class="px-6 py-4 text-left">Nama User</th>
                                <th class="px-6 py-4 text-left">Event</th>
                                <th class="px-6 py-4 text-left">Jenis Tiket</th>
                                <th class="px-6 py-4 text-left">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($waitlists as $wl)
                                <tr class="group hover:bg-secondary/10/30 transition-colors">
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <p class="text-lg font-black text-primary leading-none mb-1 uppercase tracking-tight">{{ $wl->user->name }}</p>
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $wl->user->email }}</p>
                                    </td>
                                    <td class="px-6 py-6 font-bold text-gray-500 uppercase tracking-widest text-xs">
                                        {{ $wl->event->title }}
                                    </td>
                                    <td class="px-6 py-6">
                                        <span class="inline-flex px-4 py-1.5 rounded-full bg-secondary/10 text-secondary text-[10px] font-black uppercase tracking-widest">
                                            {{ $wl->ticketType->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6">
                                        @if($wl->status === 'waiting')
                                            <span class="inline-flex px-4 py-1.5 rounded-full bg-amber-100 text-amber-600 text-[10px] font-black uppercase tracking-widest">Menunggu</span>
                                        @else
                                            <span class="inline-flex px-4 py-1.5 rounded-full bg-secondary-100 text-secondary text-[10px] font-black uppercase tracking-widest">Dinotifikasi</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-6 text-right">
                                        @if($wl->status === 'waiting')
                                            <form action="{{ route('waitlists.promote', $wl->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-secondary text-white px-6 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-secondary-700 transition-all flex items-center gap-2 ml-auto">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                                    NOTIFIKASI
                                                </button>
                                            </form>
                                        @else
                                            <p class="text-[10px] font-black text-gray-300 uppercase italic">Sudah Diproses</p>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-20 text-center">
                                        <p class="text-gray-300 font-black uppercase tracking-tight">Tidak Ada Waiting List</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($waitlists->hasPages())
                    <div class="mt-12 bg-gray-50 p-6 rounded-3xl border border-gray-100">
                        {{ $waitlists->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
