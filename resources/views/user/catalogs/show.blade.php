@extends('layouts.app')

@section('title', 'Detail Katalog Buku')
@section('page-title', 'Detail Katalog Buku')

@section('content')
    <div class="max-w-5xl mx-auto space-y-5 px-2 sm:px-0">

        {{-- Tombol Kembali --}}
        <div>
            <a href="{{ route('user.catalogs.index') }}"
                class="inline-flex items-center gap-2 text-slate-700 hover:text-blue-600 font-bold text-sm bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm transition-all duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Katalog
            </a>
        </div>

        {{-- Main Container Card --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-5 sm:p-8">

                {{-- Sisi Kiri: Cover Buku --}}
                <div class="flex flex-col items-center">
                    <div class="w-full max-w-[280px] md:max-w-full aspect-[3/4] rounded-2xl overflow-hidden shadow-md border border-slate-200 bg-slate-150 relative">
                        {{-- Badge Status Mengambang --}}
                        <div class="absolute top-3 right-3 z-10">
                            @if($book->available_stock > 0)
                                <span class="px-3 py-1 bg-green-600 text-white font-bold text-xs rounded-lg shadow-sm">Tersedia</span>
                            @else
                                <span class="px-3 py-1 bg-red-600 text-white font-bold text-xs rounded-lg shadow-sm">Kosong</span>
                            @endif
                        </div>

                        @if ($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center">
                                <svg class="w-16 h-16 text-slate-300 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Sampul Belum Tersedia</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Sisi Kanan: Informasi Detail Buku --}}
                <div class="md:col-span-2 space-y-6">
                    
                    {{-- Judul & Penulis --}}
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">
                            {{ $book->judul }}
                        </h1>
                        <p class="text-base font-semibold text-slate-700 mt-1.5 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            Karya: <span class="text-slate-900 underline decoration-blue-500 decoration-2">{{ $book->penulis }}</span>
                        </p>
                    </div>

                    {{-- Baris Kategori & Tag Info --}}
                    <div class="flex flex-wrap gap-2 pt-1">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border-2 border-blue-600 text-blue-700 font-extrabold text-xs uppercase tracking-wide">
                            📁 {{ $book->category->category }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border-2 border-slate-700 text-slate-800 font-bold text-xs">
                            📅 {{ $book->tahun_terbit }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border-2 border-slate-700 text-slate-800 font-bold text-xs">
                            📄 {{ $book->jmlh_halaman }} Halaman
                        </span>
                    </div>

                    {{-- Informasi Penerbit --}}
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-[11px] uppercase tracking-wider font-extrabold text-slate-500 block">Penerbit</span>
                            <span class="font-bold text-slate-900 text-sm flex items-center gap-1 mt-0.5">
                                🏢 {{ $book->penerbit }}
                            </span>
                        </div>
                        <div>
                            <span class="text-[11px] uppercase tracking-wider font-extrabold text-slate-500 block">Kategori Utama</span>
                            <span class="font-bold text-slate-900 text-sm flex items-center gap-1 mt-0.5">
                                📚 {{ $book->category->category }}
                            </span>
                        </div>
                    </div>

                    {{-- Grid Statistik Ketersediaan Fisik --}}
                    <div>
                        <h3 class="text-xs uppercase font-extrabold tracking-wider text-slate-500 mb-2.5">Status Inventaris Perpustakaan</h3>
                        <div class="grid grid-cols-3 gap-3">
                            <div class="border border-slate-200 bg-white rounded-xl p-3.5 text-center shadow-sm">
                                <span class="text-[10px] font-bold text-slate-600 uppercase block">Total Unit</span>
                                <span class="text-2xl font-extrabold text-slate-900 block mt-0.5">{{ $book->stok }}</span>
                            </div>
                            <div class="border border-slate-200 bg-white rounded-xl p-3.5 text-center shadow-sm">
                                <span class="text-[10px] font-bold text-slate-600 uppercase block">Dipinjam</span>
                                <span class="text-2xl font-extrabold text-amber-600 block mt-0.5">{{ $book->borrowed_count }}</span>
                            </div>
                            <div class="border border-slate-200 bg-white rounded-xl p-3.5 text-center shadow-sm">
                                <span class="text-[10px] font-bold text-slate-600 uppercase block">Tersedia</span>
                                <span class="text-2xl font-extrabold text-green-600 block mt-0.5">{{ $book->available_stock }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi/Sinopsis --}}
                    <div class="space-y-2 pt-1">
                        <h3 class="font-bold text-slate-900 text-lg flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                            </svg>
                            Sinopsis / Deskripsi Buku
                        </h3>
                        <p class="text-slate-800 leading-relaxed text-sm font-medium bg-slate-50 p-4 rounded-2xl border border-slate-150">
                            {{ $book->description ?: 'Belum ada deskripsi atau sinopsis yang dicantumkan untuk buku ini.' }}
                        </p>
                    </div>

                    {{-- Tombol Aksi Utama --}}
                    <div class="pt-2">
                        @if ($hasBorrowed)
                            <button disabled class="w-full inline-flex items-center justify-center gap-2 bg-slate-200 border-2 border-slate-300 text-slate-600 font-bold rounded-xl py-3 cursor-not-allowed text-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Anda Sedang Meminjam Buku Ini
                            </button>
                        @elseif ($book->available_stock > 0)
                            <a href="{{ route('user.borrowings.create', $book) }}"
                                class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl py-3 shadow-md hover:shadow-lg transition-all text-sm">
                                📝 Ajukan Formulir Peminjaman
                            </a>
                        @else
                            <button disabled class="w-full inline-flex items-center justify-center gap-2 bg-slate-200 border-2 border-slate-300 text-slate-500 font-bold rounded-xl py-3 cursor-not-allowed text-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                                Stok Habis - Semua Unit Sedang Dipinjam
                            </button>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection