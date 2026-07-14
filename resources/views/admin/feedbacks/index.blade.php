@extends('layouts.app')

@section('title', 'Kritik & Saran')
@section('page-title', 'Kritik & Saran')

@section('content')
<div class="max-w-7xl mx-auto space-y-6 px-2 sm:px-0">

    {{-- Header Page --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-50 border border-slate-200/60 rounded-2xl p-5 shadow-xs">
        <div>
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <span>💬</span> Kritik & Saran
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Kelola seluruh aspirasi, kritik, dan saran berkala dari pengguna sistem.
            </p>
        </div>
        
        <div class="bg-white border border-slate-200/80 rounded-xl px-4 py-2.5 flex items-center gap-3 shadow-2xs self-start sm:self-auto">
            <span class="p-2 bg-blue-50/70 border border-blue-100 rounded-lg text-sm">📊</span>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Feedback</p>
                <p class="text-lg font-black text-slate-700 leading-tight">{{ $feedbacks->total() }}</p>
            </div>
        </div>
    </div>

    {{-- Filter Panel --}}
    <form method="GET" class="bg-white rounded-2xl border border-slate-200/60 p-5 shadow-xs space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Input Pencarian --}}
            <div class="relative">
                <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-xs text-slate-400">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari nama, NIS atau isi teks..." 
                    class="w-full pl-9 rounded-xl border border-slate-300 text-xs p-2.5 text-slate-800 focus:ring-1 focus:ring-slate-400 focus:border-slate-400 focus:outline-none">
            </div>

            {{-- Filter Kategori --}}
            <div>
                <select name="category" class="w-full rounded-xl border border-slate-300 text-xs p-2.5 text-slate-700 focus:ring-1 focus:ring-slate-400 focus:border-slate-400 focus:outline-none">
                    <option value="">📁 Semua Kategori</option>
                    <option value="website" @selected(request('category')=='website')>💻 Website</option>
                    <option value="koleksi_buku" @selected(request('category')=='koleksi_buku')>📚 Koleksi Buku</option>
                    <option value="pelayanan" @selected(request('category')=='pelayanan')>🤝 Pelayanan</option>
                    <option value="lainnya" @selected(request('category')=='lainnya')>⚙️ Lainnya</option>
                </select>
            </div>

            {{-- Filter Status --}}
            <div>
                <select name="status" class="w-full rounded-xl border border-slate-300 text-xs p-2.5 text-slate-700 focus:ring-1 focus:ring-slate-400 focus:border-slate-400 focus:outline-none">
                    <option value="">⚡ Semua Status</option>
                    <option value="waiting" @selected(request('status')=='waiting')>⏳ Menunggu Balasan</option>
                    <option value="replied" @selected(request('status')=='replied')>✅ Sudah Dibalas</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end pt-2 border-t border-slate-50">
            <button class="w-full sm:w-auto px-5 py-2 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl shadow-xs transition-all">
                Terapkan Filter
            </button>
        </div>
    </form>

    {{-- Data Render --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-xs overflow-hidden">
        
        {{-- Mode Desktop: Table (Disembunyikan pada layar HP) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Pengirim</th>
                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Dikirim</th>
                        <th class="px-6 py-3.5 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($feedbacks as $feedback)
                        <tr class="hover:bg-slate-50/80 transition-all">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xs font-bold text-slate-700">{{ $feedback->user->name }}</div>
                                <div class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $feedback->user->kelas->name ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md bg-blue-50 border border-blue-150 text-blue-600 text-[10px] font-bold shadow-2xs">
                                    {{ ucwords(str_replace('_',' ',$feedback->category)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($feedback->reply)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-emerald-50 border border-emerald-150 text-emerald-600 text-[10px] font-bold shadow-2xs">
                                        <span class="w-1 h-1 rounded-full bg-emerald-500"></span> Sudah Dibalas
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-amber-50 border border-amber-150 text-amber-600 text-[10px] font-bold shadow-2xs">
                                        <span class="w-1 h-1 rounded-full bg-amber-500"></span> Menunggu
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                                <span class="font-medium text-slate-600">{{ $feedback->created_at->format('d M Y') }}</span>
                                <span class="block text-[10px] text-slate-400 mt-0.5">{{ $feedback->created_at->format('H:i') }} WIB</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{ route('admin.feedbacks.show',$feedback) }}" 
                                   class="inline-flex items-center justify-center px-3 py-1.5 border border-slate-200 bg-white text-[11px] font-bold text-slate-600 rounded-lg hover:bg-slate-50 shadow-2xs transition-all">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-xs font-medium text-slate-400 bg-slate-50/40">
                                📋 Belum ada berkas feedback yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mode Mobile: List Card (Tampil khusus di layar HP) --}}
        <div class="block md:hidden divide-y divide-slate-100">
            @forelse($feedbacks as $feedback)
                <div class="p-4 hover:bg-slate-50/50 transition-all space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <h4 class="text-xs font-bold text-slate-700">{{ $feedback->user->name }}</h4>
                            <p class="text-[10px] text-slate-400 mt-0.5">{{ $feedback->user->kelas->name ?? '-' }}</p>
                        </div>
                        <div class="text-right flex flex-col items-end gap-1">
                            <span class="inline-flex items-center px-2 py-0.5 rounded bg-blue-50 border border-blue-100 text-blue-600 text-[9px] font-bold">
                                {{ ucwords(str_replace('_',' ',$feedback->category)) }}
                            </span>
                            @if($feedback->reply)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-emerald-50 border border-emerald-100 text-emerald-600 text-[9px] font-bold">
                                    Sudah Dibalas
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-amber-50 border border-amber-100 text-amber-600 text-[9px] font-bold">
                                    Menunggu
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between pt-2 border-t border-slate-50 text-[10px]">
                        <span class="text-slate-400 font-medium">
                            📅 {{ $feedback->created_at->format('d M Y - H:i') }}
                        </span>
                        <a href="{{ route('admin.feedbacks.show',$feedback) }}" 
                           class="inline-flex items-center px-3 py-1 bg-slate-50 border border-slate-200 text-[10px] font-bold text-slate-600 rounded-lg shadow-3xs hover:bg-slate-100 transition-all">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-xs font-medium text-slate-400 p-4">
                    📋 Belum ada berkas feedback yang masuk.
                </div>
            @endforelse
        </div>

    </div>

    {{-- Pagination --}}
    <div class="pt-2">
        {{ $feedbacks->links() }}
    </div>

</div>
@endsection