@extends('layouts.app')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="max-w-7xl mx-auto space-y-6 px-2 sm:px-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-50 border border-slate-200/60 rounded-2xl p-5 shadow-xs">
        <div>
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <span>🛡️</span> Manajemen Data User
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Kelola hak akses akun administrator dan pengunjung dalam satu pusat kontrol terpadu.
            </p>
        </div>
        
        <a href="{{ route('admin.users.create') }}" 
           class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-xs font-bold text-white rounded-xl shadow-xs transition-all self-start sm:self-auto">
            <span>➕</span> Tambah User Baru
        </a>
    </div>

    {{-- STATISTIK RAMPING --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        {{-- Total User --}}
        <div class="bg-white border border-slate-200/60 rounded-2xl p-4 shadow-3xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Pengguna</p>
                <h2 class="text-2xl font-black text-slate-700 leading-tight">{{ $totalUsers }}</h2>
            </div>
            <div class="p-2.5 bg-blue-50/60 text-blue-500 border border-blue-100 rounded-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0110.081 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
        </div>

        {{-- Admin --}}
        <div class="bg-white border border-slate-200/60 rounded-2xl p-4 shadow-3xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-[10px] font-bold uppercase tracking-wider text-purple-400">Administrator</p>
                <h2 class="text-2xl font-black text-purple-600 leading-tight">{{ $totalAdmin }}</h2>
            </div>
            <div class="p-2.5 bg-purple-50/60 text-purple-500 border border-purple-100 rounded-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
            </div>
        </div>

        {{-- Pengunjung --}}
        <div class="bg-white border border-slate-200/60 rounded-2xl p-4 shadow-3xs flex items-center justify-between">
            <div class="space-y-1">
                <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-400">Pengunjung</p>
                <h2 class="text-2xl font-black text-emerald-600 leading-tight">{{ $totalPengunjung }}</h2>
            </div>
            <div class="p-2.5 bg-emerald-50/60 text-emerald-500 border border-emerald-100 rounded-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.62 48.62 0 0112 20.9c4.956 0 9.31-1.766 12.74-4.679.135-.11.23-.27.23-.448a60.428 60.428 0 00-.491-6.347m-20.218 0l6.23-3.49c1.1-.617 2.454-.617 3.55 0l6.23 3.49m-16.01 0c2.29 1.282 5.07 1.96 7.76 1.96s5.47-.678 7.76-1.96m0 0l1.01-1.01m0 0l1.01 1.01" />
                </svg>
            </div>
        </div>
    </div>

    {{-- BARIS FILTER MODERN --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-xs p-4">
        <form method="GET" class="flex flex-col md:flex-row gap-3">
            {{-- SEARCH INPUT --}}
            <div class="flex-1 relative">
                <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-xs text-slate-400">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama lengkap atau alamat email..."
                    class="w-full pl-9 rounded-xl border border-slate-300 text-xs p-2.5 text-slate-800 focus:ring-1 focus:ring-slate-400 focus:border-slate-400 focus:outline-none">
            </div>

            {{-- FILTER ROLE --}}
            <div class="w-full md:w-52">
                <select name="role"
                    class="w-full rounded-xl border border-slate-300 text-xs p-2.5 text-slate-700 focus:ring-1 focus:ring-slate-400 focus:border-slate-400 focus:outline-none bg-white">
                    <option value="">Semua Hak Akses</option>
                    <option value="admin" @selected(request('role') == 'admin')>🛡️ Admin</option>
                    <option value="user" @selected(request('role') == 'user')>👥 Pengunjung</option>
                </select>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex items-center gap-2">
                <button type="submit"
                    class="w-full md:w-auto px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl transition-all shadow-xs">
                    Terapkan
                </button>
                <a href="{{ route('admin.users.index') }}"
                    class="w-full md:w-auto px-5 py-2.5 bg-slate-100 hover:bg-slate-200 border border-slate-300 text-slate-700 text-xs font-bold rounded-xl text-center transition-all">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- DATA TABLE CONTAINER --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-xs overflow-hidden">
        
        {{-- Mode Desktop View (Table Layout) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100 text-xs">
                <thead class="bg-slate-50">
                    <tr class="text-left font-bold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-3.5">Data Pengguna</th>
                        <th class="px-6 py-3.5">Alamat Email</th>
                        <th class="px-6 py-3.5">Hak Akses</th>
                        <th class="px-6 py-3.5">Status Akun</th>
                        <th class="px-6 py-3.5 text-center w-48">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            {{-- Nama dengan Inisial Avatar --}}
                            <td class="px-6 py-4 font-bold text-slate-800">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 border border-slate-200 flex items-center justify-center font-bold text-[10px] uppercase shadow-3xs">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <span>{{ $user->name }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-slate-500 font-medium">
                                {{ $user->email }}
                            </td>

                            {{-- BADGE ROLE --}}
                            <td class="px-6 py-4">
                                @if ($user->role == 'admin')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded bg-purple-50 border border-purple-150 text-purple-600 font-bold shadow-3xs">
                                        🛡️ Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded bg-emerald-50 border border-emerald-150 text-emerald-600 font-bold shadow-3xs">
                                        👥 Pengunjung
                                    </span>
                                @endif
                            </td>

                            {{-- BADGE STATUS --}}
                            <td class="px-6 py-4">
                                @if ($user->is_active)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded bg-green-50 border border-green-150 text-green-600 font-bold shadow-3xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded bg-rose-50 border border-rose-150 text-rose-600 font-bold shadow-3xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span> Nonaktif
                                    </span>
                                @endif
                            </td>

                            {{-- COMPACT ICON ACTIONS --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.users.edit', $user) }}" 
                                       class="p-1.5 bg-amber-50 text-amber-600 border border-amber-200/60 rounded-lg hover:bg-amber-100 transition-all shadow-3xs"
                                       title="Edit Data Pengguna">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>

                                    {{-- RESET PASSWORD --}}
                                    <form action="{{ route('admin.users.reset-password', $user) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" 
                                                onclick="return confirm('Reset password user ini menjadi default?')"
                                                class="p-1.5 bg-blue-50 text-blue-600 border border-blue-200/60 rounded-lg hover:bg-blue-100 transition-all shadow-3xs"
                                                title="Reset Sandi">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                            </svg>
                                        </button>
                                    </form>

                                    {{-- SWITCH TOGGLE STATUS --}}
                                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                                title="{{ $user->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}"
                                                class="p-1.5 border rounded-lg transition-all shadow-3xs {{ $user->is_active ? 'bg-rose-50 text-rose-600 border-rose-200/60 hover:bg-rose-100' : 'bg-emerald-50 text-emerald-600 border-emerald-200/60 hover:bg-emerald-100' }}">
                                            @if ($user->is_active)
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                            @else
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </button>
                                    </form>

                                    {{-- HAPUS (Kecuali Diri Sendiri) --}}
                                    @if ($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus permanen pengguna ini?')"
                                                    class="p-1.5 bg-rose-50 text-rose-600 border border-rose-200/60 rounded-lg hover:bg-rose-100 transition-all shadow-3xs"
                                                    title="Hapus Permanen">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-xs font-medium text-slate-400 bg-slate-50/40">
                                🍃 Tidak ada data pengguna yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mode Mobile View (Card List Layout) --}}
        <div class="block md:hidden divide-y divide-slate-100">
            @forelse($users as $user)
                <div class="p-4 hover:bg-slate-50/50 transition-all space-y-3 text-xs relative group">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 border border-slate-200/60 flex items-center justify-center font-bold text-[10px] uppercase">
                            {{ substr($user->name, 0, 2) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="font-bold text-slate-800 truncate">{{ $user->name }}</h4>
                            <p class="text-[10px] text-slate-400 truncate">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-2 pt-2 border-t border-slate-50">
                        <div class="flex gap-1.5">
                            @if ($user->role == 'admin')
                                <span class="px-1.5 py-0.5 rounded bg-purple-50 border border-purple-100 text-purple-600 text-[9px] font-bold">Admin</span>
                            @else
                                <span class="px-1.5 py-0.5 rounded bg-emerald-50 border border-emerald-100 text-emerald-600 text-[9px] font-bold">Pengunjung</span>
                            @endif

                            @if ($user->is_active)
                                <span class="px-1.5 py-0.5 rounded bg-green-50 border border-green-100 text-green-600 text-[9px] font-bold">Aktif</span>
                            @else
                                <span class="px-1.5 py-0.5 rounded bg-rose-50 border border-rose-100 text-rose-600 text-[9px] font-bold">Nonaktif</span>
                            @endif
                        </div>

                        {{-- Area Aksi Ponsel --}}
                        <div class="flex items-center gap-1.5">
                            {{-- EDIT --}}
                            <a href="{{ route('admin.users.edit', $user) }}" 
                               class="p-1 bg-amber-50 text-amber-600 border border-amber-200/50 rounded-lg text-xs">
                                ✏️
                            </a>

                            {{-- RESET PASSWORD --}}
                            <form action="{{ route('admin.users.reset-password', $user) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" onclick="return confirm('Reset password user ini?')"
                                        class="p-1 bg-blue-50 text-blue-600 border border-blue-200/50 rounded-lg text-xs">
                                    🔑
                                </button>
                            </form>

                            {{-- TOGGLE STATUS --}}
                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" 
                                        class="p-1 rounded-lg text-xs {{ $user->is_active ? 'bg-rose-50 text-rose-600 border border-rose-200/50' : 'bg-emerald-50 text-emerald-600 border border-emerald-200/50' }}">
                                    @if ($user->is_active) 📵 @else 🟢 @endif
                                </button>
                            </form>

                            {{-- HAPUS (Kecuali Diri Sendiri) --}}
                            @if ($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus user ini?')"
                                            class="p-1 bg-rose-50 text-rose-600 border border-rose-200/50 rounded-lg text-xs">
                                        🗑️
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-xs font-medium text-slate-400 p-4">
                    🍃 Tidak ada data pengguna yang ditemukan.
                </div>
            @endforelse
        </div>

    </div>

    {{-- PAGINATION --}}
    @if ($users->hasPages())
        <div class="pt-2">
            {{ $users->links() }}
        </div>
    @endif

</div>
@endsection