@extends('layouts.app')

@section('title', 'Tambah Buku')
@section('page-title', 'Tambah Buku')

@section('content')

    <div class="max-w-5xl mx-auto">

        <div class="bg-white rounded-xl shadow">

            <div class="border-b px-6 py-5">
                <h2 class="text-2xl font-bold text-slate-800">
                    Tambah Buku
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Lengkapi informasi buku yang akan ditambahkan ke perpustakaan.
                </p>
            </div>

            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">

                @csrf

                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Judul Buku
                    </label>

                    <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Tentang Kamu"
                        class="w-full rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500">

                    @error('judul')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Kategori
                    </label>

                    <select name="category_id" class="w-full rounded-lg border-slate-300">

                        <option value="">-- Pilih Kategori --</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>

                                {{ $category->category }}

                            </option>
                        @endforeach

                    </select>

                </div>

                {{-- Penulis & Penerbit --}}
                <div class="grid md:grid-cols-2 gap-5">

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Penulis
                        </label>

                        <input type="text" name="penulis" value="{{ old('penulis') }}" placeholder="Contoh: Tere Liye"
                            class="w-full rounded-lg border-slate-300">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Penerbit
                        </label>

                        <input type="text" name="penerbit" value="{{ old('penerbit') }}"
                            placeholder="Contoh: Replubika Penerbit" class="w-full rounded-lg border-slate-300">

                    </div>

                </div>

                {{-- Tahun, Halaman, Stok --}}
                <div class="grid md:grid-cols-3 gap-5">

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Tahun Terbit
                        </label>

                        <input type="number" min="1900" max="{{ date('Y') }}" name="tahun_terbit"
                            placeholder="Contoh: 2016" value="{{ old('tahun_terbit') }}"
                            class="w-full rounded-lg border-slate-300">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Jumlah Halaman
                        </label>

                        <input type="number" min="1" name="jmlh_halaman" value="{{ old('jmlh_halaman') }}"
                            placeholder="Contoh: 524 Halaman" class="w-full rounded-lg border-slate-300">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Stok
                        </label>

                        <input type="number" min="0" name="stok" value="{{ old('stok') }}"
                            placeholder="Contoh: 120" class="w-full rounded-lg border-slate-300">

                    </div>

                </div>

                {{-- Upload Cover --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Cover Buku
                    </label>

                    <input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm">

                    <img id="preview" class="hidden mt-4 w-36 rounded-lg shadow">

                </div>

                {{-- Deskripsi --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Deskripsi Buku
                    </label>

                    <textarea name="description" rows="6" placeholder="Contoh: Buku ini berisi tentang..."
                        class="w-full rounded-lg border-slate-300 resize-none">{{ old('description') }}</textarea>

                </div>

                {{-- Button --}}
                <div class="flex justify-end gap-3">

                    <a href="{{ route('admin.books.index') }}" class="px-5 py-2 rounded-lg border">
                        Batal
                    </a>

                    <button class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white">
                        Simpan Buku
                    </button>

                </div>

            </form>

        </div>

    </div>

    {{-- Preview Cover --}}
    <script>
        document.getElementById('image').addEventListener('change', function(e) {

            const preview = document.getElementById('preview');

            const file = e.target.files[0];

            if (file) {

                preview.src = URL.createObjectURL(file);

                preview.classList.remove('hidden');

            }

        });
    </script>

@endsection
