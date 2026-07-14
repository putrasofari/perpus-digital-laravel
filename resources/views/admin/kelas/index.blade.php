@extends('layouts.app')

@section('title', 'Data Kelas')
@section('page-title', 'Data Kelas')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6 px-2 sm:px-0">

        {{-- Header Page --}}
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-50 border border-slate-200/60 rounded-2xl p-5 shadow-xs">
            <div>
                <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <span>🏫</span> Manajemen Data Kelas
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">
                    Kelola parameter kelompok data kelas yang terdaftar aktif dalam sistem otomasi perpustakaan.
                </p>
            </div>

            <a href="{{ route('admin.kelas.create') }}"
                class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-slate-800 hover:bg-slate-900 text-xs font-bold text-white rounded-xl shadow-xs transition-all self-start sm:self-auto">
                <span>➕</span> Tambah Kelas Baru
            </a>
        </div>

        {{-- Search Filter --}}
        <div class="bg-white rounded-2xl border border-slate-200/60 p-4 shadow-xs">
            <form method="GET">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <span
                            class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-xs text-slate-400">🔍</span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari kluster nama kelas..."
                            class="w-full pl-9 rounded-xl border border-slate-300 text-xs p-2.5 text-slate-800 focus:ring-1 focus:ring-slate-400 focus:border-slate-400 focus:outline-none">
                    </div>
                    <button
                        class="w-full sm:w-auto px-6 py-2.5 bg-slate-100 hover:bg-slate-200 border border-slate-300 text-slate-700 text-xs font-bold rounded-xl transition-all">
                        Cari Data
                    </button>
                </div>
            </form>
        </div>

        {{-- Render Content Area --}}
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-xs overflow-hidden">

            {{-- Mode Desktop View (Table Layout) --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50">
                        <tr class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-3.5 w-16 text-center">No</th>
                            <th class="px-6 py-3.5">Nama Ruang Kelas</th>
                            <th class="px-6 py-3.5 text-center">Rasio Akun Aktif</th>
                            <th class="px-6 py-3.5">Tanggal Registrasi</th>
                            <th class="px-6 py-3.5 text-center w-40">Modifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($kelas as $k)
                            {{-- Row Clickable mengarah ke show --}}
                            <tr onclick="window.location='{{ route('admin.kelas.show', $k) }}'"
                                class="hover:bg-slate-50/80 cursor-pointer transition-all group">

                                <td class="px-6 py-4 whitespace-nowrap text-center text-xs text-slate-400 font-medium">
                                    {{ $kelas->firstItem() + $loop->index }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="text-xs font-bold text-slate-700 group-hover:text-blue-600 transition-colors flex items-center gap-1.5">
                                        {{ $k->kelas }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-md bg-emerald-50 border border-emerald-150 text-emerald-600 text-[10px] font-bold shadow-3xs">
                                        👥 {{ $k->active_users_count ?? 0 }} Anggota
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 font-medium">
                                    📅 {{ $k->created_at->format('d M Y') }}
                                </td>

                                {{-- Kolom Aksi (Menghentikan event klik row induk dengan stopPropagation) --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-xs"
                                    onclick="event.stopPropagation();">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('admin.kelas.edit', $k) }}"
                                            class="p-1.5 bg-amber-50 text-amber-600 border border-amber-200/60 rounded-lg hover:bg-amber-100 transition-all shadow-3xs"
                                            title="Edit Data Kelas">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.kelas.destroy', $k) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                onclick="return confirm('Yakin ingin menghapus kluster kelas ini secara permanen?')"
                                                class="p-1.5 bg-rose-50 text-rose-600 border border-rose-200/60 rounded-lg hover:bg-rose-100 transition-all shadow-3xs"
                                                title="Hapus Kelas">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="text-center py-12 text-xs font-medium text-slate-400 bg-slate-50/40">
                                    📦 Belum ada arsip data kelas yang terekam.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mode Mobile View (Card List Layout) --}}
            <div class="block md:hidden divide-y divide-slate-100">
                @forelse ($kelas as $k)
                    <div onclick="window.location='{{ route('admin.kelas.show', $k) }}'"
                        class="p-4 hover:bg-slate-50/50 cursor-pointer transition-all space-y-3 relative group">

                        <div class="flex items-center justify-between">
                            <div class="text-xs font-bold text-slate-700 flex items-center gap-1">
                                <span>🚪</span> {{ $k->kelas }}
                            </div>
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded bg-emerald-50 border border-emerald-100 text-emerald-600 text-[9px] font-bold">
                                👥 {{ $k->active_users_count ?? 0 }} Anggota
                            </span>
                        </div>

                        <div class="flex items-center justify-between pt-2 border-t border-slate-50 text-[10px]">
                            <span class="text-slate-400 font-medium">
                                📅 {{ $k->created_at->format('d M Y') }}
                            </span>

                            {{-- Area Aksi Ponsel --}}
                            <div class="flex items-center gap-2" onclick="event.stopPropagation();">
                                <a href="{{ route('admin.kelas.edit', $k) }}"
                                    class="p-1.5 bg-amber-50 text-amber-600 border border-amber-200/50 rounded-lg text-xs">
                                    ✏️
                                </a>
                                <form action="{{ route('admin.kelas.destroy', $k) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus kelas ini?')"
                                        class="p-1.5 bg-rose-50 text-rose-600 border border-rose-200/50 rounded-lg text-xs">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="text-center py-10 text-xs font-medium text-slate-400 p-4">
                        📦 Belum ada arsip data kelas yang terekam.
                    </div>
                @endforelse
            </div>

        </div>

        {{-- Footer Pagination --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2 text-xs">
            <p class="text-slate-500 font-medium text-center sm:text-left">
                Menampilkan data ke-<strong>{{ $kelas->firstItem() ?? 0 }}</strong> sampai
                <strong>{{ $kelas->lastItem() ?? 0 }}</strong> dari total <strong>{{ $kelas->total() }}</strong> entitas
                kelas.
            </p>
            <div class="flex justify-center sm:justify-end">
                {{ $kelas->onEachSide(1)->links() }}
            </div>
        </div>

    </div>
@endsection
