@extends('layouts.app')

@section('title', 'Data Kategori')
@section('page-title', 'Data Kategori')

@section('content')
<div class="max-w-7xl mx-auto space-y-6 px-2 sm:px-0">

    {{-- Header Page --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-50 border border-slate-200/60 rounded-2xl p-5 shadow-xs">
        <div>
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <span>🏷️</span> Klasifikasi Kategori Buku
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Kelola parameter kategori atau rak penempatan koleksi buku pustaka agar pencarian lebih efisien.
            </p>
        </div>
        
        <a href="{{ route('admin.categories.create') }}"
           class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-slate-800 hover:bg-slate-900 text-xs font-bold text-white rounded-xl shadow-xs transition-all self-start sm:self-auto">
            <span>➕</span> Tambah Kategori
        </a>
    </div>

    {{-- Search Filter --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 p-4 shadow-xs">
        <form method="GET">
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-xs text-slate-400">🔍</span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari nama kategori buku..." 
                        class="w-full pl-9 rounded-xl border border-slate-300 text-xs p-2.5 text-slate-800 focus:ring-1 focus:ring-slate-400 focus:border-slate-400 focus:outline-none">
                </div>
                <button class="w-full sm:w-auto px-6 py-2.5 bg-slate-100 hover:bg-slate-200 border border-slate-300 text-slate-700 text-xs font-bold rounded-xl transition-all">
                    Filter Data
                </button>
            </div>
        </form>
    </div>

    {{-- Render Content Area --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-xs overflow-hidden">
        
        {{-- Mode Desktop View (Table Layout) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50">
                    <tr class="text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-3.5 w-16 text-center">No</th>
                        <th class="px-6 py-3.5">Nama Kategori Koleksi</th>
                        <th class="px-6 py-3.5">Tanggal Registrasi</th>
                        <th class="px-6 py-3.5 text-center w-36">Modifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($categories as $category)
                        {{-- Row Clickable langsung mengarah ke halaman show detail --}}
                        <tr onclick="window.location='{{ route('admin.categories.show', $category) }}'" 
                            class="hover:bg-slate-50/80 cursor-pointer transition-all group">
                            
                            <td class="px-6 py-4 whitespace-nowrap text-center text-xs text-slate-400 font-medium">
                                {{ $categories->firstItem() + $loop->index }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xs font-bold text-slate-700 group-hover:text-blue-600 transition-colors flex items-center gap-1.5">
                                    <span>📖</span> {{ $category->category }}
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 font-medium">
                                📅 {{ $category->created_at->format('d M Y') }}
                            </td>
                            
                            {{-- Kolom Aksi terproteksi stopPropagation agar tidak memicu double redirect --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center text-xs" onclick="event.stopPropagation();">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.categories.edit', $category) }}" 
                                       class="p-1.5 bg-amber-50 text-amber-600 border border-amber-200/60 rounded-lg hover:bg-amber-100 transition-all shadow-3xs" 
                                       title="Ubah Rincian Kategori">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Apakah Anda yakin ingin menghapus klasifikasi kategori ini secara permanen?')" 
                                                class="p-1.5 bg-rose-50 text-rose-600 border border-rose-200/60 rounded-lg hover:bg-rose-100 transition-all shadow-3xs" 
                                                title="Hapus Kategori">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 text-xs font-medium text-slate-400 bg-slate-50/40">
                                📦 Belum ada data klasifikasi kategori yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mode Mobile View (Card List Layout) --}}
        <div class="block md:hidden divide-y divide-slate-100">
            @forelse ($categories as $category)
                <div onclick="window.location='{{ route('admin.categories.show', $category) }}'" 
                     class="p-4 hover:bg-slate-50/50 cursor-pointer transition-all space-y-3 relative group">
                    
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-bold text-slate-700 flex items-center gap-1.5">
                            <span>📖</span> {{ $category->category }}
                        </div>
                        <span class="text-[10px] text-slate-400 font-medium">
                            📅 {{ $category->created_at->format('d M Y') }}
                        </span>
                    </div>

                    <div class="flex items-center justify-end pt-2 border-t border-slate-50 text-[10px]" onclick="event.stopPropagation();">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" 
                               class="p-1.5 bg-amber-50 text-amber-600 border border-amber-200/50 rounded-lg text-xs">
                                ✏️
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus kategori ini?')" 
                                        class="p-1.5 bg-rose-50 text-rose-600 border border-rose-200/50 rounded-lg text-xs">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            @empty
                <div class="text-center py-10 text-xs font-medium text-slate-400 p-4">
                    📦 Belum ada data klasifikasi kategori yang tersimpan.
                </div>
            @endforelse
        </div>

    </div>

    {{-- Footer Pagination --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2 text-xs">
        <p class="text-slate-500 font-medium text-center sm:text-left">
            Menampilkan indeks <strong>{{ $categories->firstItem() ?? 0 }}</strong> sampai <strong>{{ $categories->lastItem() ?? 0 }}</strong> dari akumulasi total <strong>{{ $categories->total() }}</strong> kategori koleksi.
        </p>
        <div class="flex justify-center sm:justify-end">
            {{ $categories->onEachSide(1)->links() }}
        </div>
    </div>

</div>
@endsection