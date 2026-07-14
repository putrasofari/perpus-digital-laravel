@extends('layouts.app')

@section('title', 'Katalog Buku')
@section('page-title', 'Katalog Buku')

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto px-1 sm:px-0">

        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    Katalog Koleksi Buku
                </h2>
                <p class="text-slate-600 text-sm mt-0.5 font-medium">
                    Temukan dan pinjam literatur terbaik yang tersedia di perpustakaan.
                </p>
            </div>
        </div>

        {{-- Filter & Search Form --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 sm:p-5">
            <form method="GET" class="flex flex-col lg:flex-row gap-3.5">
                {{-- Input Pencarian --}}
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul, penulis, atau penerbit buku..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border-slate-300 text-slate-900 font-medium placeholder-slate-400 focus:border-blue-600 focus:ring-blue-600 transition-all text-sm">
                </div>

                {{-- Dropdown Kategori --}}
                <div class="w-full lg:w-64 relative">
                    <select name="category"
                        class="w-full rounded-xl border-slate-300 text-slate-900 font-medium focus:border-blue-600 focus:ring-blue-600 transition-all text-sm py-2.5">
                        <option value="" class="text-slate-500">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                {{ $category->category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Group Tombol Aksi --}}
                <div class="flex items-center gap-2.5 w-full lg:w-auto">
                    <button type="submit" class="flex-1 lg:flex-none justify-center inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-xl shadow-sm transition-all text-sm">
                        Cari Buku
                    </button>
                    <a href="{{ route('user.catalogs.index') }}"
                        class="flex-1 lg:flex-none justify-center inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-300 font-bold text-slate-700 hover:bg-slate-50 transition-all text-sm">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Meta Deskripsi Data --}}
        <div class="flex items-center justify-between text-sm text-slate-600 font-medium bg-slate-50 rounded-xl px-4 py-2.5 border border-slate-100">
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>
                    Menampilkan <span class="text-slate-900 font-bold">{{ $catalogs->firstItem() ?? 0 }}</span> - <span class="text-slate-900 font-bold">{{ $catalogs->lastItem() ?? 0 }}</span> dari <span class="text-slate-900 font-bold">{{ $catalogs->total() }}</span> koleksi.
                </span>
            </div>
        </div>

        {{-- Grid Katalog Buku --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @forelse($catalogs as $book)
                {{-- Pembungkus Card sebagai Link Utama --}}
                <a href="{{ route('user.catalogs.show', $book) }}" 
                   class="group flex flex-col bg-white rounded-2xl border border-slate-200/90 shadow-sm hover:border-blue-500 hover:shadow-md transition-all duration-200 overflow-hidden relative">
                    
                    {{-- Badge Status Ketersediaan Pojok Kanan Atas Cover --}}
                    <div class="absolute top-3 right-3 z-10">
                        @if($book->available_stock > 0)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-green-600 text-white text-xs font-bold shadow-sm">
                                Tersedia
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-red-600 text-white text-xs font-bold shadow-sm">
                                Kosong
                            </span>
                        @endif
                    </div>

                    {{-- Cover Buku --}}
                    <div class="relative aspect-[3/4] bg-slate-100 overflow-hidden border-b border-slate-100">
                        @if ($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" 
                                 alt="Cover {{ $book->judul }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center p-4 text-center">
                                <svg class="w-12 h-12 text-slate-300 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Tidak Ada Cover</span>
                            </div>
                        @endif
                    </div>

                    {{-- Detail Info Konten --}}
                    <div class="p-4 flex flex-col flex-1 justify-between bg-white">
                        <div>
                            {{-- Nama Kategori --}}
                            <span class="text-[11px] font-extrabold uppercase tracking-wider text-blue-600 block mb-1">
                                {{ $category->category }}
                            </span>

                            {{-- Judul Buku --}}
                            <h3 class="font-bold text-slate-900 line-clamp-2 text-base leading-snug group-hover:text-blue-600 transition-colors">
                                {{ $book->judul }}
                            </h3>

                            {{-- Penulis --}}
                            <p class="text-xs text-slate-600 font-medium mt-1 inline-flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                {{ $book->penulis }}
                            </p>
                        </div>

                        {{-- Footer Detail Card --}}
                        <div class="mt-4 pt-3.5 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-700 inline-flex items-center gap-1">
                                📘 Stok: <span class="text-slate-900 font-extrabold text-sm">{{ $book->available_stock }}</span>
                            </span>
                            
                            {{-- Indikator Tombol Aksi Visual --}}
                            <span class="text-xs font-bold text-blue-600 inline-flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">
                                Detail
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-12">
                    <div class="bg-white rounded-2xl border border-slate-200 p-8 text-center max-w-md mx-auto">
                        <div class="p-3 bg-slate-50 text-slate-400 rounded-2xl inline-block mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h4 class="text-base font-bold text-slate-900">Buku Tidak Ditemukan</h4>
                        <p class="text-sm text-slate-600 mt-1">
                            Maaf, kata kunci pencarian atau filter kategori yang Anda masukkan tidak cocok dengan koleksi kami.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination Section --}}
        @if($catalogs->hasPages())
            <div class="flex flex-col sm:flex-row gap-4 justify-between items-center pt-4 border-t border-slate-200">
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                    Halaman {{ $catalogs->currentPage() }} dari {{ $catalogs->lastPage() }}
                </p>
                <div>
                    {{ $catalogs->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection