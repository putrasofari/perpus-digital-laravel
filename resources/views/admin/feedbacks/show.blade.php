@extends('layouts.app')

@section('title', 'Detail Kritik & Saran')
@section('page-title', 'Detail Kritik & Saran')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 px-2 sm:px-0">

    {{-- Header Page --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-50 border border-slate-200/60 rounded-2xl p-5 shadow-xs">
        <div>
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <span>📨</span> Detail Berkas Feedback
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Periksa isi korespondensi saran dan tentukan tindakan tindak lanjut admin.
            </p>
        </div>
        <a href="{{ route('admin.feedbacks.index') }}" 
           class="inline-flex items-center justify-center gap-1.5 px-4 py-2 border border-slate-200 bg-white text-xs font-bold text-slate-600 rounded-xl hover:bg-slate-50 shadow-2xs transition-all self-start sm:self-auto">
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    {{-- Grid Informasi Pengirim --}}
    <div class="bg-white border border-slate-200/60 rounded-2xl p-5 sm:p-6 shadow-xs">
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 flex items-center gap-1.5">
            <span>👤</span> Profil Pengirim Berkas
        </h3>
        
        <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-6 text-xs border-b border-slate-50 pb-5">
            <div>
                <span class="text-slate-400 block font-medium">Nama Lengkap</span>
                <span class="text-slate-700 font-bold text-sm">{{ $feedback->user->name }}</span>
            </div>
            <div>
                <span class="text-slate-400 block font-medium">NIS / NIP</span>
                <span class="text-slate-700 font-bold text-sm">{{ $feedback->user->nis_nip }}</span>
            </div>
            <div>
                <span class="text-slate-400 block font-medium">Kelas</span>
                <span class="text-slate-700 font-bold text-sm">{{ $feedback->user->kelas->kelas ?? '-' }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-y-4 gap-x-6 text-xs pt-4">
            <div>
                <span class="text-slate-400 block font-medium mb-1">Kategori Bahasan</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md bg-blue-50 border border-blue-150 text-blue-600 font-bold shadow-3xs">
                    📁 {{ ucwords(str_replace('_', ' ', $feedback->category)) }}
                </span>
            </div>
            <div>
                <span class="text-slate-400 block font-medium">Waktu Kirim</span>
                <span class="text-slate-600 font-semibold">{{ $feedback->created_at->format('d M Y - H:i') }} WIB</span>
            </div>
            <div>
                <span class="text-slate-400 block font-medium mb-1">Alur Status</span>
                @if($feedback->reply)
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-emerald-50 border border-emerald-150 text-emerald-600 font-bold shadow-3xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Selesai Dibalas
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-amber-50 border border-amber-150 text-amber-600 font-bold shadow-3xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu Balasan
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- Isi Pesan Pengguna --}}
    <div class="bg-white border border-slate-200/60 rounded-2xl p-5 sm:p-6 shadow-xs space-y-3">
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
            <span>📝</span> Uraian Kritik & Saran
        </h3>
        <div class="bg-slate-50/70 border border-slate-100 rounded-xl p-4 sm:p-5 text-slate-700 text-xs sm:text-sm leading-relaxed whitespace-pre-line italic">
            "{{ $feedback->message }}"
        </div>
    </div>

    {{-- Balasan Korrespondensi --}}
    <div class="bg-white border border-slate-200/60 rounded-2xl p-5 sm:p-6 shadow-xs space-y-4">
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
            <span>🗣️</span> Respons Resmi Admin
        </h3>

        @if(!$feedback->reply)
            {{-- Form Jika Belum Dibalas --}}
            <form action="{{ route('admin.feedbacks.reply', $feedback) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <textarea name="reply" rows="6" 
                        class="w-full rounded-xl border border-slate-300 text-xs p-3 text-slate-800 focus:ring-1 focus:ring-slate-400 focus:border-slate-400 focus:outline-none resize-none"
                        placeholder="Tulis tanggapan atau solusi resmi di sini agar dapat dipahami oleh pengguna terkait...">{{ old('reply') }}</textarea>
                    
                    @error('reply')
                        <p class="mt-1.5 text-xs font-bold text-rose-500 flex items-center gap-1">
                            <span>⚠️</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex justify-end pt-2 border-t border-slate-50">
                    <button class="w-full sm:w-auto px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl shadow-xs transition-all">
                        Kirim Balasan
                    </button>
                </div>
            </form>
        @else
            {{-- Tampilan Jika Sudah Dibalas --}}
            <div class="rounded-xl bg-emerald-50/60 border border-emerald-200/60 p-4 sm:p-5 space-y-4">
                <p class="whitespace-pre-line text-xs sm:text-sm text-slate-700 leading-relaxed font-medium">
                    {{ $feedback->reply }}
                </p>
                <div class="text-[10px] font-bold text-emerald-700/80 flex items-center gap-1 border-t border-emerald-200/40 pt-3">
                    <span>📅</span> Diselesaikan pada {{ $feedback->replied_at->format('d M Y - H:i') }} WIB
                </div>
            </div>
        @endif
    </div>

</div>
@endsection