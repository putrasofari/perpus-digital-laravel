@extends('layouts.app')

@section('title', 'Data Buku')
@section('page-title', 'Data Buku')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Data Buku
                </h2>

                <p class="text-sm text-slate-500">
                    Kelola seluruh koleksi buku perpustakaan.
                </p>
            </div>

            <a href="{{ route('admin.books.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">

                + Tambah Buku

            </a>

        </div>

        {{-- Search --}}
        <div class="bg-white rounded-xl shadow p-5">

            <form method="GET">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul atau penulis..."
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                    <select name="category" class="rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                        <option value="">Semua Kategori</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>

                                {{ $category->category }}

                            </option>
                        @endforeach

                    </select>

                    <button class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-4">

                        Cari

                    </button>

                </div>

            </form>

        </div>

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-slate-100">

                    <tr class="text-left text-sm text-slate-700">

                        <th class="px-4 py-3">Cover</th>
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Penulis</th>
                        <th class="px-4 py-3 text-center">Stok</th>
                        <th class="px-4 py-3 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($books as $book)
                        <tr class="border-t hover:bg-slate-50">

                            <td class="px-4 py-3">

                                @if ($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}"
                                        class="w-14 h-20 rounded object-cover">
                                @else
                                    <div
                                        class="w-14 h-20 rounded bg-slate-200 flex items-center justify-center text-xs text-slate-500">
                                        No Image
                                    </div>
                                @endif

                            </td>

                            <td class="px-4 py-3">

                                <div class="font-semibold">

                                    {{ $book->judul }}

                                </div>

                            </td>

                            <td class="px-4 py-3">

                                {{ $book->category->category }}

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

                            <td class="px-4 py-3">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.books.show', $book->id) }}"
                                        class="px-3 py-1 rounded bg-sky-500 hover:bg-sky-600 text-white">

                                        Detail

                                    </a>

                                    <a href="{{ route('admin.books.edit', $book->id) }}"
                                        class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 rounded text-white">

                                        Edit

                                    </a>

                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Hapus buku ini?')"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-white">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center py-10 text-slate-500">

                                Belum ada data buku.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if ($books->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $books->links() }}
            </div>
        @endif
    </div>

@endsection
