@extends('layouts.app')

@section('title', 'Ubah Data Kelas')
@section('page-title', 'Ubah Data Kelas')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="bg-white rounded-xl shadow">

            {{-- Header --}}
            <div class="border-b px-6 py-5">

                <h2 class="text-2xl font-bold text-slate-800">
                    Ubah Data Kelas
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Perbarui informasi kelas yang digunakan pada sistem perpustakaan.
                </p>

            </div>

            {{-- Form --}}
            <form action="{{ route('admin.kelas.update', $kelas) }}" method="POST" class="p-6 space-y-6">

                @csrf
                @method('PUT')

                {{-- Nama Kelas --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Nama Kelas
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text" name="kelas" value="{{ old('kelas', $kelas->kelas) }}"
                        placeholder="Contoh: X RPL 1"
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                    <p class="mt-2 text-xs text-slate-500">
                        Gunakan format seperti:
                        <strong>X RPL 1</strong>,
                        <strong>XI AKL 2</strong>,
                        <strong>XII DKV 1</strong>.
                    </p>

                    @error('kelas')
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

                    <textarea name="description" rows="5" placeholder="Masukkan deskripsi kelas..."
                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 resize-none">{{ old('description', $kelas->description) }}</textarea>

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
                            {{ $kelas->created_at->translatedFormat('d F Y, H:i') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-500">Terakhir diperbarui</p>
                        <p class="font-medium">
                            {{ $kelas->updated_at->translatedFormat('d F Y, H:i') }}
                        </p>
                    </div>

                </div>

                {{-- Tombol --}}
                <div class="flex justify-end gap-3">

                    <a href="{{ route('admin.kelas.index') }}"
                        class="px-5 py-2 rounded-lg border border-slate-300 hover:bg-slate-100">

                        Batal

                    </a>

                    <button type="submit" class="px-5 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white">

                        Perbarui Kelas

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
