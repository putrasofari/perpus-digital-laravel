@extends('layouts.app')

@section('title', 'Kritik & Saran')
@section('page-title', 'Kritik & Saran')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 px-2 sm:px-0">

    {{-- Bagian Header --}}
    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-5 sm:p-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight flex items-center gap-2">
                    <span>💬</span> Pusat Kritik & Saran
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">
                    Kirim masukan bernilai Anda untuk membantu kami meningkatkan kualitas pelayanan perpustakaan.
                </p>
            </div>
            
            <a href="{{ route('user.feedbacks.create') }}"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 sm:py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm shadow-sm transition-all flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tulis Feedback
            </a>
        </div>
    </div>

    {{-- Kategori & Filter Pencarian (Scrollable secara horizontal pada layar ponsel kecil) --}}
    <div class="flex items-center gap-2 overflow-x-auto pb-2 -mx-2 px-2 scrollbar-none">
        <a href="{{ route('user.feedbacks.index') }}"
            class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-full border transition-all whitespace-nowrap {{ !request('category') ? 'bg-slate-700 text-white border-slate-700 shadow-sm' : 'bg-slate-100 text-slate-600 border-slate-200 hover:bg-slate-200/80' }}">
            Semua
        </a>

        <a href="{{ route('user.feedbacks.index', ['category' => 'website']) }}"
            class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-full border transition-all whitespace-nowrap {{ request('category') == 'website' ? 'bg-slate-700 text-white border-slate-700 shadow-sm' : 'bg-slate-100 text-slate-600 border-slate-200 hover:bg-slate-200/80' }}">
            💻 Website
        </a>

        <a href="{{ route('user.feedbacks.index', ['category' => 'koleksi_buku']) }}"
            class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-full border transition-all whitespace-nowrap {{ request('category') == 'koleksi_buku' ? 'bg-slate-700 text-white border-slate-700 shadow-sm' : 'bg-slate-100 text-slate-600 border-slate-200 hover:bg-slate-200/80' }}">
            📚 Koleksi Buku
        </a>

        <a href="{{ route('user.feedbacks.index', ['category' => 'pelayanan']) }}"
            class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-full border transition-all whitespace-nowrap {{ request('category') == 'pelayanan' ? 'bg-slate-700 text-white border-slate-700 shadow-sm' : 'bg-slate-100 text-slate-600 border-slate-200 hover:bg-slate-200/80' }}">
            👨‍🏫 Pelayanan
        </a>

        <a href="{{ route('user.feedbacks.index', ['category' => 'lainnya']) }}"
            class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-full border transition-all whitespace-nowrap {{ request('category') == 'lainnya' ? 'bg-slate-700 text-white border-slate-700 shadow-sm' : 'bg-slate-100 text-slate-600 border-slate-200 hover:bg-slate-200/80' }}">
            💡 Lainnya
        </a>
    </div>

    {{-- List Data Feedback --}}
    <div class="space-y-3.5">
        @forelse ($feedbacks as $feedback)
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-xs hover:shadow-md hover:border-slate-300 transition-all duration-200 relative group overflow-hidden">
                
                {{-- Pembungkus tautan utama halaman detail masukan --}}
                <a href="{{ route('user.feedbacks.show', $feedback) }}" class="block p-4 sm:p-5">
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3 pb-1">
                        
                        {{-- Kategori & Label Informasi --}}
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md bg-blue-50 text-blue-700 border border-blue-100 text-[11px] font-bold tracking-wide uppercase">
                                {{ str_replace('_', ' ', ucfirst($feedback->category)) }}
                            </span>
                            <span class="text-slate-300 text-xs hidden sm:block">•</span>
                            <span class="text-[11px] font-medium text-slate-400">
                                ⏱️ {{ $feedback->created_at->diffForHumans() }}
                            </span>
                        </div>

                        {{-- Bagian Status Badge Muted / Lembut --}}
                        <div class="self-start sm:self-auto">
                            @if ($feedback->reply)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-xs font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Sudah Dibalas
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200/60 text-xs font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Menunggu Balasan
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Isi Pesan Kritik / Saran --}}
                    <p class="mt-2.5 text-sm sm:text-base text-slate-600 group-hover:text-slate-800 transition-colors line-clamp-2 leading-relaxed pr-6">
                        {{ $feedback->message }}
                    </p>
                </a>

                {{-- Tombol Aksi Hapus Khusus Masukan yang Belum Dibalas (Ditempatkan secara absolut/melayang demi kebersihan tata letak) --}}
                @if (!$feedback->reply)
                    <div class="absolute bottom-3 right-4 z-20">
                        <form action="{{ route('user.feedbacks.destroy', $feedback) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus masukan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all border border-transparent hover:border-red-100"
                                title="Hapus Feedback">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @empty
            {{-- Tampilan Kosong (Empty State) Muted Lembut --}}
            <div class="bg-slate-50/50 border border-dashed border-slate-300 rounded-2xl p-10 text-center">
                <div class="w-16 h-16 bg-slate-100/80 rounded-full flex items-center justify-center text-3xl mx-auto mb-3 shadow-inner">
                    ✉️
                </div>
                <h3 class="text-base font-bold text-slate-700">Belum Ada Feedback</h3>
                <p class="text-xs sm:text-sm text-slate-400 mt-1 max-w-xs mx-auto">
                    Kritik dan saran yang Anda kirimkan nantinya akan terdata di halaman riwayat ini.
                </p>
                <a href="{{ route('user.feedbacks.create') }}"
                    class="inline-flex items-center gap-1.5 mt-5 px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold rounded-xl transition-all border border-slate-300">
                    ➕ Buat Masukan Pertama
                </a>
            </div>
        @endforelse
    </div>

    {{-- Kontrol Halaman Halaman (Pagination) --}}
    <div class="pt-2">
        {{ $feedbacks->links() }}
    </div>

</div>
@endsection