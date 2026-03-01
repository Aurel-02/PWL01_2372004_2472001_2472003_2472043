<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-4xl text-[#1A1108] leading-tight tracking-tight uppercase">
                    KELOLA <span class="text-secondary">{{ $role === 'organizer' ? 'ORGANIZER' : 'USER' }}</span>
                </h2>
                <p class="text-accent font-bold uppercase tracking-widest text-[10px] mt-2">Daftar pengguna terdaftar dalam ekosistem Eventify.</p>
            </div>
            <div class="flex gap-2 bg-[#1A1108]/5 p-2 rounded-2xl border border-[#1A1108]/10">
                <a href="{{ route('admin.users.index', ['role' => 'user']) }}" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $role === 'user' ? 'bg-[#1A1108] text-white shadow-lg' : 'text-[#1A1108]/40 hover:bg-[#1A1108]/10' }}">Regular Users</a>
                <a href="{{ route('admin.users.index', ['role' => 'organizer']) }}" class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $role === 'organizer' ? 'bg-[#1A1108] text-white shadow-lg' : 'text-[#1A1108]/40 hover:bg-[#1A1108]/10' }}">Organizers</a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-secondary/20 overflow-hidden border border-white">
            <div class="p-8 md:p-12">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-[#1A1108]/50 border-b-2 border-gray-50">
                                <th class="px-6 py-4 text-left">Nama</th>
                                <th class="px-6 py-4 text-left">Email</th>
                                <th class="px-6 py-4 text-left">Saldo</th>
                                <th class="px-6 py-4 text-left">Terdaftar</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($users as $user)
                                <tr class="group hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <p class="text-lg font-black text-[#1A1108] leading-none uppercase tracking-tight">{{ $user->name }}</p>
                                    </td>
                                    <td class="px-6 py-6 font-bold text-primary text-xs">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-6 font-black text-secondary text-sm">
                                        Rp {{ number_format($user->balance ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-6 text-primary text-[10px] font-bold uppercase tracking-widest">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-6 text-right">
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-3 bg-white border border-gray-100 rounded-xl text-gray-400 hover:text-red-500 hover:shadow-lg transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-20 text-center text-gray-300 font-black uppercase">Belum Ada Pengguna</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
