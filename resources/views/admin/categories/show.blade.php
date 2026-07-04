@extends('layouts.app')

@section('title', 'Detail Kategori')
@section('page-title', 'Detail Kategori')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Detail Kategori
                </h2>

                <p class="text-sm text-slate-500">
                    Informasi lengkap kategori buku.
                </p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.categories.edit', $category) }}"
                    class="px-5 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white">

                    Edit

                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-100">

                    ← Kembali

                </a>
            </div>
        </div>

        {{-- Informasi --}}
        <div class="bg-white rounded-xl shadow">

            <div class="border-b px-6 py-4">
                <h3 class="text-lg font-semibold">
                    Informasi Kategori
                </h3>
            </div>

            <div class="grid md:grid-cols-2 gap-6 p-6">

                <div>
                    <p class="text-sm text-slate-500">Nama Kategori</p>

                    <p class="font-semibold text-lg">
                        {{ $category->category }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Jumlah Buku Dalam Kategori</p>

                    <p class="font-semibold text-lg">
                        {{ $category->books_count }} Buku
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Dibuat</p>

                    <p>
                        {{ $category->created_at->translatedFormat('d F Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Terakhir Diubah</p>

                    <p>
                        {{ $category->updated_at->translatedFormat('d F Y') }}
                    </p>
                </div>

            </div>

            <div class="border-t p-6">

                <p class="text-sm text-slate-500 mb-2">
                    Deskripsi
                </p>

                <p class="leading-relaxed text-slate-700">
                    {{ $category->description ?: '-' }}
                </p>

            </div>

        </div>

        {{-- Daftar Buku --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="border-b px-6 py-4">

                <h3 class="text-lg font-semibold">

                    Daftar Buku

                </h3>

            </div>

            <table class="w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Judul</th>
                        <th class="px-4 py-3 text-left">Penulis</th>
                        <th class="px-4 py-3 text-center">Stok</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($books as $book)
                        <tr class="border-t hover:bg-slate-50">

                            <td class="px-4 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-3 font-medium">
                                {{ $book->judul }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $book->penulis }}
                            </td>

                            <td class="px-4 py-3 text-center">

                                <span
                                    class="px-3 py-1 rounded-full text-sm
                                {{ $book->stok > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">

                                    {{ $book->stok }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="py-8 text-center text-slate-500">

                                Belum ada buku pada kategori ini.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
        {{-- Pagination --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <p class="text-sm text-slate-500">

                Menampilkan

                <strong>{{ $books->firstItem() ?? 0 }}</strong>

                -

                <strong>{{ $books->lastItem() ?? 0 }}</strong>

                dari

                <strong>{{ $books->total() }}</strong>

                buku.

            </p>

            {{ $books->onEachSide(1)->links() }}

        </div>
    </div>

@endsection
