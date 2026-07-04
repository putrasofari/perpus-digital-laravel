@extends('layouts.app')

@section('title', 'Tambah Data Kategori')
@section('page-title', 'Tambah Data Kategori')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-xl shadow">

        {{-- Header --}}
        <div class="border-b px-6 py-5">

            <h2 class="text-2xl font-bold text-slate-800">
                Tambah Kategori
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Tambahkan kategori baru untuk mengelompokkan buku perpustakaan.
            </p>

        </div>

        {{-- Form --}}
        <form
            action="{{ route('admin.categories.store') }}"
            method="POST"
            class="p-6 space-y-6">

            @csrf

            {{-- Nama --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Nama Kategori
                    <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="category"
                    value="{{ old('category') }}"
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
                    Deskripsi <span class="text-slate-400 text-sm">(Opsional)</span>
                </label>

                <textarea
                    name="description"
                    rows="5"
                    placeholder="Masukkan deskripsi kategori..."
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 resize-none">{{ old('description') }}</textarea>

                @error('description')

                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            {{-- Button --}}
            <div class="flex justify-end gap-3">

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="px-5 py-2 rounded-lg border border-slate-300 hover:bg-slate-100">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white">

                    Simpan Kategori

                </button>

            </div>

        </form>

    </div>

</div>

@endsection