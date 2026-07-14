@extends('layouts.app')

@section('title', 'Kirim Kritik & Saran')
@section('page-title', 'Kirim Kritik & Saran')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 px-2 sm:px-0">

    {{-- Header & Navigasi Kembali --}}
    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-5 sm:p-6 shadow-sm">
        <div>
            <a href="{{ route('user.feedbacks.index') }}"
                class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-slate-500 hover:text-blue-600 transition-colors group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Riwayat
            </a>
            
            <h2 class="mt-3 text-xl sm:text-2xl font-bold text-slate-800 tracking-tight flex items-center gap-2">
                <span>📝</span> Tulis Kritik & Saran Baru
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">
                Setiap masukan yang Anda berikan menjadi landasan penting bagi kami untuk mengevaluasi pelayanan perpustakaan.
            </p>
        </div>
    </div>

    {{-- Kontainer Form Utama --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 sm:p-8 shadow-xs">
        <form action="{{ route('user.feedbacks.store') }}" method="POST">
            @csrf

            <div class="space-y-5">
                {{-- Komponen Input Kategori --}}
                <div>
                    <label class="block text-xs sm:text-sm font-bold text-slate-700 uppercase tracking-wide mb-2 flex items-center gap-1">
                        <span>🏷️</span> Pilih Kategori <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="category"
                            class="w-full rounded-xl border border-slate-300 bg-slate-50/50 text-slate-800 font-medium px-4 py-3 text-sm focus:bg-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none appearance-none transition-all">
                            <option value="">-- Silahkan Pilih Kategori --</option>
                            <option value="website" {{ old('category') == 'website' ? 'selected' : '' }}>💻 Website Sistem</option>
                            <option value="koleksi_buku" {{ old('category') == 'koleksi_buku' ? 'selected' : '' }}>📚 Koleksi Katalog Buku</option>
                            <option value="pelayanan" {{ old('category') == 'pelayanan' ? 'selected' : '' }}>👨‍🏫 Pelayanan Staf/Petugas</option>
                            <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>💡 Fasilitas Lainnya</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-450">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>
                    @error('category')
                        <p class="mt-2 text-xs font-bold text-red-600 flex items-center gap-1">
                            ⚠️ {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Komponen Input Pesan --}}
                <div>
                    <label class="block text-xs sm:text-sm font-bold text-slate-700 uppercase tracking-wide mb-2 flex items-center gap-1">
                        <span>✍️</span> Detail Masukan Anda <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="message"
                        rows="7"
                        maxlength="1000"
                        placeholder="Uraikan secara detail kritik konstruktif atau saran yang ingin Anda sampaikan..."
                        class="w-full rounded-xl border border-slate-300 bg-slate-50/50 text-slate-800 font-medium p-4 text-sm focus:bg-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none resize-none transition-all placeholder:text-slate-400 leading-relaxed">{{ old('message') }}</textarea>

                    <div class="flex justify-between items-center mt-2">
                        @error('message')
                            <p class="text-xs font-bold text-red-600 flex items-center gap-1">
                                ⚠️ {{ $message }}
                            </p>
                        @else
                            <p class="text-xs font-medium text-slate-400 ml-auto">
                                Maksimal 1000 karakter.
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Informasi Prosedur (Warna Muted/Samar Lembut) --}}
                <div class="rounded-xl bg-blue-50/60 border border-blue-100/70 p-4">
                    <div class="flex gap-3">
                        <div class="w-6 h-6 rounded-md bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.852l.041-.028M12 20.25h.008v.008H12V20.25z" />
                            </svg>
                        </div>
                        <p class="text-xs sm:text-sm font-semibold text-slate-600 leading-relaxed">
                            Pesan Anda dijamin bersifat rahasia dan langsung masuk ke panel validasi admin perpustakaan. 
                            Anda akan menerima pemberitahuan otomatis segera setelah admin mengirimkan balasan resmi.
                        </p>
                    </div>
                </div>

                {{-- Tombol Aksi Formulir (Responsif Kolom Penuh di Mobile) --}}
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2.5 pt-4 border-t border-slate-100">
                    <a href="{{ route('user.feedbacks.index') }}"
                        class="w-full sm:w-auto text-center px-5 py-3 sm:py-2.5 rounded-xl border border-slate-300 hover:bg-slate-100 text-xs sm:text-sm font-bold text-slate-600 transition-colors">
                        Batal
                    </a>
                    
                    <button type="submit"
                        class="w-full sm:w-auto text-center px-6 py-3 sm:py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-bold shadow-sm hover:shadow transition-all flex items-center justify-center gap-1.5">
                        🚀 Kirim Masukan
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection