@extends('layouts.app')

@section('title', 'Detail Data Buku')
@section('page-title', 'Detail Data Buku')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    {{-- Header & Actions --}}
    <div class="flex flex-col gap-4 p-5 border border-slate-100 rounded-2xl bg-white shadow-sm sm:flex-row sm:items-center sm:justify-between sm:p-6">
        <div>
            <div class="flex items-center gap-3">
                {{-- Icon Unik --}}
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-blue-50 text-blue-500 border border-blue-100">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Detail Koleksi</h2>
                    <p class="text-sm text-slate-500 mt-0.5">Kode Buku: <span class="font-mono bg-slate-100 px-1.5 py-0.5 rounded text-slate-700">BK-{{ str_pad($book->id, 4, '0', STR_PAD_LEFT) }}</span></p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 self-end sm:self-center">
            <a href="{{ route('admin.books.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition-all text-sm font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <a href="{{ route('admin.books.edit', $book) }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white transition-all shadow-sm shadow-amber-200 text-sm font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Data
            </a>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Left Column - Cover --}}
        <div class="lg:col-span-1">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm sticky top-6">
                @if ($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}"
                        class="w-full aspect-[3/4] rounded-xl shadow-lg object-cover border-4 border-slate-50">
                @else
                    <div class="aspect-[3/4] rounded-xl bg-slate-100 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400 gap-3">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm font-medium">Tidak ada cover</span>
                    </div>
                @endif
                
                <div class="mt-5 space-y-3 bg-slate-50 p-4 rounded-xl border border-slate-100">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Ditambahkan
                        </span>
                        <span class="font-medium text-slate-700">{{ $book->created_at->translatedFormat('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-500 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Terakhir Diubah
                        </span>
                        <span class="font-medium text-slate-700">{{ $book->updated_at->translatedFormat('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column - Details --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Judul & Kategori --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-100 shadow-sm">
                <div class="flex items-start gap-4 justify-between">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tighter leading-tight">
                        {{ $book->judul }}
                    </h1>
                </div>
                <div class="mt-5 flex flex-wrap gap-2 items-center border-t border-slate-100 pt-5">
                    {{-- Ikon Label Kategori --}}
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 shadow-inner">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path></svg>
                        {{ $book->category->category }}
                    </span>
                    {{-- Label Stok --}}
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium border {{ $book->stok > 0 ? 'bg-green-50 text-green-700 border-green-100 shadow-green-100' : 'bg-red-50 text-red-700 border-red-100 shadow-red-100' }} shadow-inner">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        {{ $book->stok > 0 ? 'Tersedia : ' . $book->stok . ' Buku' : 'Stok Habis' }}
                    </span>
                </div>
            </div>

            {{-- Metadata Grid --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"></path></svg>
                    Spesifikasi & Informasi Buku
                </h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6">
                    {{-- Item --}}
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:bg-white hover:border-slate-200 transition-all">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-slate-500 border border-slate-200 shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Penulis</p>
                            <p class="font-semibold text-slate-800">{{ $book->penulis }}</p>
                        </div>
                    </div>
                    {{-- Item --}}
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:bg-white hover:border-slate-200 transition-all">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-slate-500 border border-slate-200 shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Penerbit</p>
                            <p class="font-semibold text-slate-800">{{ $book->penerbit }}</p>
                        </div>
                    </div>
                    {{-- Item --}}
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:bg-white hover:border-slate-200 transition-all">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-slate-500 border border-slate-200 shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Tahun Terbit</p>
                            <p class="font-semibold text-slate-800">{{ $book->tahun_terbit }}</p>
                        </div>
                    </div>
                    {{-- Item --}}
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:bg-white hover:border-slate-200 transition-all">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-white text-slate-500 border border-slate-200 shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Fisik Buku</p>
                            <p class="font-semibold text-slate-800">{{ $book->jmlh_halaman }} <span class="text-sm font-normal text-slate-500 ml-1">Halaman</span></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-100 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    Sinopsis / Deskripsi
                </h3>
                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed whitespace-pre-line bg-slate-50 p-5 rounded-xl border border-slate-100">
                    {{ $book->description ?: 'Belum ada deskripsi untuk buku ini.' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection