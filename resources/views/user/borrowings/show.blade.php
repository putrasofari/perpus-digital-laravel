@extends('layouts.app')

@section('title', 'Detail Peminjaman')
@section('page-title', 'Detail Peminjaman')

@section('content')

    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Detail Peminjaman
                </h2>
                <p class="text-slate-500">
                    Informasi lengkap peminjaman buku.
                </p>
            </div>

            <a href="{{ route('user.borrowings.index') }}" class="px-4 py-2 border rounded-lg hover:bg-slate-100">

                Kembali

            </a>
        </div>

        {{-- Alert Terlambat --}}
        @if ($borrowing->is_late)
            <div class="bg-red-50 border border-red-200 rounded-xl p-4">

                <h3 class="font-semibold text-red-700">
                    ⚠ Buku Terlambat Dikembalikan
                </h3>

                <p class="text-red-600 mt-1">
                    Kamu terlambat mengembalikan buku selama
                    <strong>{{ $borrowing->late_days }} hari.</strong>
                </p>

            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-6">

            {{-- Cover --}}
            <div class="bg-white rounded-xl shadow p-6">

                @if ($borrowing->book->image)
                    <img src="{{ asset('storage/' . $borrowing->book->image) }}" class="w-full rounded-xl shadow object-cover">
                @else
                    <div class="aspect-[3/4] bg-slate-200 rounded-xl flex items-center justify-center">

                        <span class="text-slate-500">

                            Tidak Ada Cover

                        </span>

                    </div>
                @endif
            </div>

            <div class="lg:col-span-2 space-y-6">

                {{-- Status --}}
                <div class="bg-white rounded-xl shadow p-6">

                    <h3 class="font-semibold mb-3">
                        Status
                    </h3>

                    <span
                        class="px-3 py-1 rounded-full
                    bg-{{ $borrowing->status_color }}-100
                    text-{{ $borrowing->status_color }}-700">

                        {{ $borrowing->status_label }}

                    </span>

                </div>

                {{-- Informasi Buku --}}
                <div class="bg-white rounded-xl shadow p-6">

                    <h3 class="font-semibold mb-4">
                        Informasi Buku
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
                            <p class="text-sm text-slate-500">Jumlah</p>
                            <p>{{ $borrowing->quantity }} Buku</p>
                        </div>

                    </div>

                </div>

                {{-- Timeline --}}
                <div class="bg-white rounded-xl shadow p-6">

                    <h3 class="font-semibold mb-4">
                        Timeline
                    </h3>

                    <div class="space-y-2 text-sm">

                        <p>Request :
                            {{ $borrowing->requested_at?->format('d M Y') ?? '-' }}
                        </p>

                        <p>Disetujui :
                            {{ $borrowing->approved_at?->format('d M Y') ?? '-' }}
                        </p>

                        <p>Dipinjam :
                            {{ $borrowing->borrow_date?->format('d M Y') ?? '-' }}
                        </p>

                        <p>Jatuh Tempo :
                            {{ $borrowing->due_date?->format('d M Y') ?? '-' }}
                        </p>

                        <p>Dikembalikan :
                            {{ $borrowing->returned_at?->format('d M Y') ?? '-' }}
                        </p>

                    </div>

                </div>

                {{-- Catatan --}}
                <div class="bg-white rounded-xl shadow p-6">

                    <h3 class="font-semibold mb-3">
                        Catatan Admin
                    </h3>

                    <p class="text-slate-600">
                        {{ $borrowing->description ?: 'Belum ada catatan dari admin.' }}
                    </p>

                </div>

                {{-- Tombol Batalkan --}}
                @if ($borrowing->status == 'menunggu')
                    <div class="bg-white rounded-xl shadow p-6">

                        <form action="{{ route('user.borrowings.destroy', $borrowing) }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Batalkan permintaan peminjaman ini?')"
                                class="w-full bg-red-600 hover:bg-red-700 text-white rounded-lg py-3">
                                Batalkan Permintaan
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
