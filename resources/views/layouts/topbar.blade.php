<header class="bg-white px-6 h-20 flex items-center border-b border-slate-100 sticky top-0 z-40">

    <div class="w-full flex items-center justify-between">

        {{-- SISI KIRI: Tombol Menu Mobile & Judul Halaman --}}
        <div class="flex items-center gap-4 flex-1 min-w-0">
            <button @click="sidebarOpen = true"
                class="md:hidden p-2 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <h1 class="text-xl font-bold text-slate-900 truncate">
                @yield('page-title', 'Dashboard')
            </h1>
        </div>

        {{-- SISI KANAN: Notifikasi & Dropdown User (Presisi & Bersih) --}}
        <div class="flex items-center gap-3">

            {{-- Komponen Notifikasi --}}
            <div class="relative" x-data="{ notifOpen: false }">
                <button @click="notifOpen = !notifOpen"
                    class="w-10 h-10 rounded-full flex items-center justify-center bg-slate-50 border border-slate-100 hover:bg-slate-100 transition relative">
                    {{-- Ikon Bel Tipis Elegan --}}
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>

                    @if (auth()->user()->unreadNotifications->count())
                        <span
                            class="absolute top-2.5 right-2.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                    @endif
                </button>

                {{-- Dropdown Konten Notifikasi --}}
                <div x-show="notifOpen" @click.outside="notifOpen = false"
                    x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="absolute right-0 mt-2 w-80 bg-white rounded-2xl border-2 border-slate-300 shadow-xl overflow-hidden z-50"
                    style="display: none;">

                    {{-- Header Dropdown --}}
                    <div class="px-5 py-3.5 border-b-2 border-slate-300 bg-slate-100 flex items-center gap-2">
                        <span class="text-sm">🔔</span>
                        <h3 class="font-extrabold text-sm text-slate-950">Notifikasi Terbaru</h3>
                    </div>

                    {{-- Daftar Notifikasi --}}
                    <div class="max-h-72 overflow-y-auto divide-y-2 divide-slate-200">
                        @php
                            $notifications = auth()->user()->unreadNotifications()->latest()->take(3)->get();
                        @endphp

                        @forelse($notifications as $notification)
                            <a href="{{ route('notifications.show', $notification) }}"
                                class="block px-5 py-3.5 hover:bg-slate-100 transition duration-150">
                                <p class="text-xs font-black text-slate-950">{{ $notification->data['title'] }}</p>
                                <p class="text-xs font-bold text-slate-700 mt-1 line-clamp-2">
                                    {{ $notification->data['message'] }}</p>
                            </a>
                        @empty
                            <div class="text-center py-8 text-xs font-extrabold text-slate-600 bg-slate-50">
                                📭 Tidak ada notifikasi baru
                            </div>
                        @endforelse
                    </div>

                    {{-- Footer Dropdown: Tombol Lihat Semua Notifikasi --}}
                    <div class="border-t-2 border-slate-300 bg-slate-150">
                        <a href="{{ route('notifications.index') }}"
                            class="flex items-center justify-center gap-2 w-full px-4 py-3 text-xs font-black text-blue-700 hover:text-white bg-white hover:bg-blue-600 transition-all duration-150 uppercase tracking-wider">
                            <span>🔔</span>
                            Lihat Semua Notifikasi
                        </a>
                    </div>
                </div>
            </div>

            {{-- Pembatas Garis --}}
            <div class="h-5 w-px bg-slate-200 mx-1"></div>

            {{-- User Dropdown Menu --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center gap-2.5 p-1 rounded-full group hover:bg-slate-50 transition-all">
                    {{-- Avatar Bulat --}}
                    <div
                        class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    {{-- Nama Akun (Hanya tampil di Desktop) --}}
                    <div class="hidden md:block text-left pr-2">
                        <p class="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition-colors">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-[10px] text-slate-500 capitalize font-medium">
                            {{ auth()->user()->role }}
                        </p>
                    </div>
                    <svg class="w-4 h-4 text-slate-400 hidden md:block" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                {{-- Box Dropdown --}}
                <div x-show="open" @click.outside="open = false" x-transition
                    class="absolute right-0 mt-2 w-56 bg-white border border-slate-100 rounded-2xl shadow-xl overflow-hidden z-50"
                    style="display: none;">
                    <div class="px-4 py-3 bg-slate-50/50 border-b border-slate-100">
                        <p class="text-xs font-bold text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-500 truncate mt-0.5">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="p-1.5 space-y-0.5">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-2.5 px-3 py-2 text-xs font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-all">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            Profil Saya
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-50 rounded-xl text-left transition-all">
                                <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</header>
