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

    {{-- ================= SISWA & GURU ================= --}}
    @if (in_array(auth()->user()->role, ['guru', 'siswa']))
        <li class="mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
            Inventaris
        </li>

        <li>
            <a href="#"
                class="block px-4 py-2 rounded-lg transition
                {{ request()->routeIs('item_unit.user_index') ? $activeClass : $normalClass }}">
                Data Barang
            </a>
        </li>

        <li class="mt-6 px-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
            Peminjaman
        </li>

        <li>
            <a href="#"
                class="block px-4 py-2 rounded-lg transition
                {{ request()->routeIs('borrowings.user') ? $activeClass : $normalClass }}">
                Riwayat Peminjaman
            </a>
        </li>
    @endif

</ul>
