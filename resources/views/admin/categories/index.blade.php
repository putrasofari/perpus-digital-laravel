@extends('layouts.app')

@section('title', 'Data Kategori')
@section('page-title', 'Data Kategori')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Data Kategori
                </h2>

                <p class="text-sm text-slate-500">
                    Kelola kategori buku perpustakaan.
                </p>
            </div>

            <a href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">

                + Tambah Kategori

            </a>

        </div>

        {{-- Search --}}
        <div class="bg-white rounded-xl shadow p-5">

            <form method="GET">

                <div class="flex flex-col md:flex-row gap-4">

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                    <button class="px-5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

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

                        <th class="px-4 py-3">Nama Kategori</th>
                        <th class="px-4 py-3">Dibuat</th>
                        <th class="px-4 py-3 text-center w-52">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($categories as $category)
                        <tr class="border-t hover:bg-slate-50">

                            <td class="px-4 py-3 font-medium">
                                {{ $category->category }}
                            </td>

                            <td class="px-4 py-3 text-slate-500">
                                {{ $category->created_at->format('d M Y') }}
                            </td>

                            <td class="px-4 py-3">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.categories.show', $category) }}"
                                        class="px-3 py-1 rounded bg-sky-500 hover:bg-sky-600 text-white">

                                        Detail

                                    </a>

                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                        class="px-3 py-1 rounded bg-yellow-500 hover:bg-yellow-600 text-white">

                                        Edit

                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                            class="px-3 py-1 rounded bg-red-600 hover:bg-red-700 text-white">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center py-10 text-slate-500">

                                Belum ada data kategori.

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

                <strong>{{ $categories->firstItem() ?? 0 }}</strong>

                -

                <strong>{{ $categories->lastItem() ?? 0 }}</strong>

                dari

                <strong>{{ $categories->total() }}</strong>

                kategori.

            </p>

            {{ $categories->onEachSide(1)->links() }}

        </div>

    </div>

@endsection
