@extends('layouts.app')

@section('title', 'Edit Data Buku')
@section('page-title', 'Edit Data Buku')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="bg-white rounded-xl shadow">

        {{-- Header --}}
        <div class="border-b px-6 py-5">

            <h2 class="text-2xl font-bold text-slate-800">
                Edit Data Buku
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Perbarui informasi buku yang tersedia di perpustakaan.
            </p>

        </div>

        <form
            action="{{ route('admin.books.update', $book) }}"
            method="POST"
            enctype="multipart/form-data"
            class="p-6">

            @csrf
            @method('PUT')

            <div class="grid lg:grid-cols-3 gap-8">

                {{-- Informasi Buku --}}
                <div class="lg:col-span-2 space-y-5">

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Kategori
                        </label>

                        <select
                            name="category_id"
                            class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(old('category_id', $book->category_id) == $category->id)>

                                    {{ $category->category }}

                                </option>

                            @endforeach

                        </select>

                        @error('category_id')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Judul --}}
                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Judul Buku
                        </label>

                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul', $book->judul) }}"
                            class="w-full rounded-lg border-slate-300">

                        @error('judul')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="grid md:grid-cols-2 gap-5">

                        {{-- Penulis --}}
                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Penulis
                            </label>

                            <input
                                type="text"
                                name="penulis"
                                value="{{ old('penulis', $book->penulis) }}"
                                class="w-full rounded-lg border-slate-300">

                        </div>

                        {{-- Penerbit --}}
                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Penerbit
                            </label>

                            <input
                                type="text"
                                name="penerbit"
                                value="{{ old('penerbit', $book->penerbit) }}"
                                class="w-full rounded-lg border-slate-300">

                        </div>

                    </div>

                    <div class="grid md:grid-cols-3 gap-5">

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Tahun Terbit
                            </label>

                            <input
                                type="number"
                                name="tahun_terbit"
                                value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
                                class="w-full rounded-lg border-slate-300">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Halaman
                            </label>

                            <input
                                type="text"
                                name="jmlh_halaman"
                                value="{{ old('jmlh_halaman', $book->jmlh_halaman) }}"
                                class="w-full rounded-lg border-slate-300">

                        </div>

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Stok
                            </label>

                            <input
                                type="number"
                                name="stok"
                                value="{{ old('stok', $book->stok) }}"
                                class="w-full rounded-lg border-slate-300">

                        </div>

                    </div>

                    {{-- Deskripsi --}}
                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Deskripsi
                        </label>

                        <textarea
                            name="description"
                            rows="6"
                            class="w-full rounded-lg border-slate-300 resize-none">{{ old('description', $book->description) }}</textarea>

                    </div>

                </div>

                {{-- Cover --}}
                <div>

                    <label class="block text-sm font-medium mb-3">

                        Cover Buku

                    </label>

                    @if($book->image)

                        <img
                            src="{{ asset('storage/' . $book->image) }}"
                            class="w-full rounded-xl shadow mb-4">

                    @else

                        <div class="aspect-[3/4] rounded-xl bg-slate-200 flex items-center justify-center mb-4">

                            Tidak ada cover

                        </div>

                    @endif

                    <input
                        type="file"
                        name="image"
                        class="w-full rounded-lg border-slate-300">

                    <p class="text-xs text-slate-500 mt-2">

                        Kosongkan jika tidak ingin mengganti cover buku.

                    </p>

                </div>

            </div>

            {{-- Footer --}}
            <div class="flex justify-end gap-3 border-t mt-8 pt-6">

                <a
                    href="{{ route('admin.books.index') }}"
                    class="px-5 py-2 rounded-lg border">

                    Batal

                </a>

                <button
                    class="px-5 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white">

                    Perbarui Buku

                </button>

            </div>

        </form>

    </div>

</div>

@endsection