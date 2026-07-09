@php
    $activeClass = 'bg-blue-600 text-white';
    $normalClass = 'text-gray-300 hover:bg-gray-700 hover:text-white';
@endphp

<ul class="space-y-2">

    {{-- ================= ADMIN ================= --}}
    @if (auth()->user()->role === 'admin')
        {{-- DASHBOARD --}}
        <li>
            <a href={{ route('admin.dashboard') }}
                class="block px-4 py-2 rounded-lg transition
            {{ request()->routeIs('admin.dashboard') ? $activeClass : $normalClass }}">
                Dashboard
            </a>
        </li>

        <li class="mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
            Master Data
        </li>

        <li>
            <a href={{ route('admin.books.index') }}
                class="block px-4 py-2 rounded-lg transition
            {{ request()->routeIs('admin.books.*') ? $activeClass : $normalClass }}">
                Data Buku
            </a>
        </li>

        <li>
            <a href={{ route('admin.categories.index') }}
                class="block px-4 py-2 rounded-lg transition
            {{ request()->routeIs('admin.categories.*') ? $activeClass : $normalClass }}">
                Data Kategori
            </a>
        </li>

        <li>
            <a href={{ route('admin.kelas.index') }}
                class="block px-4 py-2 rounded-lg transition
            {{ request()->routeIs('admin.kelas.*') ? $activeClass : $normalClass }}">
                Data Kelas
            </a>
        </li>

        {{-- LAPORAN --}}
        <li class="mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
            Laporan
        </li>

        <li>
            <a href={{ route('admin.borrowings.index') }}
                class="block px-4 py-2 rounded-lg transition
            {{ request()->routeIs('admin.borrowings.*') ? $activeClass : $normalClass }}">
                Laporan Peminjaman
            </a>
        </li>

        {{-- SISTEM --}}
        <li class="mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
            Sistem
        </li>

        <li>
            <a href={{ route('admin.users.index') }}
                class="block px-4 py-2 rounded-lg transition
            {{ request()->routeIs('admin.users.*') ? $activeClass : $normalClass }}">
                Manajemen User
            </a>
        </li>
    @endif

    {{-- ================= USER ================= --}}
    @if (in_array(auth()->user()->role, ['user']))
        {{-- DASHBOARD --}}
        <li>
            <a href={{ route('user.dashboard') }}
                class="block px-4 py-2 rounded-lg transition
            {{ request()->routeIs('user.dashboard') ? $activeClass : $normalClass }}">
                Dashboard
            </a>
        </li>

        <li class="mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
            Katalog
        </li>

        <li>
            <a href={{ route('user.catalogs.index')}}
                class="block px-4 py-2 rounded-lg transition
                {{ request()->routeIs('user.catalogs.*') ? $activeClass : $normalClass }}">
                Koleksi Katalog Buku
            </a>
        </li>

        <li class="mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
            Peminjaman
        </li>

        <li>
            <a href={{route('user.borrowings.index')}}
                class="block px-4 py-2 rounded-lg transition
                {{ request()->routeIs('borrowings.user') ? $activeClass : $normalClass }}">
                Riwayat Peminjaman
            </a>
        </li>
    @endif

</ul>
