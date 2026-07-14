@extends('layouts.app')

@section('title', 'Detail Data Kelas')
@section('page-title', 'Detail Data Kelas')

@section('content')
<div class="max-w-7xl mx-auto space-y-6 px-2 sm:px-0">

    {{-- Header Page --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-50 border border-slate-200/60 rounded-2xl p-5 shadow-xs">
        <div>
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <span>📂</span> Detail Manajemen Kelas
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Pantau statistik rasio keaktifan akun dan daftar siswa terdaftar dalam kluster kelas ini.
            </p>
        </div>
        
        <div class="flex items-center gap-2 self-start sm:self-auto w-full sm:w-auto">
            <a href="{{ route('admin.kelas.edit', $kelas) }}" 
               class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-amber-50 text-amber-700 border border-amber-200/60 text-xs font-bold rounded-xl hover:bg-amber-100 transition-all shadow-2xs">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>
                Ubah Data
            </a>
            
            <a href="{{ route('admin.kelas.index') }}" 
               class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1.5 px-4 py-2 border border-slate-200 bg-white text-xs font-bold text-slate-600 rounded-xl hover:bg-slate-50 shadow-2xs transition-all">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    {{-- Panel Metrik & Informasi Kelas --}}
    <div class="bg-white border border-slate-200/60 rounded-2xl p-5 sm:p-6 shadow-xs space-y-6">
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
            <span>📊</span> Rangkuman Informasi & Status Kelas
        </h3>

        {{-- Grid Statistik Akun --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <div class="bg-slate-50/70 border border-slate-100 p-4 rounded-xl">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Identitas Kelas</span>
                <span class="text-base font-black text-slate-700 block mt-1">🚪 {{ $kelas->kelas }}</span>
            </div>
            
            <div class="bg-blue-50/40 border border-blue-100/60 p-4 rounded-xl">
                <span class="text-[10px] font-bold text-blue-500/80 uppercase tracking-wider block">Total Terintegrasi</span>
                <span class="text-base font-black text-blue-600 block mt-1">👥 {{ $kelas->users_count }} Siswa</span>
            </div>

            <div class="bg-emerald-50/40 border border-emerald-100/60 p-4 rounded-xl">
                <span class="text-[10px] font-bold text-emerald-500/80 uppercase tracking-wider block">Konfirmasi Aktif</span>
                <span class="text-base font-black text-emerald-600 block mt-1">🟢 {{ $kelas->active_users_count }} Siswa</span>
            </div>

            <div class="bg-rose-50/40 border border-rose-100/60 p-4 rounded-xl">
                <span class="text-[10px] font-bold text-rose-500/80 uppercase tracking-wider block">Ditangguhkan / Pasif</span>
                <span class="text-base font-black text-rose-600 block mt-1">🔴 {{ $kelas->inactive_users_count }} Siswa</span>
            </div>
        </div>

        {{-- Meta Log Informasi --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-b border-slate-100 py-4 text-xs">
            <div class="flex items-center gap-2 text-slate-500">
                <span class="text-base">📅</span>
                <span>Waktu Registrasi Sistem: <strong class="text-slate-700">{{ $kelas->created_at->translatedFormat('d F Y') }}</strong></span>
            </div>
            <div class="flex items-center gap-2 text-slate-500">
                <span class="text-base">🔄</span>
                <span>Pembaruan Data Terakhir: <strong class="text-slate-700">{{ $kelas->updated_at->translatedFormat('d F Y') }}</strong></span>
            </div>
        </div>

        {{-- Deskripsi Tambahan --}}
        <div class="space-y-1.5">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Catatan / Deskripsi Kelas</span>
            <div class="text-xs sm:text-sm text-slate-600 leading-relaxed bg-slate-50/40 border border-slate-100 p-3.5 rounded-xl">
                {{ $kelas->description ?: 'Tidak ada deskripsi tambahan untuk entitas kelas ini.' }}
            </div>
        </div>
    </div>

    {{-- Section Daftar Anggota Siswa --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-xs overflow-hidden">
        
        <div class="p-5 border-b border-slate-100 bg-slate-50/30">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                <span>📋</span> Koleksi Siswa Terdaftar Aktif
            </h3>
            <p class="text-[11px] text-slate-400 mt-0.5 font-medium">
                Ditemukan total sejumlah {{ $users->total() }} akun dengan status aktif saat ini.
            </p>
        </div>

        {{-- Mode Desktop View (Table Layout) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50/60">
                    <tr class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-3.5 w-16 text-center">No</th>
                        <th class="px-6 py-3.5">Nama Lengkap</th>
                        <th class="px-6 py-3.5">Nomor Induk Siswa (NIS)</th>
                        <th class="px-6 py-3.5">Alamat Surat Elektronik (Email)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white text-xs">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-4 text-center text-slate-400 font-medium">
                                {{ $users->firstItem() + $loop->index }}
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-700">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 font-mono text-slate-600 tracking-wide">
                                {{ $user->nis_nip }}
                            </td>
                            <td class="px-6 py-4 text-slate-500 font-medium">
                                {{ $user->email }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 text-xs font-medium text-slate-400 bg-slate-50/20">
                                🍃 Belum terdeteksi adanya siswa dengan status aktif di dalam kelas ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mode Mobile View (Card List Layout) --}}
        <div class="block md:hidden divide-y divide-slate-100">
            @forelse($users as $user)
                <div class="p-4 bg-white space-y-2 text-xs">
                    <div class="flex items-center justify-between gap-2">
                        <span class="font-bold text-slate-700">{{ $user->name }}</span>
                        <span class="text-[10px] font-mono text-slate-400 px-2 py-0.5 bg-slate-100 rounded border border-slate-200/40">
                            #{{ $user->nis_nip }}
                        </span>
                    </div>
                    <div class="text-[11px] text-slate-500 flex items-center gap-1.5">
                        <span class="text-slate-400">✉️</span> {{ $user->email }}
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-xs font-medium text-slate-400 p-4">
                    🍃 Belum terdeteksi adanya siswa dengan status aktif di dalam kelas ini.
                </div>
            @endforelse
        </div>

    </div>

    {{-- Footer Pagination --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2 text-xs">
        <p class="text-slate-500 font-medium text-center sm:text-left">
            Menampilkan indeks <strong>{{ $users->firstItem() ?? 0 }}</strong> - <strong>{{ $users->lastItem() ?? 0 }}</strong> dari akumulasi <strong>{{ $users->total() }}</strong> entitas siswa.
        </p>
        <div class="flex justify-center sm:justify-end">
            {{ $users->onEachSide(1)->links() }}
        </div>
    </div>

</div>
@endsection