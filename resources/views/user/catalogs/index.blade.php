@extends('layouts.app')

@section('title', 'Katalog Buku')
@section('page-title', 'Katalog Buku')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Katalog Buku
                </h2>

                <p class="text-slate-500 text-sm">
                    Temukan buku yang tersedia di perpustakaan.
                </p>
            </div>

        </div>

        {{-- Filter --}}
        <div class="bg-white rounded-xl shadow p-5">

            <form method="GET" class="grid md:grid-cols-12 gap-4">

                {{-- Search --}}
                <div class="md:col-span-6">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul, penulis atau penerbit..."
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                </div>

                {{-- Kategori --}}
                <div class="md:col-span-4">

                    <select name="category"
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                        <option value="">Semua Kategori</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>

                                {{ $category->category }}

                            </option>
                        @endforeach

                    </select>

                </div>

                {{-- Tombol --}}
                <div class="md:col-span-2 flex gap-2">

                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                        Cari

                    </button>

                    <a href="{{ route('user.catalogs.index') }}"
                        class="px-4 rounded-lg border border-slate-300 flex items-center justify-center hover:bg-slate-100">

                        Reset

                    </a>

                </div>

            </form>

        </div>

        {{-- Jumlah --}}
        <div class="text-sm text-slate-500">

            Menampilkan
            <strong>{{ $catalogs->firstItem() ?? 0 }}</strong>
            -
            <strong>{{ $catalogs->lastItem() ?? 0 }}</strong>
            dari
            <strong>{{ $catalogs->total() }}</strong>
            buku.

        </div>

        {{-- Card --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @forelse($catalogs as $book)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

                    {{-- Cover --}}
                    @if ($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" class="w-full h-64 object-cover">
                    @else
                        <div class="h-64 bg-slate-200 flex items-center justify-center">

                            <span class="text-slate-500">
                                Tidak ada cover
                            </span>

                        </div>
                    @endif

                    <div class="p-4">

                        {{-- Judul --}}
                        <h3 class="font-bold text-lg line-clamp-2">

                            {{ $book->judul }}

                        </h3>

                        {{-- Penulis --}}
                        <p class="text-sm text-slate-500 mt-1">

                            {{ $book->penulis }}

                        </p>

                        {{-- Kategori --}}
                        <span class="inline-block mt-3 text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">

                            {{ $book->category->category }}

                        </span>

                        {{-- Ketersediaan Buku --}}
                        <div class="mt-3">
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                📚 Tersedia: {{ $book->available_stock }} Buku dapat dipinjam
                            </span>
                        </div>

                        {{-- Tombol --}}
                        <div class="mt-5">

                            <a href="{{ route('user.catalogs.show', $book) }}"
                                class="block text-center bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2">

                                Detail Buku

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-full">

                    <div class="bg-white rounded-xl shadow p-10 text-center">

                        <p class="text-slate-500">

                            Tidak ada buku yang ditemukan.

                        </p>

                    </div>

                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="flex justify-between items-center">

            <p class="text-sm text-slate-500">

                Halaman
                <strong>{{ $catalogs->currentPage() }}</strong>
                dari
                <strong>{{ $catalogs->lastPage() }}</strong>

            </p>

            {{ $catalogs->links() }}

        </div>

    </div>

@endsection
