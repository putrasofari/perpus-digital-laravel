@extends('layouts.app')

@section('title', 'Detail Laporan Peminjaman Buku')
@section('page-title', 'Detail Laporan Peminjaman Buku')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6 px-2 sm:px-0">

        {{-- Header Page --}}
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-50 border border-slate-200/60 rounded-2xl p-5 shadow-xs">
            <div>
                <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <span>📋</span> Detail Transaksi Peminjaman
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">
                    Informasi logistik data peminjaman buku beserta kontrol validasi admin.
                </p>
            </div>
            <a href="{{ route('admin.borrowings.index') }}"
                class="inline-flex items-center justify-center gap-1.5 px-4 py-2 border border-slate-200 bg-white text-xs font-bold text-slate-600 rounded-xl hover:bg-slate-50 shadow-2xs transition-all">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- Grid Layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            {{-- Sisi Kiri: Visual Cover Buku --}}
            <div class="bg-white border border-slate-200/60 rounded-2xl p-4 shadow-xs">
                @if ($borrowing->book->image)
                    <div class="overflow-hidden rounded-xl bg-slate-50 border border-slate-100 flex justify-center">
                        <img src="{{ asset('storage/' . $borrowing->book->image) }}"
                            class="w-full h-auto object-cover max-h-80 sm:max-h-full">
                    </div>
                @else
                    <div
                        class="aspect-[3/4] rounded-xl bg-slate-100/70 border border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-450 p-4 text-center">
                        <span class="text-3xl mb-1">📖</span>
                        <span class="text-xs font-bold">Cover Tidak Tersedia</span>
                    </div>
                @endif
            </div>

            {{-- Sisi Kanan: Panel Informasi & Ruang Aksi --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Card Status & Tombol Eksekusi Admin --}}
                <div class="bg-white border border-slate-200/60 rounded-2xl p-5 sm:p-6 shadow-xs">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                        <span>⚡</span> Status Alur Berkas
                    </h3>

                    @php
                        $colorMap = [
                            'green' => [
                                'bg' => 'bg-emerald-50',
                                'text' => 'text-emerald-700',
                                'border' => 'border-emerald-200/50',
                                'dot' => 'bg-emerald-500',
                            ],
                            'yellow' => [
                                'bg' => 'bg-amber-50',
                                'text' => 'text-amber-700',
                                'border' => 'border-amber-200/50',
                                'dot' => 'bg-amber-500',
                            ],
                            'red' => [
                                'bg' => 'bg-rose-50',
                                'text' => 'text-rose-700',
                                'border' => 'border-rose-200/50',
                                'dot' => 'bg-rose-500',
                            ],
                            'blue' => [
                                'bg' => 'bg-blue-50',
                                'text' => 'text-blue-700',
                                'border' => 'border-blue-200/50',
                                'dot' => 'bg-blue-500',
                            ],
                        ];
                        $theme = $colorMap[$borrowing->status_color] ?? [
                            'bg' => 'bg-slate-50',
                            'text' => 'text-slate-700',
                            'border' => 'border-slate-200/50',
                            'dot' => 'bg-slate-400',
                        ];
                    @endphp

                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full {{ $theme['bg'] }} {{ $theme['text'] }} {{ $theme['border'] }} border text-xs font-bold shadow-2xs">
                        <span class="w-1.5 h-1.5 rounded-full {{ $theme['dot'] }}"></span>
                        {{ $borrowing->status_label }}
                    </span>

                    {{-- Blok Form Kondisional Berdasarkan Status Pinjam --}}
                    <div class="mt-5 border-t border-slate-100 pt-5">
                        @switch($borrowing->status)
                            @case('menunggu')
                                <div class="flex flex-wrap gap-3">
                                    <form method="POST" action="{{ route('admin.borrowings.approved', $borrowing) }}"
                                        class="w-full sm:w-auto">
                                        @csrf
                                        @method('PATCH')
                                        <button onclick="return confirm('Terima request peminjaman ini?')"
                                            class="w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-blue-50 hover:bg-blue-100 border border-blue-200 text-xs font-bold text-blue-700 rounded-xl shadow-2xs transition-all">
                                            ✅ Setujui Permintaan
                                        </button>
                                    </form>

                                    <button onclick="document.getElementById('reject-modal').classList.remove('hidden')"
                                        class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-rose-50 hover:bg-rose-100 border border-rose-200 text-xs font-bold text-rose-700 rounded-xl shadow-2xs transition-all">
                                        ❌ Tolak Berkas
                                    </button>
                                </div>
                            @break

                            @case('diterima')
                                <button onclick="document.getElementById('borrow-modal').classList.remove('hidden')"
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 text-xs font-bold text-emerald-700 rounded-xl shadow-2xs transition-all">
                                    📚 Konfirmasi Pengambilan Buku
                                </button>
                            @break

                            @case('dipinjam')
                                <form method="POST" action="{{ route('admin.borrowings.returned', $borrowing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button onclick="return confirm('Buku sudah dikembalikan?')"
                                        class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-xs font-bold text-white rounded-xl shadow-sm transition-all">
                                        📦 Verifikasi Pengembalian Buku
                                    </button>
                                </form>
                            @break

                            @case('ditolak')
                                <div
                                    class="text-xs font-bold text-rose-600 bg-rose-50 border border-rose-100 px-3 py-2 rounded-xl inline-block">
                                    Permintaan ini telah ditolak oleh sistem admin.
                                </div>
                            @break

                            @case('dikembalikan')
                                <div
                                    class="text-xs font-bold text-emerald-600 bg-emerald-50 border border-emerald-100 px-3 py-2 rounded-xl inline-block">
                                    Transaksi selesai, buku telah berhasil dikembalikan ke rak perpustakaan.
                                </div>
                            @break
                        @endswitch
                    </div>
                </div>

                {{-- Warning Jika Terlambat --}}
                @if ($borrowing->is_late)
                    <div class="bg-rose-50 border border-rose-200 rounded-2xl p-4 shadow-2xs">
                        <div class="flex items-start gap-3">
                            <div class="text-xl p-1 bg-white border border-rose-200 rounded-lg shadow-2xs">⚠️</div>
                            <div>
                                <h3 class="font-bold text-rose-800 text-sm">Pelanggaran Tenggat Waktu</h3>
                                <p class="text-xs text-rose-600 mt-0.5 leading-relaxed">
                                    Peminjam ini terdeteksi terlambat mengembalikan buku selama <strong
                                        class="underline font-bold">{{ $borrowing->late_days }} hari</strong> dari tanggal
                                    jatuh tempo.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Grid Informasi Data Peminjam & Data Buku --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- Card Peminjam --}}
                    <div class="bg-white border border-slate-200/60 rounded-2xl p-5 shadow-xs">
                        <h3
                            class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3.5 flex items-center gap-1.5">
                            <span>👤</span> Profil Siswa
                        </h3>
                        <div class="space-y-2.5 text-xs">
                            <div>
                                <span class="text-slate-400 block font-medium">Nama Lengkap</span>
                                <span class="text-slate-700 font-bold text-sm">{{ $borrowing->user->name }}</span>
                            </div>
                            <div class="grid grid-cols-2 gap-2 border-t border-slate-50 pt-2">
                                <div>
                                    <span class="text-slate-400 block font-medium">NIS / NIP</span>
                                    <span class="text-slate-700 font-bold">{{ $borrowing->user->nis_nip }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 block font-medium">Kelas</span>
                                    <span class="text-slate-700 font-bold">{{ $borrowing->user->kelas->kelas }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Card Buku --}}
                    <div class="bg-white border border-slate-200/60 rounded-2xl p-5 shadow-xs">
                        <h3
                            class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3.5 flex items-center gap-1.5">
                            <span>📖</span> Detail Buku & Volume
                        </h3>
                        <div class="space-y-2.5 text-xs">
                            <div>
                                <span class="text-slate-400 block font-medium">Judul Utama</span>
                                <span
                                    class="text-slate-700 font-bold text-sm line-clamp-1">{{ $borrowing->book->judul }}</span>
                            </div>
                            <div class="grid grid-cols-2 gap-2 border-t border-slate-50 pt-2">
                                <div>
                                    <span class="text-slate-400 block font-medium">Kategori</span>
                                    <span
                                        class="text-slate-600 font-semibold">{{ $borrowing->book->category->category }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-400 block font-medium">Jumlah Pinjam</span>
                                    <span
                                        class="text-slate-700 font-bold px-1.5 py-0.5 bg-slate-100 border border-slate-200 rounded text-[10px]">{{ $borrowing->quantity }}
                                        Eks</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Timeline Alur Waktu --}}
                <div class="bg-white border border-slate-200/60 rounded-2xl p-5 shadow-xs">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 flex items-center gap-1.5">
                        <span>⏳</span> Jejak Riwayat Waktu
                    </h3>
                    <div class="relative border-l-2 border-slate-100 ml-2.5 pl-4 space-y-4 text-xs">
                        <div>
                            <span class="absolute -left-[7px] w-3 h-3 rounded-full bg-blue-400 ring-4 ring-white"></span>
                            <span class="text-slate-400 font-medium">Tanggal Pengajuan:</span>
                            <span
                                class="text-slate-700 font-bold block mt-0.5">{{ $borrowing->requested_at ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="absolute -left-[7px] w-3 h-3 rounded-full bg-purple-400 ring-4 ring-white"></span>
                            <span class="text-slate-400 font-medium">Persetujuan Admin:</span>
                            <span class="text-slate-700 font-bold block mt-0.5">{{ $borrowing->approved_at ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="absolute -left-[7px] w-3 h-3 rounded-full bg-amber-400 ring-4 ring-white"></span>
                            <span class="text-slate-400 font-medium">Fisik Buku Diambil:</span>
                            <span class="text-slate-700 font-bold block mt-0.5">{{ $borrowing->borrow_date ?? '-' }}</span>
                        </div>
                        <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                            <span class="text-slate-400 font-medium">📅 Batas Waktu Kembalikan (Jatuh Tempo):</span>
                            <span class="text-slate-800 font-bold block mt-0.5 text-sm">
                                {{ $borrowing->due_date?->format('d M Y H:i') }}
                            </span>
                        </div>
                        <div>
                            <span class="absolute -left-[7px] w-3 h-3 rounded-full bg-emerald-400 ring-4 ring-white"></span>
                            <span class="text-slate-400 font-medium">Tanggal Dikembalikan:</span>
                            <span class="text-slate-700 font-bold block mt-0.5">{{ $borrowing->returned_at ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Memorandum Catatan --}}
                <div class="bg-white border border-slate-200/60 rounded-2xl p-5 shadow-xs">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                        <span>📝</span> Memo Khusus Admin
                    </h3>
                    <p
                        class="text-xs text-slate-600 leading-relaxed bg-slate-50 border border-slate-100 p-3 rounded-xl italic">
                        "{{ $borrowing->description ?: 'Tidak ada catatan internal dari admin.' }}"
                    </p>
                </div>

            </div>
        </div>
    </div>

    {{-- MODAL AREA (RESPONSIVE BOX) --}}

    {{-- Modal 1: Tolak Permintaan --}}
    <div id="reject-modal"
        class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
        <div
            class="bg-white border border-slate-200 rounded-2xl p-5 w-full max-w-md shadow-xl transform transition-all animate-in fade-in zoom-in-95 duration-150">
            <h3 class="font-bold text-slate-800 text-base mb-2 flex items-center gap-1.5">
                <span>⚠️</span> Tolak Pengajuan Pinjam
            </h3>
            <p class="text-xs text-slate-500 mb-4">
                Berikan keterangan atau alasan penolakan berkas agar dapat dibaca oleh siswa terkait.
            </p>
            <form method="POST" action="{{ route('admin.borrowings.rejected', $borrowing) }}">
                @csrf
                @method('PATCH')
                <textarea name="description" rows="4"
                    class="w-full rounded-xl border border-slate-300 text-xs p-3 text-slate-800 focus:ring-1 focus:ring-rose-500 focus:border-rose-500 focus:outline-none"
                    placeholder="Contoh: Stok fisik buku habis atau sedang dalam perbaikan..."></textarea>

                <div class="flex items-center justify-end gap-2.5 mt-4 pt-3 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('reject-modal').classList.add('hidden')"
                        class="px-4 py-2 border border-slate-200 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-50 transition-all">
                        Batalkan
                    </button>
                    <button
                        class="px-4 py-2 bg-rose-50 border border-rose-200 text-rose-700 hover:bg-rose-100 text-xs font-bold rounded-xl shadow-2xs transition-all">
                        Ya, Tolak Berkas
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal 2: Konfirmasi Ambil Buku --}}
    <div id="borrow-modal"
        class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center p-4 z-50">
        <div
            class="bg-white border border-slate-200 rounded-2xl p-5 w-full max-w-md shadow-xl transform transition-all animate-in fade-in zoom-in-95 duration-150">
            <h3 class="font-bold text-slate-800 text-base mb-1 flex items-center gap-1.5">
                <span>📆</span> Atur Tanggal Jatuh Tempo
            </h3>
            <p class="text-xs text-slate-500 mb-4">
                Konfirmasi peminjaman fisik buku dan tentukan batas akhir pengembaliannya.
            </p>

            <form method="POST" action="{{ route('admin.borrowings.borrowed', $borrowing) }}" class="space-y-4">
                @csrf
                @method('PATCH')
                <div>
                    <label class="block mb-1.5 text-xs font-bold text-slate-600">Tanggal Jatuh Tempo</label>
                    <input type="datetime-local" name="due_date"
                        class="w-full rounded-xl border border-slate-300 text-xs p-2.5 text-slate-800 focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none"
                        required>
                </div>
                <div>
                    <label class="block mb-1.5 text-xs font-bold text-slate-600">Catatan/Memo Tambahan (Opsional)</label>
                    <textarea name="description" rows="3"
                        class="w-full rounded-xl border border-slate-300 text-xs p-3 text-slate-800 focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none"
                        placeholder="Tulis catatan jika kondisi buku ada robek tipis dsb..."></textarea>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('borrow-modal').classList.add('hidden')"
                        class="px-4 py-2 border border-slate-200 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-50 transition-all">
                        Batal
                    </button>
                    <button
                        class="px-4 py-2 bg-emerald-50 border border-emerald-200 text-emerald-700 hover:bg-emerald-100 text-xs font-bold rounded-xl shadow-2xs transition-all">
                        Simpan Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
