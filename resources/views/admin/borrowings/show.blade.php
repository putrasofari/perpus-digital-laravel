@extends('layouts.app')

@section('title', 'Detail Laporan Peminjaman Buku')
@section('page-title', 'Detail Laporan Peminjaman Buku')

@section('content')

    <div class="max-w-6xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Detail Peminjaman
                </h2>

                <p class="text-slate-500">
                    Informasi lengkap transaksi peminjaman buku.
                </p>
            </div>

            <a href="{{ route('admin.borrowings.index') }}" class="px-4 py-2 border rounded-lg hover:bg-slate-100">

                Kembali

            </a>

        </div>

        <div class="grid lg:grid-cols-3 gap-6">

            {{-- Cover --}}
            <div class="bg-white rounded-xl shadow p-6">

                @if ($borrowing->book->image)
                    <img src="{{ asset('storage/' . $borrowing->book->image) }}" class="rounded-lg w-full">
                @else
                    <div class="aspect-[3/4] rounded-lg bg-slate-200 flex items-center justify-center">

                        Tidak ada Cover

                    </div>
                @endif

            </div>

            <div class="lg:col-span-2 space-y-6">

                {{-- Status --}}
                <div class="bg-white rounded-xl shadow p-6">

                    <h3 class="font-semibold mb-4">
                        Status
                    </h3>

                    <span
                        class="px-3 py-1 rounded-full
                    bg-{{ $borrowing->status_color }}-100
                    text-{{ $borrowing->status_color }}-700">

                        {{ $borrowing->status_label }}

                    </span>

                    <div class="mt-6 border-t pt-5">

                        @switch($borrowing->status)
                            {{-- ===================== --}}
                            {{-- MENUNGGU --}}
                            {{-- ===================== --}}
                            @case('menunggu')
                                <div class="flex gap-3">

                                    {{-- Approve --}}
                                    <form method="POST" action="{{ route('admin.borrowings.approved', $borrowing) }}">

                                        @csrf
                                        @method('PATCH')

                                        <button onclick="return confirm('Terima request peminjaman ini?')"
                                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                                            ✓ Terima

                                        </button>

                                    </form>

                                    {{-- Tolak --}}
                                    <button onclick="document.getElementById('reject-modal').classList.remove('hidden')"
                                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">

                                        X Tolak

                                    </button>

                                </div>
                            @break

                            {{-- ===================== --}}
                            {{-- DITERIMA --}}
                            {{-- ===================== --}}
                            @case('diterima')
                                <button onclick="document.getElementById('borrow-modal').classList.remove('hidden')"
                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">

                                    📚 Konfirmasi Buku Diambil

                                </button>
                            @break

                            {{-- ===================== --}}
                            {{-- DIPINJAM --}}
                            {{-- ===================== --}}
                            @case('dipinjam')
                                <form method="POST" action="{{ route('admin.borrowings.returned', $borrowing) }}">

                                    @csrf
                                    @method('PATCH')

                                    <button onclick="return confirm('Buku sudah dikembalikan?')"
                                        class="px-4 py-2 bg-slate-700 hover:bg-slate-800 text-white rounded-lg">

                                        📦 Konfirmasi Pengembalian

                                    </button>

                                </form>
                            @break

                            {{-- ===================== --}}
                            {{-- DITOLAK --}}
                            {{-- ===================== --}}
                            @case('ditolak')
                                <div class="text-red-600 font-medium">

                                    Request telah ditolak.

                                </div>
                            @break

                            {{-- ===================== --}}
                            {{-- DIKEMBALIKAN --}}
                            {{-- ===================== --}}
                            @case('dikembalikan')
                                <div class="text-green-600 font-medium">

                                    Transaksi telah selesai.

                                </div>
                            @break
                        @endswitch

                    </div>
                </div>
                @if ($borrowing->is_late)
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4">

                        <div class="flex items-center gap-3">
                            <div class="text-2xl">
                                ⚠️
                            </div>
                            <div>
                                <h3 class="font-semibold text-red-700">
                                    Peminjaman Terlambat
                                </h3>

                                <p class="text-red-600 text-sm mt-1">
                                    Buku ini telah melewati batas pengembalian selama
                                    <strong>{{ $borrowing->late_days }} hari</strong>.
                                </p>
                            </div>
                        </div>

                    </div>
                @endif

                {{-- Data Peminjam --}}
                <div class="bg-white rounded-xl shadow p-6">

                    <h3 class="font-semibold mb-4">

                        Data Peminjam

                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>

                            <p class="text-sm text-slate-500">Nama</p>

                            <p>{{ $borrowing->user->name }}</p>

                        </div>

                        <div>

                            <p class="text-sm text-slate-500">NIS</p>

                            <p>{{ $borrowing->user->nis_nip }}</p>

                        </div>

                        <div>

                            <p class="text-sm text-slate-500">Kelas</p>

                            <p>{{ $borrowing->user->kelas->kelas }}</p>

                        </div>

                        <div>

                            <p class="text-sm text-slate-500">Jumlah Buku</p>

                            <p>{{ $borrowing->quantity }}</p>

                        </div>

                    </div>

                </div>

                {{-- Data Buku --}}
                <div class="bg-white rounded-xl shadow p-6">

                    <h3 class="font-semibold mb-4">

                        Data Buku

                    </h3>

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>
                            <p class="text-sm text-slate-500">Judul</p>
                            <p>{{ $borrowing->book->judul }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">Kategori</p>
                            <p>{{ $borrowing->book->category->category }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">Penulis</p>
                            <p>{{ $borrowing->book->penulis }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">Penerbit</p>
                            <p>{{ $borrowing->book->penerbit }}</p>
                        </div>
                    </div>
                </div>

                {{-- Timeline --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-semibold mb-4">
                        Timeline
                    </h3>

                    <div class="space-y-2">
                        <p>Request :
                            {{ $borrowing->requested_at ?? '-' }}
                        </p>
                        <p>Disetujui :
                            {{ $borrowing->approved_at ?? '-' }}
                        </p>
                        <p>Dipinjam :
                            {{ $borrowing->borrow_date ?? '-' }}
                        </p>
                        <div>
                            <p class="font-medium">
                                Jatuh Tempo
                            </p>
                            <p>
                                {{ $borrowing->due_date?->format('d M Y') ?? '-' }}
                            </p>
                            @if ($borrowing->is_late)
                                <span class="text-sm text-red-600 font-medium"> 
                                    Terlambat {{ $borrowing->late_days }} hari
                                </span>
                            @endif
                        </div>
                        <p>Dikembalikan :
                            {{ $borrowing->returned_at ?? '-' }}
                        </p>
                    </div>
                </div>

                {{-- Catatan --}}
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="font-semibold mb-3">
                        Catatan Admin
                    </h3>
                    <p class="text-slate-600">
                        {{ $borrowing->description ?: 'Tidak ada catatan.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="reject-modal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center">
        <div class="bg-white rounded-xl p-6 w-full max-w-lg">
            <h3 class="font-bold text-lg mb-4">
                Tolak Permintaan
            </h3>
            <form method="POST" action="{{ route('admin.borrowings.rejected', $borrowing) }}">

                @csrf
                @method('PATCH')
                <textarea name="description" rows="4" class="w-full rounded-lg border-slate-300"
                    placeholder="Masukkan alasan penolakan (opsional)">
                </textarea>
                <div class="flex justify-end gap-3 mt-5">
                    <button type="button" onclick="document.getElementById('reject-modal').classList.add('hidden')"
                        class="px-4 py-2 border rounded-lg">
                        Batal
                    </button>
                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg">
                        Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="borrow-modal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center">
        <div class="bg-white rounded-xl p-6 w-full max-w-lg">
            <h3 class="font-bold text-lg mb-4">
                Konfirmasi Buku Diambil
            </h3>

            <form method="POST" action="{{ route('admin.borrowings.borrowed', $borrowing) }}">
                @csrf
                @method('PATCH')
                <div>
                    <label class="block mb-2 font-medium">
                        Tanggal Jatuh Tempo
                    </label>
                    <input type="date" name="due_date" class="w-full rounded-lg border-slate-300" required>
                </div>
                <div class="mt-4">
                    <label class="block mb-2 font-medium">
                        Catatan (Opsional)
                    </label>
                    <textarea name="description" rows="4" class="w-full rounded-lg border-slate-300"></textarea>
                </div>
                <div class="flex justify-end gap-3 mt-5">
                    <button type="button" onclick="document.getElementById('borrow-modal').classList.add('hidden')"
                        class="px-4 py-2 border rounded-lg">
                        Batal
                    </button>

                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
