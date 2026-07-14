@extends('layouts.app')

@section('title', 'Ajukan Peminjaman Buku')
@section('page-title', 'Ajukan Peminjaman Buku')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6 px-2 sm:px-0">

        {{-- Alert Error Kontras Tinggi --}}
        @if ($errors->any())
            <div class="bg-red-600 border-2 border-red-700 text-white rounded-2xl p-4 shadow-md">
                <div class="flex items-center gap-2 font-bold mb-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <span>Ada kesalahan pengisian formulir:</span>
                </div>
                <ul class="list-disc ml-6 space-y-1 text-sm font-semibold text-red-50">
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

            {{-- Grid Utama: Responsif dari 1 Kolom (Mobile) ke 3 Kolom (Desktop) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Sisi Kiri: Preview Sampul Buku --}}
                <div class="flex flex-col items-center md:items-start">
                    <div class="w-full max-w-[280px] md:max-w-full aspect-[3/4] rounded-2xl overflow-hidden shadow-md border border-slate-300 bg-slate-100 sticky top-6">
                        @if ($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center">
                                <svg class="w-16 h-16 text-slate-400 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wide">Sampul Belum Tersedia</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Sisi Kanan: Kumpulan Formulir Input --}}
                <div class="md:col-span-2 space-y-5">

                    {{-- Card: Data Peminjam --}}
                    <div class="bg-white rounded-2xl border border-slate-300 shadow-sm overflow-hidden">
                        <div class="border-b border-slate-300 bg-slate-50 px-5 py-4 flex items-center gap-2.5">
                            <span class="text-xl">👤</span>
                            <h2 class="font-extrabold text-slate-900 text-base sm:text-lg">Data Diri Peminjam</h2>
                        </div>
                        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
                                <input type="text" readonly value="{{ auth()->user()->name }}"
                                    class="w-full rounded-xl border-2 border-slate-300 bg-slate-100 text-slate-900 font-bold focus:outline-none p-2.5">
                            </div>
                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1">NIS / NIP</label>
                                <input type="text" readonly value="{{ auth()->user()->nis_nip }}"
                                    class="w-full rounded-xl border-2 border-slate-300 bg-slate-100 text-slate-900 font-bold focus:outline-none p-2.5">
                            </div>
                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1">Kelas / Jabatan</label>
                                <input type="text" readonly value="{{ auth()->user()->kelas->kelas }}"
                                    class="w-full rounded-xl border-2 border-slate-300 bg-slate-100 text-slate-900 font-bold focus:outline-none p-2.5">
                            </div>
                        </div>
                    </div>

                    {{-- Card: Data Buku --}}
                    <div class="bg-white rounded-2xl border border-slate-300 shadow-sm overflow-hidden">
                        <div class="border-b border-slate-300 bg-slate-50 px-5 py-4 flex items-center gap-2.5">
                            <span class="text-xl">📚</span>
                            <h2 class="font-extrabold text-slate-900 text-base sm:text-lg">Informasi Buku</h2>
                        </div>
                        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1">Judul Buku</label>
                                <input type="text" readonly value="{{ $book->judul }}"
                                    class="w-full rounded-xl border-2 border-slate-300 bg-slate-100 text-slate-900 font-bold focus:outline-none p-2.5">
                            </div>
                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1">Penulis</label>
                                <input type="text" readonly value="{{ $book->penulis }}"
                                    class="w-full rounded-xl border-2 border-slate-300 bg-slate-100 text-slate-900 font-bold focus:outline-none p-2.5">
                            </div>
                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1">Kategori</label>
                                <input type="text" readonly value="{{ $book->category->category }}"
                                    class="w-full rounded-xl border-2 border-slate-300 bg-slate-100 text-slate-900 font-bold focus:outline-none p-2.5">
                            </div>
                        </div>
                    </div>

                    {{-- Card: Jumlah Peminjaman --}}
                    <div class="bg-white rounded-2xl border border-slate-300 shadow-sm overflow-hidden">
                        <div class="border-b border-slate-300 bg-slate-50 px-5 py-4 flex items-center gap-2.5">
                            <span class="text-xl">🔢</span>
                            <h2 class="font-extrabold text-slate-900 text-base sm:text-lg">Kuantitas Peminjaman</h2>
                        </div>
                        <div class="p-5">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-blue-50 border-2 border-blue-600 rounded-xl p-4 mb-4">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-2xl">📦</span>
                                    <div>
                                        <h4 class="font-extrabold text-blue-900 text-sm">Stok Fisik Tersedia</h4>
                                        <p class="text-xs font-bold text-blue-700">Saat ini buku siap dipinjam</p>
                                    </div>
                                </div>
                                <span class="text-2xl font-black text-blue-900 bg-white px-4 py-1.5 rounded-lg border border-blue-300 text-center sm:text-right">
                                    {{ $book->available_stock }} Unit
                                </span>
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1">Jumlah Buku Yang Dipinjam</label>
                                <input type="number" name="quantity" min="1" max="{{ $book->available_stock }}"
                                    value="{{ old('quantity', 1) }}" 
                                    class="w-full sm:w-32 rounded-xl border-2 border-slate-400 font-black text-slate-900 p-2.5 text-lg focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none">
                                <p class="text-xs font-bold text-slate-600 mt-2 flex items-center gap-1">
                                    ℹ️ Batas maksimal peminjaman Anda kali ini adalah <span class="text-slate-900 underline font-extrabold">{{ $book->available_stock }} buku</span>.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Prosedur Kontras Tinggi --}}
                    <div class="bg-amber-50 border-2 border-amber-600 rounded-2xl p-4 flex gap-3">
                        <span class="text-2xl flex-shrink-0">⚠️</span>
                        <p class="text-xs sm:text-sm font-bold text-slate-900 leading-relaxed">
                            Setelah formulir dikirim, permintaan peminjaman akan diverifikasi oleh petugas perpustakaan. 
                            Anda dapat memantau perkembangan pembaruan berkala secara berkala pada menu <span class="text-amber-800 underline">Riwayat Peminjaman</span>.
                        </p>
                    </div>

                    {{-- Tombol Aksi Utama (Batal & Ajukan) --}}
                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-2">
                        <a href="{{ route('user.catalogs.show', $book) }}"
                            class="w-full sm:w-auto text-center px-6 py-3 rounded-xl border-2 border-slate-400 hover:bg-slate-100 font-extrabold text-slate-700 text-sm transition-all shadow-sm">
                            Kembali / Batal
                        </a>
                        <button type="submit" 
                            class="w-full sm:w-auto text-center px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-sm transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                            📝 Kirim Formulir Peminjaman
                        </button>
                    </div>

                </div>

            </div>
        </form>
    </div>
@endsection