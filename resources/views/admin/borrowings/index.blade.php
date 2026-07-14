@extends('layouts.app')

@section('title', 'Laporan Peminjaman Buku')
@section('page-title', 'Laporan Peminjaman Buku')

@section('content')
<div class="max-w-7xl mx-auto space-y-6 px-2 sm:px-0">

    {{-- Bagian Header & Kontrol Pencarian Global --}}
    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-5 sm:p-6 shadow-sm">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight flex items-center gap-2">
                    <span>📊</span> Laporan & Log Peminjaman
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">
                    Pantau seluruh sirkulasi log transaksi, filter data peminjam, serta kelola validasi status buku secara terpusat.
                </p>
            </div>

            {{-- Formulir Pencarian Multivariabel Admin --}}
            <form method="GET" class="w-full lg:w-auto">
                <div class="relative w-full lg:w-80">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari judul buku, nama / kelas..."
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 pl-10 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none transition-all">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.603 10.601z" />
                        </svg>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Banner Notifikasi Aksi Sukses --}}
    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2 shadow-xs">
            <span>✨</span> <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Tabel Utama Laporan Manajemen Peminjaman --}}
    <div class="overflow-hidden bg-white rounded-2xl border border-slate-200/80 shadow-xs">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50">
                    <tr class="text-left text-xs font-bold text-slate-450 uppercase tracking-wider">
                        <th class="px-6 py-4">Peminjam / Anggota</th>
                        <th class="px-6 py-4">Detail Buku</th>
                        <th class="px-6 py-4 text-center">Jumlah</th>
                        <th class="px-6 py-4">Tanggal Pengajuan</th>
                        <th class="px-6 py-4">Status Transaksi</th>
                        <th class="px-6 py-4 text-center">Manajemen</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($borrowings as $borrowing)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            
                            {{-- Kolom 1: Profil Peminjam --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-bold text-slate-800 text-sm flex items-center gap-1.5">
                                    <span>👤</span> {{ $borrowing->user->name }}
                                </div>
                                <div class="text-xs text-slate-450 font-medium mt-0.5 pl-5">
                                    Kelas: {{ $borrowing->user->kelas->kelas }}
                                </div>
                            </td>

                            {{-- Kolom 2: Detail Spesifikasi Buku --}}
                            <td class="px-6 py-4 whitespace-nowrap sm:whitespace-normal max-w-xs">
                                <div class="font-bold text-slate-700 text-sm">
                                    {{ $borrowing->book->judul }}
                                </div>
                                <div class="text-xs text-slate-400 font-medium mt-0.5 flex items-center gap-1">
                                    <span>✍️</span> {{ $borrowing->book->penulis }}
                                </div>
                            </td>

                            {{-- Kolom 3: Volume Kuantitas --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-xs font-bold">
                                    {{ $borrowing->quantity }} Eks.
                                </span>
                            </td>

                            {{-- Kolom 4: Waktu Request --}}
                            <td class="px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-slate-600 font-medium">
                                {{ \Carbon\Carbon::parse($borrowing->requested_at)->translatedFormat('d M Y') }}
                            </td>

                            {{-- Kolom 5: Badge Status Terkontrol --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($borrowing->is_late)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-red-50 text-red-700 border border-red-200/60 text-xs font-bold shadow-2xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                        Terlambat {{ $borrowing->late_days }} Hari
                                    </span>
                                @else
                                    @php
                                        $colorMap = [
                                            'green' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200/60', 'dot' => 'bg-emerald-500'],
                                            'yellow' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200/60', 'dot' => 'bg-amber-500'],
                                            'red' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'border' => 'border-rose-200/60', 'dot' => 'bg-rose-500'],
                                            'blue' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'border' => 'border-blue-200/60', 'dot' => 'bg-blue-500'],
                                        ];
                                        $theme = $colorMap[$borrowing->status_color] ?? ['bg' => 'bg-slate-50', 'text' => 'text-slate-700', 'border' => 'border-slate-200/60', 'dot' => 'bg-slate-400'];
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full {{ $theme['bg'] }} {{ $theme['text'] }} {{ $theme['border'] }} border text-xs font-bold shadow-2xs">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $theme['dot'] }}"></span>
                                        {{ $borrowing->status_label }}
                                    </span>
                                @endif
                            </td>

                            {{-- Kolom 6: Aksi Manajemen Ruang Kontrol --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <a href="{{ route('admin.borrowings.show', $borrowing) }}"
                                    class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-xs font-bold text-slate-600 shadow-2xs transition-all group">
                                    Kelola
                                    <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        {{-- Blok Kondisi Kosong (Empty State) --}}
                        <tr>
                            <td colspan="6" class="text-center py-16 bg-slate-50/30">
                                <div class="w-14 h-14 bg-slate-100 rounded-full flex items-center justify-center text-2xl mx-auto mb-3 shadow-inner">
                                    📂
                                </div>
                                <h3 class="text-sm font-bold text-slate-700">Data Transaksi Kosong</h3>
                                <p class="text-xs text-slate-450 mt-1 max-w-xs mx-auto">
                                    Belum ditemukan data transaksi pengajuan peminjaman dari sistem perpustakaan saat ini.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Blok Navigasi Halaman & Jumlah Total Informasi (Pagination) --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2">
        <p class="text-xs sm:text-sm text-slate-450 font-medium order-2 sm:order-1 text-center sm:text-left">
            Menampilkan data ke <span class="text-slate-700 font-bold">{{ $borrowings->firstItem() ?? 0 }}</span> 
            hingga <span class="text-slate-700 font-bold">{{ $borrowings->lastItem() ?? 0 }}</span> 
            dari total <span class="text-slate-700 font-bold">{{ $borrowings->total() }}</span> log laporan.
        </p>

        <div class="order-1 sm:order-2 flex justify-center">
            {{ $borrowings->links() }}
        </div>
    </div>

</div>
@endsection