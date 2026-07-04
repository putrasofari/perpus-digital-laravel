@extends('layouts.app')

@section('title', 'Ubah Data Kategori')
@section('page-title', 'Ubah Data Kategori')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-xl shadow">

        {{-- Header --}}
        <div class="border-b px-6 py-5">

            <h2 class="text-2xl font-bold text-slate-800">
                Ubah Kategori
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Perbarui informasi kategori buku perpustakaan.
            </p>

        </div>

        {{-- Form --}}
        <form
            action="{{ route('admin.categories.update', $category) }}"
            method="POST"
            class="p-6 space-y-6">

            @csrf
            @method('PUT')

            {{-- Nama Kategori --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Nama Kategori
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="category"
                    value="{{ old('category', $category->category) }}"
                    placeholder="Contoh: Pemrograman"
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                @error('category')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Deskripsi --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Deskripsi
                    <span class="text-slate-400 text-xs">(Opsional)</span>
                </label>

                <textarea
                    name="description"
                    rows="5"
                    placeholder="Masukkan deskripsi kategori..."
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 resize-none">{{ old('description', $category->description) }}</textarea>

                @error('description')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Informasi --}}
            <div class="grid md:grid-cols-2 gap-4 bg-slate-50 rounded-lg p-4 text-sm">

                <div>
                    <p class="text-slate-500">Dibuat pada</p>
                    <p class="font-medium">
                        {{ $category->created_at->translatedFormat('d F Y, H:i') }}
                    </p>
                </div>

                <div>
                    <p class="text-slate-500">Terakhir diperbarui</p>
                    <p class="font-medium">
                        {{ $category->updated_at->translatedFormat('d F Y, H:i') }}
                    </p>
                </div>

            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="px-5 py-2 rounded-lg border border-slate-300 hover:bg-slate-100">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white">

                    Perbarui Kategori

                </button>

            </div>

        </form>

    </div>

</div>

@endsection