<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PustakaDigital - Jendela Dunia di Saku Anda</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50/50 text-slate-700 antialiased selection:bg-purple-100 selection:text-purple-900">

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 backdrop-blur-md bg-white/80 border-b border-slate-200/60 px-4 py-4 sm:px-6 lg:px-8 transition-all">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            {{-- Logo --}}
            <a href="#" class="flex items-center gap-2 group">
                <span class="text-xl">📖</span>
                <span class="text-base font-black tracking-tight text-slate-800">Pustaka<span class="text-purple-600 font-semibold">Digital</span></span>
            </a>

            {{-- Nav Links (Desktop) --}}
            <div class="hidden md:flex items-center gap-8 text-xs font-bold text-slate-500">
                <a href="#beranda" class="hover:text-slate-900 transition-colors">Beranda</a>
                <a href="#katalog" class="hover:text-slate-900 transition-colors">Katalog Buku</a>
                <a href="#fitur" class="hover:text-slate-900 transition-colors">Fitur Utama</a>
            </div>

            {{-- Auth Buttons --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}" 
                   class="px-4 py-2 text-xs font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-100/80 rounded-xl transition-all">
                    Masuk
                </a>
                <a href="{{ route('register') }}" 
                   class="px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-xs font-bold text-white rounded-xl shadow-xs transition-all">
                    Daftar Akun
                </a>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section id="beranda" class="relative overflow-hidden pt-12 pb-20 px-4 sm:px-6 lg:px-8 lg:pt-20">
        <div class="max-w-7xl mx-auto lg:grid lg:grid-cols-12 lg:gap-8 items-center">
            
            {{-- Hero Text --}}
            <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left space-y-5">
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-purple-50 border border-purple-200/60 text-purple-600 text-[10px] font-bold shadow-3xs">
                    🛡️ Sistem Perpustakaan Terintegrasi
                </span>
                <h1 class="text-3xl font-black tracking-tight text-slate-800 sm:text-4xl md:text-5xl leading-tight">
                    Akses Jutaan Ilmu Dalam <br class="hidden sm:inline">
                    <span class="text-purple-600">Satu Pusat Kontrol Digital.</span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-xl">
                    Pinjam e-book, jurnal ilmiah, dan literatur klasik secara praktis. Dikembangkan dengan manajemen hak akses pintar untuk kenyamanan membaca Anda.
                </p>

            </div>

            {{-- Hero Image / Ilustrasi Visual Kasar --}}
            <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 flex justify-center">
                <div class="relative w-full max-w-md">
                    <!-- Ornamen Samar Belakang -->
                    <div class="absolute top-4 -left-4 w-72 h-72 bg-purple-100/60 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
                    <div class="absolute -bottom-4 -right-4 w-72 h-72 bg-amber-50 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
                    
                    <!-- Box Utama dengan gaya panel admin sebelumnya -->
                    <div class="relative bg-white border border-slate-200/60 p-5 rounded-2xl shadow-xs space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <span class="font-bold text-xs text-slate-800 flex items-center gap-1.5">🌟 Rekomendasi Hari Ini</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded bg-emerald-50 border border-emerald-200/60 text-emerald-600 font-bold text-[10px]">Tersedia</span>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-20 h-28 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center font-bold text-xl text-slate-400 shadow-3xs">📘</div>
                            <div class="flex-1 space-y-2 py-1">
                                <div class="h-3.5 bg-slate-800 rounded w-5/6"></div>
                                <div class="h-2.5 bg-slate-400 rounded w-1/2"></div>
                                <div class="pt-2 flex gap-1">
                                    <span class="px-2 py-0.5 rounded bg-purple-50 border border-purple-200/40 text-purple-600 text-[9px] font-semibold">Sains</span>
                                    <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-500 text-[9px]">Teknologi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS PANEL (Gaya Ramping) --}}
    <section class="border-y border-slate-200/60 bg-white py-8 px-4 sm:px-6 lg:px-8 shadow-3xs">
        <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="space-y-0.5">
                <h3 class="text-2xl font-black text-slate-800">50K+</h3>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Koleksi Digital</p>
            </div>
            <div class="space-y-0.5">
                <h3 class="text-2xl font-black text-purple-600">{{ $totalUsers ?? '12K+' }}</h3>
                <p class="text-[10px] font-bold uppercase tracking-wider text-purple-400">Total Anggota</p>
            </div>
            <div class="space-y-0.5">
                <h3 class="text-2xl font-black text-emerald-600">98.4%</h3>
                <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-400">Ketersediaan Buku</p>
            </div>
            <div class="space-y-0.5">
                <h3 class="text-2xl font-black text-slate-800">24/7</h3>
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Pusat Kontrol Akses</p>
            </div>
        </div>
    </section>

    {{-- FOOTER CTA --}}
    <section class="bg-slate-900 text-white py-14 px-4 sm:px-6 lg:px-8 rounded-t-3xl">
        <div class="max-w-4xl mx-auto text-center space-y-5">
            <h2 class="text-2xl font-bold tracking-tight sm:text-3xl">Mulai Petualangan Literasimu Sekarang</h2>
            <p class="text-xs text-slate-400 max-w-lg mx-auto leading-relaxed">
                Buat akun perpustakaan gratis Anda dalam beberapa langkah mudah, dapatkan hak akses peminjaman penuh, dan kelola aktivitas bacamu langsung dari satu dasbor.
            </p>
            <div class="pt-2 flex justify-center gap-2.5">
                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-xs font-bold text-white rounded-xl shadow-xs transition-all">
                    Registrasi Akun Baru
                </a>
                <a href="#katalog" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-xs font-bold text-slate-300 rounded-xl transition-all">
                    Lihat Koleksi Buku
                </a>
            </div>
            <hr class="border-slate-800 my-4">
            <p class="text-[10px] text-slate-500">&copy; 2026 PustakaDigital. Dikembangkan dengan Desain Minimalis & Terstruktur.</p>
        </div>
    </section>

</body>
</html>