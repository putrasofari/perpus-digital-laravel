@extends('layouts.app')

@section('title', 'Laporan Peminjaman Buku')
@section('page-title', 'Laporan Peminjaman Buku')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Riwayat Peminjaman
                </h2>

                <p class="text-slate-500 text-sm">
                    Lihat seluruh riwayat peminjaman buku yang pernah kamu ajukan.
                </p>

            </div>

            {{-- Search --}}
            <form method="GET">

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul buku, nama / kelas peminjam..."
                    class="w-80 rounded-lg border-slate-300 focus:ring-blue-500">

            </form>

        </div>

        {{-- Success --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto bg-white rounded-xl shadow">

            <table class="min-w-full">

                <thead class="bg-slate-100">

                    <tr class="text-left text-slate-700">

                        <th class="px-6 py-4">Peminjam</th>
                        <th class="px-6 py-4">Buku</th>
                        <th class="px-6 py-4">Jumlah</th>
                        <th class="px-6 py-4">Tanggal Pengajuan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($borrowings as $borrowing)
                        <tr class="border-t hover:bg-slate-50">

                            <td class="px-6 py-4">

                                {{ $borrowing->user->name }}
                                <div class="text-sm text-slate-500">

                                    {{ $borrowing->user->kelas->kelas }}

                                </div>
                            </td>


                            <td class="px-6 py-4">

                                <div class="font-semibold text-slate-800">

                                    {{ $borrowing->book->judul }}

                                </div>

                                <div class="text-sm text-slate-500">

                                    {{ $borrowing->book->penulis }}

                                </div>

                            </td>

                            <td class="px-6 py-4">

                                {{ $borrowing->quantity }} Buku

                            </td>

                            <td class="px-6 py-4">

                                {{ \Carbon\Carbon::parse($borrowing->requested_at)->translatedFormat('d F Y') }}

                            </td>

                            <td class="px-6 py-4">

                                @if ($borrowing->is_late)
                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                                        Terlambat {{ $borrowing->late_days }} hari
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 rounded-full bg-{{ $borrowing->status_color }}-100 text-{{ $borrowing->status_color }}-700 text-sm">

                                        {{ $borrowing->status_label }}

                                    </span>
                                @endif

                            </td>

                            <td class="px-6 py-4 text-center">

                                <a href="{{ route('admin.borrowings.show', $borrowing) }}"
                                    class="inline-flex items-center px-3 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm">

                                    Detail

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-12 text-slate-500">

                                Belum ada riwayat peminjaman.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3">

            <p class="text-sm text-slate-500">

                Menampilkan

                <strong>{{ $borrowings->firstItem() ?? 0 }}</strong>

                -

                <strong>{{ $borrowings->lastItem() ?? 0 }}</strong>

                dari

                <strong>{{ $borrowings->total() }}</strong>

                riwayat.

            </p>

            {{ $borrowings->links() }}

        </div>

    </div>

@endsection
