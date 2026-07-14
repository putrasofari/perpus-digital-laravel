{{-- DESKTOP SIDEBAR --}}
<aside class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 bg-white border-r border-slate-200/80 shadow-sm">

    <!-- Header / Unique Logo E-Perpustakaan -->
    <div class="h-20 flex items-center px-6 border-b border-slate-100 gap-3">
        <div class="p-2.5 bg-blue-600 text-white rounded-xl shadow-md shadow-blue-500/20">
            {{-- Ikon Unik: Tumpukan Buku Membentuk Huruf E --}}
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
        </div>
        <h1 class="text-xl font-extrabold tracking-tight text-slate-900">
            E-<span class="text-blue-600">Perpustakaan</span>
        </h1>
    </div>

    <!-- Navigation Menu (Memanggil File sidebar_menu) -->
    <nav class="flex-1 px-4 py-6 overflow-y-auto">
        @include('layouts.partials.sidebar_menu')
    </nav>

    {{-- TOMBOL LOGOUT UTAMA --}}
    <div class="p-4 border-t border-slate-100">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-red-600 hover:bg-red-50 rounded-xl transition-all duration-150">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                Keluar Aplikasi
            </button>
        </form>
    </div>
</aside>


{{-- MOBILE SIDEBAR (Drawer Luas & Responsif) --}}
<div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 md:hidden" style="display: none;">
    
    {{-- Overlay Gelap --}}
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="sidebarOpen = false"></div>

    {{-- Drawer Panel --}}
    <aside x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative w-72 h-full bg-white flex flex-col shadow-2xl">

        <!-- Mobile Header -->
        <div class="h-20 flex items-center justify-between px-6 border-b border-slate-100">
            <div class="flex items-center gap-2.5">
                <div class="p-2 bg-blue-600 text-white rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <h1 class="font-extrabold text-slate-900 text-base tracking-tight">
                    E-<span class="text-blue-600">Perpustakaan</span>
                </h1>
            </div>

            <!-- Tombol Close -->
            <button @click="sidebarOpen = false" class="p-2 rounded-xl text-slate-400 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Nav Menu (Memanggil File sidebar_menu) -->
        <nav class="flex-1 p-4 overflow-y-auto">
            @include('layouts.partials.sidebar_menu')
        </nav>

        {{-- Mobile Logout --}}
        <div class="p-4 border-t border-slate-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-red-600 hover:bg-red-50 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    Keluar Aplikasi
                </button>
            </form>
        </div>
    </aside>
</div>