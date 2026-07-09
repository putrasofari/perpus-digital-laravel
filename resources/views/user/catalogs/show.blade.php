@extends('layouts.app')

@section('title', 'Detail Katalog Buku')
@section('page-title', 'Detail Katalog Buku')

@section('content')

    <div class="max-w-6xl mx-auto space-y-6">

        {{-- Tombol Kembali --}}
        <div>
            <a href="{{ route('user.catalogs.index') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">

                ← Kembali ke Katalog

            </a>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="grid lg:grid-cols-3 gap-8 p-8">

                {{-- Cover --}}
                <div>

                    @if ($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" class="w-full rounded-xl shadow object-cover">
                    @else
                        <div class="aspect-[3/4] bg-slate-200 rounded-xl flex items-center justify-center">

                            <span class="text-slate-500">

                                Tidak Ada Cover

                            </span>

                        </div>
                    @endif

                </div>

                {{-- Informasi Buku --}}
                <div class="lg:col-span-2 space-y-6">

                    <div>

                        <h1 class="text-3xl font-bold text-slate-800">

                            {{ $book->judul }}

                        </h1>

                        <p class="text-slate-500 mt-2">

                            {{ $book->penulis }}

                        </p>

                    </div>

                    {{-- Badge --}}
                    <div class="flex flex-wrap gap-3">

                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">

                            {{ $book->category->category }}

                        </span>

                        <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-sm">

                            {{ $book->tahun_terbit }}

                        </span>

                        <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-sm">

                            {{ $book->jmlh_halaman }} Halaman

                        </span>

                    </div>

                    {{-- Detail --}}
                    <div class="grid md:grid-cols-2 gap-4">

                        <div>
                            <h3 class="text-sm text-slate-500">

                                Penerbit

                            </h3>

                            <p class="font-semibold">

                                {{ $book->penerbit }}

                            </p>
                        </div>

                        <div>
                            <h3 class="text-sm text-slate-500">

                                Kategori

                            </h3>

                            <p class="font-semibold">

                                {{ $book->category->category }}

                            </p>
                        </div>

                    </div>

                    {{-- Statistik Buku --}}
                    <div class="grid grid-cols-3 gap-4">

                        <div class="bg-slate-50 rounded-xl p-5 text-center">

                            <p class="text-sm text-slate-500">

                                Total Buku

                            </p>

                            <h2 class="text-3xl font-bold text-slate-800">

                                {{ $book->stok }}

                            </h2>

                        </div>

                        <div class="bg-slate-50 rounded-xl p-5 text-center">

                            <p class="text-sm text-slate-500">

                                Dipinjam

                            </p>

                            <h2 class="text-3xl font-bold text-amber-600">

                                {{ $book->borrowed_count }}

                            </h2>

                        </div>

                        <div class="bg-slate-50 rounded-xl p-5 text-center">

                            <p class="text-sm text-slate-500">

                                Tersedia

                            </p>

                            <h2 class="text-3xl font-bold text-green-600">

                                {{ $book->available_stock }}

                            </h2>

                        </div>

                    </div>

                    {{-- Progress --}}
                    <div>

                        <div class="flex justify-between text-sm text-slate-500 mb-2">

                            <span>Ketersediaan Buku</span>
                        </div>

                        <div class="text-sm text-slate-600">
                            <span class="font-semibold text-green-600">
                                {{ $book->available_stock }}
                            </span>
                            dari
                            <span class="font-semibold text-slate-800">
                                {{ $book->stok }}
                            </span>
                            buku tersedia untuk dipinjam.
                        </div>

                    </div>

                    {{-- Deskripsi --}}
                    <div>

                        <h3 class="font-semibold text-lg mb-2">

                            Deskripsi

                        </h3>

                        <p class="text-slate-600 leading-relaxed">

                            {{ $book->description ?: 'Belum ada deskripsi.' }}

                        </p>

                    </div>

                    {{-- Tombol --}}
                    <div class="pt-4">

                        @if ($hasBorrowed)
                            <button disabled class="w-full bg-slate-300 text-slate-600 rounded-lg py-2 cursor-not-allowed">

                                Kamu sedang meminjam buku ini

                            </button>
                        @elseif ($book->available_stock > 0)
                            <a href="{{ route('user.borrowings.create', $book) }}"
                                class="block text-center bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2">

                                Ajukan Peminjaman

                            </a>
                        @else
                            <button disabled class="w-full bg-slate-300 text-slate-500 py-3 rounded-lg cursor-not-allowed">

                                Semua Buku Sedang Dipinjam

                            </button>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
