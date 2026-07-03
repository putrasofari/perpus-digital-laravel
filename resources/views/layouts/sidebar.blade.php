{{-- DESKTOP SIDEBAR --}}
<aside
    class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 bg-slate-900 text-slate-100 border-r border-slate-800 shadow-xl">

    <!-- Header / Logo -->
    <div class="h-16 flex items-center px-6 border-b border-slate-800 gap-2.5">
        <div class="p-2 bg-indigo-600/10 text-indigo-400 rounded-lg">
            {{-- Ikon Box/Inventaris Simpel --}}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
        </div>
        <h1
            class="text-lg font-bold tracking-wide bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">
            E-Perpustakaan
        </h1>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 overflow-y-auto space-y-1 scrollbar-thin scrollbar-thumb-slate-800">
        @include('layouts.partials.sidebar_menu')
    </nav>

    {{-- USER CARD --}}
    <div class="p-4 border-t border-slate-800 bg-slate-950/40 backdrop-blur-sm">
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-xl p-3.5 shadow-inner">
            <div class="flex items-center gap-3">
                <!-- Avatar -->
                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-semibold text-white shadow-md shadow-indigo-500/20">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <!-- User Info -->
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-sm text-slate-200 truncate">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-indigo-400 font-medium capitalize mt-0.5 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        {{ auth()->user()->role }}
                    </p>
                </div>
            </div>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="mt-3.5">
                @csrf
                <button type="submit"
                    class="w-full group flex items-center justify-center gap-2 bg-slate-800 hover:bg-red-500/10 border border-slate-700 hover:border-red-500/20 text-slate-300 hover:text-red-400 py-2 px-3 rounded-lg text-xs font-medium transition-all duration-200">
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-red-400 transition-colors" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

</aside>

{{-- MOBILE SIDEBAR --}}
<div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 md:hidden"
    style="display: none;">

    {{-- Overlay dengan efek blur --}}
    <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" @click="sidebarOpen = false"></div>

    {{-- Drawer --}}
    <aside x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="relative w-64 h-full bg-slate-900 text-slate-100 flex flex-col shadow-2xl">

        <!-- Mobile Header -->
        <div class="h-16 flex items-center justify-between px-5 border-b border-slate-800">
            <div class="flex items-center gap-2">
                <div class="p-1.5 bg-indigo-600/10 text-indigo-400 rounded-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <h1 class="font-bold text-sm tracking-wide">
                    Inventaris Lab
                </h1>
            </div>

            <!-- Tombol Close -->
            <button @click="sidebarOpen = false"
                class="p-1.5 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Nav -->
        <nav class="flex-1 p-4 overflow-y-auto space-y-1">
            @include('layouts.partials.sidebar_menu')
        </nav>

        {{-- USER CARD --}}
        <div class="p-4 border-t border-slate-800 bg-slate-950/40 backdrop-blur-sm">
            <div class="bg-slate-800/50 border border-slate-700/50 rounded-xl p-3.5 shadow-inner">
                <div class="flex items-center gap-3">
                    <!-- Avatar -->
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-semibold text-white shadow-md shadow-indigo-500/20">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <!-- User Info -->
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-sm text-slate-200 truncate">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-indigo-400 font-medium capitalize mt-0.5 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            {{ auth()->user()->role }}
                        </p>
                    </div>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="mt-3.5">
                    @csrf
                    <button type="submit"
                        class="w-full group flex items-center justify-center gap-2 bg-slate-800 hover:bg-red-500/10 border border-slate-700 hover:border-red-500/20 text-slate-300 hover:text-red-400 py-2 px-3 rounded-lg text-xs font-medium transition-all duration-200">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-red-400 transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </aside>

</div>
