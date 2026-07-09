<header class="bg-white shadow px-6 py-4 border-b border-slate-100">

    <div class="flex items-center justify-between gap-4">

        {{-- Tombol Sidebar Mobile --}}
        <button @click="sidebarOpen = true"
            class="md:hidden p-1.5 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        {{-- Judul Halaman --}}
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight flex-1 min-w-0 truncate">
            @yield('page-title')
        </h1>

        {{-- Notification --}}
        <div class="relative" x-data="{ notifOpen: false }">

            <button @click="notifOpen = !notifOpen"
                class="relative w-10 h-10 rounded-full flex items-center justify-center
               hover:bg-slate-100 transition">

                {{-- Bell --}}
                <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032
                2.032 0 0118 14.158V11a6.002
                6.002 0 001-11.917V4a2
                2 0 11-4 0v-.917A6.002
                6.002 0 006 11v3.159c0
                .538-.214 1.055-.595
                1.436L4 17h5m6 0v1a3
                3 0 11-6 0v-1m6 0H9" />

                </svg>

                {{-- Badge --}}
                @if (auth()->user()->unreadNotifications->count())
                    <span
                        class="absolute -top-1 -right-1
                       min-w-5 h-5 px-1
                       bg-red-500 text-white
                       rounded-full text-[10px]
                       flex items-center justify-center font-semibold">

                        {{ auth()->user()->unreadNotifications->count() }}

                    </span>
                @endif
            </button>

            <div x-show="notifOpen" @click.outside="notifOpen = false" x-transition
                class="absolute right-0 mt-2
                w-96 bg-white rounded-xl
                border border-slate-200
                shadow-xl overflow-hidden
                z-50">

                <div class="px-5 py-4 border-b">

                    <h3 class="font-semibold text-slate-800">

                        Notifikasi

                    </h3>

                </div>

                <div class="max-h-96 overflow-y-auto">
                    @forelse(auth()->user()->notifications->take(3) as $notification)
                        <a href="{{ route('notifications.show', $notification) }}"
                            class="block px-5 py-4
                          hover:bg-slate-50
                            border-b">

                            <div class="flex gap-3">

                                <div
                                    class="w-10 h-10 rounded-full
                                  bg-blue-100
                                    flex items-center justify-center">

                                    {{ $notification->data['icon'] }}

                                </div>

                                <div class="flex-1">

                                    <p class="font-semibold text-sm">

                                        {{ $notification->data['title'] }}

                                    </p>

                                    <p class="text-sm text-slate-600 mt-1">

                                        {{ $notification->data['message'] }}

                                    </p>

                                    <p class="text-xs text-slate-400 mt-2">

                                        {{ $notification->created_at->diffForHumans() }}

                                    </p>

                                </div>

                                @if (is_null($notification->read_at))
                                    <span
                                        class="w-2 h-2
                                        rounded-full
                                      bg-blue-500
                                        mt-2">
                                    </span>
                                @endif
                            </div>
                        </a>
                    @empty

                        <div class="text-center py-8 text-slate-400">
                            Tidak ada notifikasi.
                        </div>
                    @endforelse
                </div>
                <div class="border-t">
                    <a href="#"
                        class="block text-center py-3
               text-blue-600
               hover:bg-slate-50">

                        Lihat Semua

                    </a>

                </div>
            </div>
        </div>

        {{-- User Dropdown --}}
        <div class="relative flex-shrink-0" x-data="{ open: false }">

            <button @click="open = !open" class="flex items-center gap-3.5 p-1 rounded-full group">

                <div
                    class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-inner shadow-blue-700/50">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="hidden md:block text-left">
                    <p class="text-sm font-semibold text-slate-900 group-hover:text-blue-700 transition-colors">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-blue-600 font-medium capitalize mt-0.5">
                        {{ auth()->user()->role }}
                    </p>
                </div>

            </button>

            {{-- Dropdown Menu --}}
            <div x-show="open" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" @click.outside="open = false"
                class="absolute right-0 top-full mt-2 w-52 bg-white border border-slate-200
                           rounded-xl shadow-lg overflow-hidden z-50">

                <div class="px-4 py-3 border-b border-slate-200">
                    <p class="text-xs font-semibold text-slate-900">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-[11px] text-slate-500 truncate">
                        {{ auth()->user()->nis_nip }}
                    </p>
                    <p class="text-[11px] text-slate-500 truncate">
                        {{ auth()->user()->email }}
                    </p>
                </div>

                <div class="py-1">
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-slate-700
                                  hover:bg-blue-50 hover:text-blue-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil Saya
                    </a>
                </div>

                <div class="border-t border-slate-200 py-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm
                                       text-red-500 hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>

</header>
