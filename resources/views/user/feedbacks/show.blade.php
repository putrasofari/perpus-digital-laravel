@extends('layouts.app')

@section('title', 'Detail Kritik & Saran')
@section('page-title', 'Detail Kritik & Saran')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 px-2 sm:px-0">

    {{-- Bagian Header & Tombol Kembali --}}
    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-5 sm:p-6 shadow-sm">
        <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight flex items-center gap-2">
                    <span>🔍</span> Detail Masukan
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">
                    Pantau status respons serta riwayat jawaban resmi dari pihak manajemen perpustakaan.
                </p>
            </div>

            <a href="{{ route('user.feedbacks.index') }}"
                class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 sm:py-2 rounded-xl border border-slate-300 bg-white hover:bg-slate-50 text-xs sm:text-sm font-bold text-slate-600 shadow-xs transition-colors group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    {{-- Ringkasan Informasi Data --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-xs sm:text-sm">
            <div class="p-3 bg-slate-50/70 border border-slate-100 rounded-xl">
                <p class="font-semibold text-slate-400 uppercase tracking-wider text-[10px]">Kategori</p>
                <p class="font-bold text-slate-700 mt-1 flex items-center gap-1.5">
                    📁 {{ ucwords(str_replace('_', ' ', $feedback->category)) }}
                </p>
            </div>

            <div class="p-3 bg-slate-50/70 border border-slate-100 rounded-xl">
                <p class="font-semibold text-slate-400 uppercase tracking-wider text-[10px]">Tanggal Kirim</p>
                <p class="font-bold text-slate-700 mt-1 flex items-center gap-1.5">
                    📅 {{ $feedback->created_at->format('d M Y, H:i') }}
                </p>
            </div>

            <div class="p-3 bg-slate-50/70 border border-slate-100 rounded-xl col-span-2 md:col-span-1">
                <p class="font-semibold text-slate-400 uppercase tracking-wider text-[10px]">Status Laporan</p>
                <div class="mt-1">
                    @if($feedback->reply)
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200/60 font-bold text-[11px]">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Sudah Dibalas
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-amber-50 text-amber-700 border border-amber-200/60 font-bold text-[11px]">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            Menunggu Tindakan
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Thread Alur Percakapan (Pesan User & Balasan Admin) --}}
    <div class="space-y-4 relative before:absolute before:inset-y-0 before:left-6 before:w-0.5 before:bg-slate-100">
        
        {{-- BLOK 1: Pesan Masukan dari User --}}
        <div class="relative pl-12">
            {{-- Penanda Garis Waktu Ikonik --}}
            <div class="absolute left-3 top-2 w-6 h-6 rounded-full bg-blue-50 border-2 border-blue-400 flex items-center justify-center z-10 text-xs shadow-xs">
                🙋
            </div>
            
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs">
                <div class="flex items-center justify-between gap-4 mb-3 border-b border-slate-50 pb-2">
                    <div>
                        <p class="font-bold text-slate-800 text-sm sm:text-base">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] font-medium text-slate-400 flex items-center gap-1 mt-0.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $feedback->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <span class="text-xs font-bold text-slate-300 bg-slate-100/80 px-2 py-0.5 rounded-md">Pengirim</span>
                </div>
                
                <div class="text-sm sm:text-base text-slate-600 whitespace-pre-line leading-relaxed">
                    {{ $feedback->message }}
                </div>
            </div>
        </div>

        {{-- BLOK 2: Tanggapan dari Pihak Perpustakaan --}}
        <div class="relative pl-12">
            {{-- Penanda Garis Waktu Ikonik --}}
            @if($feedback->reply)
                <div class="absolute left-3 top-2 w-6 h-6 rounded-full bg-emerald-50 border-2 border-emerald-400 flex items-center justify-center z-10 text-xs shadow-xs">
                    🛡️
                </div>
                <div class="bg-emerald-50/40 border border-emerald-200/60 rounded-2xl p-5 shadow-xs">
                    <div class="flex items-center justify-between gap-4 mb-3 border-b border-emerald-100/50 pb-2">
                        <div>
                            <p class="font-bold text-emerald-800 text-sm sm:text-base">Tim Layanan Pelanggan</p>
                            @if($feedback->replied_at)
                                <p class="text-[11px] font-medium text-emerald-600/70 flex items-center gap-1 mt-0.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $feedback->replied_at->format('d M Y, H:i') }}
                                </p>
                            @endif
                        </div>
                        <span class="text-xs font-bold bg-emerald-100/80 text-emerald-700 px-2 py-0.5 rounded-md">Petugas Resmi</span>
                    </div>
                    
                    <div class="text-sm sm:text-base text-emerald-950 whitespace-pre-line leading-relaxed">
                        {{ $feedback->reply }}
                    </div>
                </div>
            @else
                <div class="absolute left-3 top-2 w-6 h-6 rounded-full bg-amber-50 border-2 border-amber-300 flex items-center justify-center z-10 text-xs shadow-xs">
                    ⏳
                </div>
                <div class="bg-amber-50/40 border border-amber-200/40 rounded-2xl p-5 shadow-xs border-dashed">
                    <div class="flex items-start gap-3">
                        <div class="text-slate-500 mt-0.5">ℹ️</div>
                        <div>
                            <p class="text-sm font-bold text-amber-800">Menunggu Verifikasi Internal</p>
                            <p class="text-xs text-amber-700/80 mt-1 leading-relaxed">
                                Laporan kritik atau saran ini telah diteruskan ke departemen terkait. Harap tunggu konfirmasi balasan dalam waktu berkala.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection