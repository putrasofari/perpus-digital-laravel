@extends('layouts.app')

@section('title', 'Detail Data Buku')
@section('page-title', 'Detail Data Buku')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Detail Buku
                </h2>

                <p class="text-sm text-slate-500">
                    Informasi lengkap mengenai buku perpustakaan.
                </p>

            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.books.edit', $book) }}"
                    class="px-5 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white">

                    Edit Buku

                </a>

                <a href="{{ route('admin.books.index') }}"
                    class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-100">

                    ← Kembali

                </a>
            </div>

        </div>

        {{-- Card --}}
        <div class="bg-white rounded-xl shadow">

            <div class="p-6">

                <div class="grid md:grid-cols-3 gap-8">

                    {{-- Cover --}}
                    <div>

                        @if ($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}"
                                class="w-full rounded-xl shadow object-cover">
                        @else
                            <div class="aspect-[3/4] rounded-xl bg-slate-200 flex items-center justify-center">

                                <span class="text-slate-500">
                                    Tidak ada cover
                                </span>

                            </div>
                        @endif

                    </div>

                    {{-- Informasi --}}
                    <div class="md:col-span-2">

                        <h2 class="text-3xl font-bold text-slate-800">

                            {{ $book->judul }}

                        </h2>

                        <div class="mt-6 grid md:grid-cols-2 gap-5">

                            <div>
                                <p class="text-sm text-slate-500">Kategori</p>
                                <p class="font-medium">
                                    {{ $book->category->category }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Penulis</p>
                                <p class="font-medium">
                                    {{ $book->penulis }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Penerbit</p>
                                <p class="font-medium">
                                    {{ $book->penerbit }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Tahun Terbit</p>
                                <p class="font-medium">
                                    {{ $book->tahun_terbit }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Jumlah Halaman</p>
                                <p class="font-medium">
                                    {{ $book->jmlh_halaman }} Halaman
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Stok Buku</p>

                                <span
                                    class="inline-flex px-3 py-1 rounded-full text-sm font-medium

                            {{ $book->stok > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">

                                    {{ $book->stok }} Buku

                                </span>

                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Ditambahkan</p>
                                <p>
                                    {{ $book->created_at->translatedFormat('d F Y') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">Terakhir Diubah</p>
                                <p>
                                    {{ $book->updated_at->translatedFormat('d F Y') }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Deskripsi --}}
            <div class="border-t px-6 py-5">

                <h3 class="font-semibold text-lg mb-3">

                    Deskripsi Buku

                </h3>

                <p class="text-slate-700 leading-relaxed">

                    {{ $book->description ?: 'Belum ada deskripsi.' }}

                </p>

            </div>

        </div>

    </div>

@endsection
