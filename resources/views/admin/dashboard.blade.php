@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto px-1 sm:px-0 antialiased text-slate-700 selection:bg-purple-100">

    {{-- HEADER BANNER (Samar & Premium) --}}
    <div class="relative overflow-hidden bg-white border border-slate-200/60 p-5 sm:p-6 rounded-2xl shadow-3xs">
        <!-- Ornamen Latar Belakang Estetik -->
        <div class="absolute top-0 right-0 w-48 h-48 bg-purple-50 rounded-full mix-blend-multiply filter blur-2xl opacity-70 pointer-events-none translate-x-10 -translate-y-10"></div>
        
        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-purple-50 border border-purple-200/50 text-purple-600 text-[10px] font-bold shadow-3xs">
                    ⚡ Pusat Kendali Utama
                </span>
                <h2 class="text-xl font-black tracking-tight text-slate-800 sm:text-2xl pt-1">
                    Selamat Datang, {{ auth()->user()->name }} 🛡️
                </h2>
                <p class="text-xs text-slate-500 max-w-xl leading-relaxed">
                    Pantau metrik sirkulasi, validasi pengajuan keanggotaan baru, dan kelola inventaris literatur digital sekolah Anda dari satu dasbor terpadu.
                </p>
            </div>
            
            {{-- Status Waktu Singkat --}}
            <div class="shrink-0 bg-slate-50 border border-slate-200/50 px-4 py-2.5 rounded-xl text-center sm:text-right hidden sm:block">
                <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Status Sistem</span>
                <span class="text-xs font-bold text-emerald-600 flex items-center justify-end gap-1.5 mt-0.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Aktif
                </span>
            </div>
        </div>
    </div>

    {{-- KARTU STATISTIK UTAMA (Responsive Grid) --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

        {{-- User Aktif --}}
        <div class="bg-white rounded-2xl shadow-3xs border border-slate-200/60 p-4 sm:p-5 flex flex-col justify-between group hover:border-purple-200 transition-all">
            <div class="flex justify-between items-start gap-2">
                <div class="space-y-0.5">
                    <p class="text-slate-400 font-bold text-[10px] uppercase tracking-wider">User Aktif</p>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tight pt-1">{{ $totalUsers }}</h3>
                </div>
                <div class="w-9 h-9 rounded-xl bg-slate-50 border border-slate-200/50 flex items-center justify-center text-base shadow-3xs group-hover:bg-purple-50 group-hover:border-purple-200 transition-colors">
                    👥
                </div>
            </div>
            <div class="pt-3 text-[10px] text-slate-400 font-medium">Anggota terverifikasi</div>
        </div>

        {{-- Total Buku --}}
        <div class="bg-white rounded-2xl shadow-3xs border border-slate-200/60 p-4 sm:p-5 flex flex-col justify-between group hover:border-purple-200 transition-all">
            <div class="flex justify-between items-start gap-2">
                <div class="space-y-0.5">
                    <p class="text-slate-400 font-bold text-[10px] uppercase tracking-wider">Total Buku</p>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tight pt-1">{{ $totalBooks }}</h3>
                </div>
                <div class="w-9 h-9 rounded-xl bg-slate-50 border border-slate-200/50 flex items-center justify-center text-base shadow-3xs group-hover:bg-purple-50 group-hover:border-purple-200 transition-colors">
                    🔖
                </div>
            </div>
            <div class="pt-3 text-[10px] text-slate-400 font-medium">Judul e-book & fisik</div>
        </div>

        {{-- Sedang Dipinjam --}}
        <div class="bg-white rounded-2xl shadow-3xs border border-slate-200/60 p-4 sm:p-5 flex flex-col justify-between group hover:border-purple-200 transition-all">
            <div class="flex justify-between items-start gap-2">
                <div class="space-y-0.5">
                    <p class="text-slate-400 font-bold text-[10px] uppercase tracking-wider">Sirkulasi</p>
                    <h3 class="text-2xl font-black text-purple-600 tracking-tight pt-1">{{ $borrowedBooks }}</h3>
                </div>
                <div class="w-9 h-9 rounded-xl bg-purple-50 border border-purple-100 flex items-center justify-center text-base shadow-3xs">
                    ⏳
                </div>
            </div>
            <div class="pt-3 text-[10px] text-purple-500 font-semibold">Sedang dibaca aktif</div>
        </div>

        {{-- Total Feedback --}}
        <div class="bg-white rounded-2xl shadow-3xs border border-slate-200/60 p-4 sm:p-5 flex flex-col justify-between group hover:border-purple-200 transition-all">
            <div class="flex justify-between items-start gap-2">
                <div class="space-y-0.5">
                    <p class="text-slate-400 font-bold text-[10px] uppercase tracking-wider">Ulasan</p>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tight pt-1">{{ $totalFeedbacks }}</h3>
                </div>
                <div class="w-9 h-9 rounded-xl bg-slate-50 border border-slate-200/50 flex items-center justify-center text-base shadow-3xs group-hover:bg-purple-50 group-hover:border-purple-200 transition-colors">
                    💬
                </div>
            </div>
            <div class="pt-3 text-[10px] text-slate-400 font-medium">Kritik & saran masuk</div>
        </div>

    </div>

    {{-- LAYOUT PANEL UTAMA (Grid Kolom Konten) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- BLOK PERLU TINDAKLANJUTI (Kiri - 2 Kolom Objek) --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/60 shadow-3xs overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/40">
                <h3 class="font-bold text-xs text-slate-800 tracking-tight uppercase tracking-wider flex items-center gap-2">
                    <span class="text-amber-500">⚠️</span> Antrean Peninjauan
                </h3>
                <span class="text-[10px] font-semibold text-slate-400">Butuh persetujuan</span>
            </div>

            <div class="divide-y divide-slate-100">
                
                {{-- Item 1: Permintaan Peminjaman --}}
                <a href="#" class="flex justify-between items-center p-4 hover:bg-slate-50/70 transition-colors group">
                    <div class="flex items-center gap-3">
                        <span class="text-xs bg-amber-50 p-1.5 rounded-lg border border-amber-100 text-amber-600">📥</span>
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-slate-900 transition-colors">Permintaan Peminjaman Buku</span>
                    </div>
                    <span class="bg-amber-50 border border-amber-200/60 text-amber-700 px-2.5 py-0.5 rounded-full text-[10px] font-bold min-w-8 text-center shadow-3xs">
                        {{ $pendingBorrowings }}
                    </span>
                </a>

                {{-- Item 2: Akun Menunggu Aktivasi --}}
                <a href="#" class="flex justify-between items-center p-4 hover:bg-slate-50/70 transition-colors group">
                    <div class="flex items-center gap-3">
                        <span class="text-xs bg-purple-50 p-1.5 rounded-lg border border-purple-100 text-purple-600">🔑</span>
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-slate-900 transition-colors">Akun Anggota Menunggu Aktivasi</span>
                    </div>
                    <span class="bg-purple-50 border border-purple-200/60 text-purple-700 px-2.5 py-0.5 rounded-full text-[10px] font-bold min-w-8 text-center shadow-3xs">
                        {{ $inactiveUsers }}
                    </span>
                </a>

                {{-- Item 3: Buku Terlambat --}}
                <a href="#" class="flex justify-between items-center p-4 hover:bg-slate-50/70 transition-colors group">
                    <div class="flex items-center gap-3">
                        <span class="text-xs bg-rose-50 p-1.5 rounded-lg border border-rose-100 text-rose-600">🚨</span>
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-slate-900 transition-colors">Buku Melebihi Batas Tenggat (Terlambat)</span>
                    </div>
                    <span class="bg-rose-50 border border-rose-200/60 text-rose-700 px-2.5 py-0.5 rounded-full text-[10px] font-bold min-w-8 text-center shadow-3xs">
                        {{ $lateBorrowings }}
                    </span>
                </a>

                {{-- Item 4: Feedback Belum Dibalas --}}
                <a href="#" class="flex justify-between items-center p-4 hover:bg-slate-50/70 transition-colors group">
                    <div class="flex items-center gap-3">
                        <span class="text-xs bg-slate-100 p-1.5 rounded-lg border border-slate-200 text-slate-600">✉️</span>
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-slate-900 transition-colors">Kotak Pesan Ulasan Belum Dijawab</span>
                    </div>
                    <span class="bg-slate-50 border border-slate-200 text-slate-600 px-2.5 py-0.5 rounded-full text-[10px] font-bold min-w-8 text-center shadow-3xs">
                        {{ $waitingFeedback }}
                    </span>
                </a>

            </div>
        </div>

        {{-- BLOK QUICK ACTION (Kanan - 1 Kolom Objek) --}}
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-3xs overflow-hidden h-fit">
            <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/40">
                <h3 class="font-bold text-xs text-slate-800 tracking-tight uppercase tracking-wider flex items-center gap-2">
                    <span>🚀</span> Pintasan Kilat
                </h3>
            </div>
            
            <div class="p-4 grid grid-cols-2 gap-2">
                <a href="{{ route('admin.books.create') }}" class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-slate-200/60 bg-slate-50/50 hover:bg-purple-50/50 hover:border-purple-300 text-center transition-all group">
                    <span class="text-lg mb-1 group-hover:scale-110 transition-transform">📘</span>
                    <span class="text-[11px] font-bold text-slate-700 group-hover:text-purple-700">Tambah Buku</span>
                </a>

                <a href="{{ route('admin.users.create') }}" class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-slate-200/60 bg-slate-50/50 hover:bg-purple-50/50 hover:border-purple-300 text-center transition-all group">
                    <span class="text-lg mb-1 group-hover:scale-110 transition-transform">👤</span>
                    <span class="text-[11px] font-bold text-slate-700 group-hover:text-purple-700">Tambah User</span>
                </a>

                <a href="{{ route('admin.categories.create') }}" class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-slate-200/60 bg-slate-50/50 hover:bg-purple-50/50 hover:border-purple-300 text-center transition-all group">
                    <span class="text-lg mb-1 group-hover:scale-110 transition-transform">🏷️</span>
                    <span class="text-[11px] font-bold text-slate-700 group-hover:text-purple-700">Kategori</span>
                </a>

                <a href="{{ route('admin.kelas.create') }}" class="flex flex-col items-center justify-center p-3.5 rounded-xl border border-slate-200/60 bg-slate-50/50 hover:bg-purple-50/50 hover:border-purple-300 text-center transition-all group">
                    <span class="text-lg mb-1 group-hover:scale-110 transition-transform">🏫</span>
                    <span class="text-[11px] font-bold text-slate-700 group-hover:text-purple-700">Tambah Kelas</span>
                </a>
            </div>
        </div>

    </div>

    {{-- PANEL AKTIVITAS TERBARU (Lebar Penuh) --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-3xs overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/40">
            <h3 class="font-bold text-xs text-slate-800 tracking-tight uppercase tracking-wider flex items-center gap-2">
                <span>🕒</span> Log Aktivitas Sistem Terbaru
            </h3>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse ($activities as $activity)
                <a href="{{ $activity['url'] }}" class="block p-4 sm:px-5 hover:bg-slate-50/70 transition-colors">
                    <div class="flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-200/60 flex items-center justify-center text-sm shadow-3xs shrink-0 mt-0.5">
                            {{ $activity['icon'] }}
                        </div>

                        <div class="flex-1 min-w-0 space-y-0.5">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                <h4 class="font-bold text-xs text-slate-800 truncate">{{ $activity['title'] }}</h4>
                                <span class="text-[10px] text-slate-400 font-medium shrink-0">{{ $activity['created_at']->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-slate-500 truncate leading-relaxed">{{ $activity['message'] }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-8 text-center text-slate-400 text-xs font-medium space-y-1">
                    <div>📭</div>
                    <div>Belum ada rekaman jejak aktivitas masuk saat ini.</div>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection