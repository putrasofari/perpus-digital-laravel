@extends('layouts.app')

@section('title', 'Data Buku')
@section('page-title', 'Data Buku')

@section('content')
<div class="max-w-7xl mx-auto space-y-6 px-2 sm:px-0">

    {{-- Header Page --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-50 border border-slate-200/60 rounded-2xl p-5 shadow-xs">
        <div>
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <span>📚</span> Manajemen Koleksi Buku
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Kelola katalog, klasifikasi, status ketersediaan, dan stok buku perpustakaan secara terpusat.
            </p>
        </div>
        
        <a href="{{ route('admin.books.create') }}"
           class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-slate-800 hover:bg-slate-900 text-xs font-bold text-white rounded-xl shadow-xs transition-all self-start sm:self-auto">
            <span>➕</span> Tambah Buku
        </a>
    </div>

    {{-- Search & Filter Panel --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 p-4 shadow-xs">
        <form method="GET">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-xs text-slate-400">🔍</span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari judul atau penulis..." 
                        class="w-full pl-9 rounded-xl border border-slate-300 text-xs p-2.5 text-slate-800 focus:ring-1 focus:ring-slate-400 focus:border-slate-400 focus:outline-none">
                </div>

                <div>
                    <select name="category" class="w-full rounded-xl border border-slate-300 text-xs p-2.5 text-slate-800 focus:ring-1 focus:ring-slate-400 focus:border-slate-400 focus:outline-none bg-white">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                {{ $category->category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="w-full px-5 py-2.5 bg-slate-100 hover:bg-slate-200 border border-slate-300 text-slate-700 text-xs font-bold rounded-xl transition-all">
                    Terapkan Filter
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
                        <th class="px-6 py-3.5 w-24 text-center">Sampul</th>
                        <th class="px-6 py-3.5">Judul Buku</th>
                        <th class="px-6 py-3.5">Kategori</th>
                        <th class="px-6 py-3.5">Penulis</th>
                        <th class="px-6 py-3.5 text-center w-24">Stok</th>
                        <th class="px-6 py-3.5 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($books as $book)
                        {{-- Row Clickable mengarah ke detail buku --}}
                        <tr onclick="window.location='{{ route('admin.books.show', $book->id) }}'" 
                            class="hover:bg-slate-50/80 cursor-pointer transition-all group">
                            
                            <td class="px-6 py-3 whitespace-nowrap text-center" onclick="event.stopPropagation(); window.location='{{ route('admin.books.show', $book->id) }}'">
                                @if ($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" class="w-10 h-14 rounded-md object-cover inline-block border border-slate-200 shadow-3xs group-hover:scale-105 transition-transform">
                                @else
                                    <div class="w-10 h-14 rounded-md bg-slate-100 border border-slate-200 inline-flex items-center justify-center text-[9px] text-slate-400 font-medium tracking-tighter">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4">
                                <div class="text-xs font-bold text-slate-700 group-hover:text-blue-600 transition-colors line-clamp-2">
                                    {{ $book->judul }}
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                                <span class="px-2 py-0.5 bg-slate-100 border border-slate-200/60 rounded text-[11px] font-medium text-slate-600">
                                    {{ $book->category->category }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600 font-medium">
                                ✍️ {{ $book->penulis }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-center text-xs">
                                <span class="inline-block min-w-8 text-center px-2 py-0.5 rounded-full text-[11px] font-bold {{ $book->stok > 0 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200/40' : 'bg-rose-50 text-rose-700 border border-rose-200/40' }}">
                                    {{ $book->stok }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-center text-xs" onclick="event.stopPropagation();">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.books.edit', $book->id) }}" 
                                       class="p-1.5 bg-amber-50 text-amber-600 border border-amber-200/60 rounded-lg hover:bg-amber-100 transition-all shadow-3xs" 
                                       title="Ubah Data Buku">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini dari sistem?')" 
                                                class="p-1.5 bg-rose-50 text-rose-600 border border-rose-200/60 rounded-lg hover:bg-rose-100 transition-all shadow-3xs" 
                                                title="Hapus Buku">
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
                            <td colspan="6" class="text-center py-12 text-xs font-medium text-slate-400 bg-slate-50/40">
                                📔 Katalog utama buku belum memuat data apapun.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mode Mobile View (Card List Layout) --}}
        <div class="block md:hidden divide-y divide-slate-100">
            @forelse ($books as $book)
                <div onclick="window.location='{{ route('admin.books.show', $book->id) }}'" 
                     class="p-4 hover:bg-slate-50/50 cursor-pointer transition-all flex gap-3 relative group">
                    
                    <div class="flex-shrink-0" onclick="event.stopPropagation(); window.location='{{ route('admin.books.show', $book->id) }}'">
                        @if ($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" class="w-12 h-16 rounded object-cover border border-slate-200">
                        @else
                            <div class="w-12 h-16 rounded bg-slate-100 border border-slate-200 flex items-center justify-center text-[9px] text-slate-400 text-center font-medium">
                                No Cover
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0 space-y-1 text-xs">
                        <div class="font-bold text-slate-700 truncate group-hover:text-blue-600 transition-colors">
                            {{ $book->judul }}
                        </div>
                        <div class="text-slate-500 font-medium text-[11px] flex items-center gap-1">
                            <span>✍️</span> <span class="truncate">{{ $book->penulis }}</span>
                        </div>
                        <div class="flex items-center gap-2 pt-1">
                            <span class="px-1.5 py-0.5 bg-slate-100 border border-slate-200/50 rounded text-[10px] text-slate-600">
                                {{ $book->category->category }}
                            </span>
                            <span class="px-1.5 py-0.5 rounded-full text-[10px] font-bold {{ $book->stok > 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                Stok: {{ $book->stok }}
                            </span>
                        </div>
                    </div>

                    {{-- Floating Action Buttons untuk Mobile di Sudut Kanan Bawah --}}
                    <div class="absolute bottom-3 right-4 flex items-center gap-1.5" onclick="event.stopPropagation();">
                        <a href="{{ route('admin.books.edit', $book->id) }}" 
                           class="p-1 bg-amber-50 border border-amber-200 text-amber-600 rounded-md text-[11px]">
                            ✏️
                        </a>
                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus buku ini?')" 
                                    class="p-1 bg-rose-50 border border-rose-200 text-rose-600 rounded-md text-[11px]">
                                🗑️
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="text-center py-10 text-xs font-medium text-slate-400 p-4">
                    📔 Katalog utama buku belum memuat data apapun.
                </div>
            @endforelse
        </div>

    </div>

    {{-- Footer Pagination --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2 text-xs">
        <p class="text-slate-500 font-medium text-center sm:text-left">
            Menampilkan indeks <strong>{{ $books->firstItem() ?? 0 }}</strong> sampai <strong>{{ $books->lastItem() ?? 0 }}</strong> dari akumulasi total <strong>{{ $books->total() }}</strong> entitas pustaka.
        </p>
        
        @if ($books->hasPages())
            <div class="flex justify-center sm:justify-end">
                {{ $books->onEachSide(1)->links() }}
            </div>
        @endif
    </div>

</div>
@endsection