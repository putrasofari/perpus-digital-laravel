@extends('layouts.app')

@section('title', 'Detail Peminjaman Buku')
@section('page-title', 'Detail Peminjaman Buku')

@section('content')
<div class="max-w-5xl mx-auto space-y-6 px-2 sm:px-0">

    {{-- Bagian Header & Tombol Kembali --}}
    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-5 sm:p-6 shadow-sm">
        <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight flex items-center gap-2">
                    <span>📖</span> Detail Peminjaman Buku
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">
                    Periksa alur sirkulasi, jangka waktu tenggat, informasi buku, serta riwayat konfirmasi admin di sini.
                </p>
            </div>

            <a href="{{ route('user.borrowings.index') }}"
                class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 sm:py-2 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-xs sm:text-sm font-bold text-slate-600 shadow-xs transition-colors group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Riwayat
            </a>
        </div>
    </div>

    {{-- Alert Terlambat (Skema Muted Lembut) --}}
    @if ($borrowing->is_late)
        <div class="bg-rose-50 border border-rose-200/60 rounded-2xl p-4 sm:p-5 flex gap-3 shadow-xs">
            <div class="w-8 h-8 rounded-xl bg-rose-100 flex items-center justify-center text-rose-600 flex-shrink-0 text-sm">
                ⚠️
            </div>
            <div>
                <h3 class="font-bold text-rose-800 text-sm sm:text-base">Buku Melebihi Batas Waktu</h3>
                <p class="text-xs sm:text-sm text-rose-700 mt-1 leading-relaxed">
                    Anda telah melewati batas masa peminjaman resmi selama <span class="bg-rose-100 px-1.5 py-0.5 rounded-md font-bold text-rose-800">{{ $borrowing->late_days }} hari</span>. Harap segera kembalikan buku ke meja pustakawan.
                </p>
            </div>
        </div>
    @endif

    {{-- Grid Konten Utama --}}
    <div class="grid lg:grid-cols-3 gap-6 items-start">

        {{-- Sisi Kiri: Sampul Buku (Cover) --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-xs">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-3">Cover Katalog</p>
            @if ($borrowing->book->image)
                <div class="relative overflow-hidden rounded-xl shadow-xs border border-slate-100 aspect-[3/4] bg-slate-50">
                    <img src="{{ asset('storage/' . $borrowing->book->image) }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                </div>
            @else
                <div class="aspect-[3/4] border border-dashed border-slate-300 bg-slate-50/60 rounded-xl flex flex-col items-center justify-center text-center p-4">
                    <span class="text-xs font-bold text-slate-400">Tidak Ada Cover</span>
                </div>
            @endif
        </div>

        {{-- Sisi Kanan: Seluruh Informasi Detail --}}
        <div class="lg:col-span-2 space-y-4">

            {{-- Card 1: Status Terkini --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs flex items-center justify-between gap-4">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Status Transaksi</p>
                    <p class="text-xs text-slate-450 mt-0.5">Kondisi terkini dari pengajuan berkas peminjaman.</p>
                </div>
                <div>
                    @php
                        $colorMap = [
                            'green' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200/60', 'dot' => 'bg-emerald-500'],
                            'yellow' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-200/60', 'dot' => 'bg-amber-500'],
                            'red' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-700', 'border' => 'border-rose-200/60', 'dot' => 'bg-rose-500'],
                            'blue' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'border' => 'border-blue-200/60', 'dot' => 'bg-blue-500'],
                        ];
                        $theme = $colorMap[$borrowing->status_color] ?? ['bg' => 'bg-slate-50', 'text' => 'text-slate-700', 'border' => 'border-slate-200/60', 'dot' => 'bg-slate-400'];
                    @endphp
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full {{ $theme['bg'] }} {{ $theme['text'] }} {{ $theme['border'] }} border text-xs font-bold shadow-xs">
                        <span class="w-1.5 h-1.5 rounded-full {{ $theme['dot'] }} {{ $borrowing->status == 'menunggu' ? 'animate-pulse' : '' }}"></span>
                        {{ $borrowing->status_label }}
                    </span>
                </div>
            </div>

            {{-- Card 2: Detil Buku --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs space-y-4">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5 border-b border-slate-50 pb-2">
                    📑 Informasi Dokumen Buku
                </h3>
                <div class="grid sm:grid-cols-3 gap-4 text-xs sm:text-sm">
                    <div class="bg-slate-50/70 border border-slate-100 p-3 rounded-xl sm:col-span-2">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Judul Buku</p>
                        <p class="font-bold text-slate-700 mt-0.5 leading-tight">{{ $borrowing->book->judul }}</p>
                    </div>
                    <div class="bg-slate-50/70 border border-slate-100 p-3 rounded-xl">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Kategori</p>
                        <p class="font-bold text-slate-700 mt-0.5 truncate">{{ $borrowing->book->category->category }}</p>
                    </div>
                    <div class="bg-slate-50/70 border border-slate-100 p-3 rounded-xl w-full">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">Jumlah Pinjam</p>
                        <p class="font-bold text-slate-700 mt-0.5">📖 {{ $borrowing->quantity }} Buku</p>
                    </div>
                </div>
            </div>

            {{-- Card 3: Timeline Pelacakan Proses --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs space-y-5">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                    ⏱️ Garis Waktu Sirkulasi Buku
                </h3>
                
                <div class="relative pl-6 space-y-4 before:absolute before:inset-y-1 before:left-2 before:w-0.5 before:bg-slate-100">
                    
                    {{-- Timeline Item: Request --}}
                    <div class="relative">
                        <div class="absolute -left-6 top-1 w-2.5 h-2.5 rounded-full ring-4 ring-white {{ $borrowing->requested_at ? 'bg-blue-500' : 'bg-slate-200' }}"></div>
                        <div class="flex flex-col sm:flex-row sm:justify-between text-xs sm:text-sm gap-0.5">
                            <span class="font-semibold text-slate-500">📥 Diajukan (Request)</span>
                            <span class="font-bold text-slate-700">{{ $borrowing->requested_at?->translatedFormat('d F Y') ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Timeline Item: Approved --}}
                    <div class="relative">
                        <div class="absolute -left-6 top-1 w-2.5 h-2.5 rounded-full ring-4 ring-white {{ $borrowing->approved_at ? 'bg-emerald-500' : 'bg-slate-200' }}"></div>
                        <div class="flex flex-col sm:flex-row sm:justify-between text-xs sm:text-sm gap-0.5">
                            <span class="font-semibold text-slate-500">✔️ Disetujui Validasi</span>
                            <span class="font-bold text-slate-700">{{ $borrowing->approved_at?->translatedFormat('d F Y') ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Timeline Item: Borrow Date --}}
                    <div class="relative">
                        <div class="absolute -left-6 top-1 w-2.5 h-2.5 rounded-full ring-4 ring-white {{ $borrowing->borrow_date ? 'bg-indigo-500' : 'bg-slate-200' }}"></div>
                        <div class="flex flex-col sm:flex-row sm:justify-between text-xs sm:text-sm gap-0.5">
                            <span class="font-semibold text-slate-500">📦 Diambil / Dipinjam</span>
                            <span class="font-bold text-slate-700">{{ $borrowing->borrow_date?->translatedFormat('d F Y') ?? '-' }}</span>
                        </div>
                    </div>

                    {{-- Timeline Item: Due Date --}}
                    <div class="relative">
                        <div class="absolute -left-6 top-1 w-2.5 h-2.5 rounded-full ring-4 ring-white {{ $borrowing->due_date ? 'bg-amber-500' : 'bg-slate-200' }}"></div>
                        <div class="flex flex-col sm:flex-row sm:justify-between text-xs sm:text-sm gap-0.5">
                            <span class="font-semibold text-slate-500">📅 Batas Waktu (Jatuh Tempo)</span>
                            <span class="font-bold {{ $borrowing->is_late ? 'text-rose-600 font-extrabold' : 'text-slate-700' }}">
                                {{ $borrowing->due_date?->format('d M Y H:i') }}
                            </span>
                        </div>
                    </div>

                    {{-- Timeline Item: Returned --}}
                    <div class="relative">
                        <div class="absolute -left-6 top-1 w-2.5 h-2.5 rounded-full ring-4 ring-white {{ $borrowing->returned_at ? 'bg-teal-500' : 'bg-slate-200' }}"></div>
                        <div class="flex flex-col sm:flex-row sm:justify-between text-xs sm:text-sm gap-0.5">
                            <span class="font-semibold text-slate-500">🔄 Dikembalikan Resmi</span>
                            <span class="font-bold text-slate-700">{{ $borrowing->returned_at?->translatedFormat('d F Y') ?? '-' }}</span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Card 4: Catatan Petugas / Admin --}}
            <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-5 shadow-xs space-y-2">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                    💬 Catatan Pustakawan
                </h3>
                <p class="text-xs sm:text-sm font-medium {{ $borrowing->description ? 'text-slate-700' : 'text-slate-400 italic' }} leading-relaxed">
                    {{ $borrowing->description ?: 'Tidak ada instruksi khusus atau catatan tambahan dari admin untuk sirkulasi ini.' }}
                </p>
            </div>

            {{-- Form Pembatalan (Hanya Muncul Saat Status Menunggu) --}}
            @if ($borrowing->status == 'menunggu')
                <div class="bg-white rounded-2xl border border-rose-100 p-4 sm:p-5 shadow-xs">
                    <form action="{{ route('user.borrowings.destroy', $borrowing) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan permintaan peminjaman ini?')">
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-1.5 px-6 py-3 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200/60 rounded-xl text-xs sm:text-sm font-bold shadow-xs transition-colors">
                            ❌ Batalkan Permintaan Peminjaman
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection