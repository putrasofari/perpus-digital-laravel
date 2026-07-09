@extends('layouts.app')

@section('title', 'Ajukan Peminjaman Buku')
@section('page-title', 'Ajukan Peminjaman Buku')

@section('content')

    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Error --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4">
                <ul class="list-disc ml-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.borrowings.store') }}" method="POST">

            @csrf

            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="grid lg:grid-cols-3 gap-6">

                {{-- Cover Buku --}}
                <div>

                    @if ($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" class="rounded-xl shadow w-full object-cover">
                    @else
                        <div class="aspect-[3/4] rounded-xl bg-slate-200 flex items-center justify-center">

                            <span class="text-slate-500">

                                Tidak ada cover

                            </span>

                        </div>
                    @endif

                </div>

                {{-- Form --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Data Peminjam --}}
                    <div class="bg-white rounded-xl shadow">

                        <div class="border-b px-6 py-4">

                            <h2 class="font-bold text-lg">

                                Data Peminjam

                            </h2>

                        </div>

                        <div class="p-6 grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="text-sm text-slate-500">

                                    Nama

                                </label>

                                <input type="text" readonly value="{{ auth()->user()->name }}"
                                    class="mt-1 w-full rounded-lg border-slate-300 bg-slate-100">

                            </div>

                            <div>

                                <label class="text-sm text-slate-500">

                                    NIS

                                </label>

                                <input type="text" readonly value="{{ auth()->user()->nis_nip }}"
                                    class="mt-1 w-full rounded-lg border-slate-300 bg-slate-100">

                            </div>

                            <div>

                                <label class="text-sm text-slate-500">

                                    Kelas

                                </label>

                                <input type="text" readonly value="{{ auth()->user()->kelas->kelas }}"
                                    class="mt-1 w-full rounded-lg border-slate-300 bg-slate-100">

                            </div>

                        </div>

                    </div>

                    {{-- Data Buku --}}
                    <div class="bg-white rounded-xl shadow">

                        <div class="border-b px-6 py-4">

                            <h2 class="font-bold text-lg">

                                Data Buku

                            </h2>

                        </div>

                        <div class="p-6 grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="text-sm text-slate-500">

                                    Judul

                                </label>

                                <input type="text" readonly value="{{ $book->judul }}"
                                    class="mt-1 w-full rounded-lg border-slate-300 bg-slate-100">

                            </div>

                            <div>

                                <label class="text-sm text-slate-500">

                                    Penulis

                                </label>

                                <input type="text" readonly value="{{ $book->penulis }}"
                                    class="mt-1 w-full rounded-lg border-slate-300 bg-slate-100">

                            </div>

                            <div>

                                <label class="text-sm text-slate-500">

                                    Kategori

                                </label>

                                <input type="text" readonly value="{{ $book->category->category }}"
                                    class="mt-1 w-full rounded-lg border-slate-300 bg-slate-100">

                            </div>

                            <div>

                                <label class="text-sm text-slate-500">

                                    Buku Tersedia

                                </label>

                                <input type="text" readonly value="{{ $book->available_stock }} Buku"
                                    class="mt-1 w-full rounded-lg border-slate-300 bg-slate-100">

                            </div>

                        </div>

                    </div>

                    {{-- Jumlah --}}
                    <div class="bg-white rounded-xl shadow">

                        <div class="border-b px-6 py-4">

                            <h2 class="font-bold text-lg">

                                Jumlah Peminjaman

                            </h2>

                        </div>

                        <div class="p-6">

                            <label class="text-sm text-slate-600">

                                Jumlah Buku

                            </label>

                            <input type="number" name="quantity" min="1" max="{{ $book->available_stock }}"
                                value="{{ old('quantity', 1) }}" class="mt-2 w-full rounded-lg border-slate-300">

                            <p class="text-sm text-slate-500 mt-2">

                                Maksimal peminjaman:
                                <strong>{{ $book->available_stock }}</strong>
                                buku.

                            </p>

                        </div>

                    </div>

                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                        <p class="text-sm text-amber-700">
                            Setelah permohonan dikirim, permintaan akan ditinjau oleh petugas perpustakaan.
                            Anda dapat melihat status peminjaman pada menu <strong>Riwayat Peminjaman</strong>.
                        </p>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-3">

                        <a href="{{ route('user.catalogs.show', $book) }}"
                            class="px-5 py-2 rounded-lg border border-slate-300 hover:bg-slate-100">

                            Batal

                        </a>

                        <button class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white">

                            Ajukan Peminjaman

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

@endsection
