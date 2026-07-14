@extends('layouts.app')

@section('title', 'Notifikasi')
@section('page-title', 'Notifikasi')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 px-2 sm:px-0">

    {{-- Header & Panel Filter Kontrol --}}
    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-5 sm:p-6 shadow-sm">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            
            {{-- Teks Judul --}}
            <div class="flex items-start gap-3">
                <div class="p-2.5 bg-slate-200/70 text-slate-600 rounded-xl hidden sm:block">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight">Pusat Notifikasi</h2>
                    <p class="text-xs sm:text-sm text-slate-500/90 mt-0.5">Pantau seluruh aktivitas akun dan log riwayat peminjaman.</p>
                </div>
            </div>

            {{-- Tombol Filter & Aksi (Responsif Kolom Penuh di Mobile) --}}
            <div class="grid grid-cols-2 sm:flex sm:items-center gap-2 text-xs sm:text-sm">
                <a href="{{ route('notifications.index', ['filter' => 'unread']) }}"
                    class="px-4 py-2.5 text-center font-semibold rounded-xl border border-slate-300 transition-colors {{ request('filter') === 'unread' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                    📥 Belum Dibaca
                </a>

                <a href="{{ route('notifications.index', ['filter' => 'read']) }}"
                    class="px-4 py-2.5 text-center font-semibold rounded-xl border border-slate-300 transition-colors {{ request('filter') === 'read' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-white text-slate-700 hover:bg-slate-100' }}">
                    ✅ Sudah Dibaca
                </a>

                @if(auth()->user()->unreadNotifications()->count())
                    <form method="POST" action="{{ route('notifications.read-all') }}" class="col-span-2 sm:col-span-1 w-full">
                        @csrf
                        @method('PATCH')
                        <button class="w-full px-4 py-2.5 font-bold bg-slate-200 hover:bg-slate-300/80 text-slate-700 rounded-xl border border-slate-300 transition-all flex items-center justify-center gap-1.5">
                            <span>🧹</span> Tandai Semua Dibaca
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>

    {{-- Daftar Notifikasi --}}
    <div class="space-y-3">
        @forelse($notifications as $notification)
            <a href="{{ route('notifications.show', $notification) }}" class="block group">
                <div class="rounded-2xl border transition-all duration-200 {{ is_null($notification->read_at) ? 'bg-blue-50/40 border-blue-200/70 hover:bg-blue-50/60 shadow-sm' : 'bg-white border-slate-200 hover:border-slate-300 hover:shadow-sm' }}">
                    <div class="p-4 sm:p-5">
                        <div class="flex items-start gap-3.5">
                            
                            {{-- Wadah Ikon Unik Warna Samar/Muted --}}
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-xl flex-shrink-0 border transition-transform group-hover:scale-105 {{ is_null($notification->read_at) ? 'bg-blue-100/70 border-blue-200 text-blue-700' : 'bg-slate-100/80 border-slate-200 text-slate-500' }}">
                                {{ $notification->data['icon'] ?? '✉️' }}
                            </div>

                            {{-- Konten Informasi --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <h3 class="text-sm sm:text-base font-bold text-slate-800 group-hover:text-blue-700 transition-colors leading-snug">
                                            {{ $notification->data['title'] }}
                                        </h3>
                                        <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                                            {{ $notification->data['message'] }}
                                        </p>
                                    </div>

                                    {{-- Titik Status Indikator Belum Dibaca --}}
                                    @if(is_null($notification->read_at))
                                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500 mt-1.5 flex-shrink-0 ring-4 ring-blue-100"></span>
                                    @endif
                                </div>

                                {{-- Baris Keterangan Waktu & Status Badge Lembut --}}
                                <div class="mt-4 flex flex-wrap items-center gap-x-3 gap-y-1.5 text-[11px] font-semibold text-slate-400">
                                    <span class="flex items-center gap-1 bg-slate-100 px-2 py-0.5 rounded-md text-slate-500">
                                        📅 {{ $notification->created_at->format('d M Y, H:i') }}
                                    </span>
                                    <span class="text-slate-300 hidden sm:inline">•</span>
                                    <span class="text-slate-400">
                                        ⏱️ {{ $notification->created_at->diffForHumans() }}
                                    </span>
                                    
                                    <span class="ml-auto px-2 py-0.5 rounded-md border text-[10px] uppercase tracking-wider {{ $notification->read_at ? 'bg-emerald-50/60 text-emerald-600 border-emerald-200/60' : 'bg-blue-50/60 text-blue-600 border-blue-200/60' }}">
                                        {{ $notification->read_at ? 'Sudah Dibaca' : 'Baru' }}
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </a>
        @empty
            {{-- State Kosong: Samar / Muted Elegant --}}
            <div class="bg-slate-50/50 border border-dashed border-slate-300 rounded-2xl p-10 text-center">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-3xl mx-auto mb-3 shadow-inner">
                    📭
                </div>
                <h3 class="text-base font-bold text-slate-700">Kotak Masuk Bersih</h3>
                <p class="text-xs sm:text-sm text-slate-400 mt-1 max-w-sm mx-auto">
                    Saat ini belum ada notifikasi masuk. Informasi terbaru seputar peminjaman akan tampil di sini.
                </p>
            </div>
        @endforelse
    </div>

    {{-- Kustomisasi Navigasi Halaman (Pagination) --}}
    <div class="pt-2">
        {{ $notifications->links() }}
    </div>

</div>
@endsection