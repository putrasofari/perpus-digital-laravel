@php
    // Kelas aktif: Latar belakang biru muda lembut dengan teks dan ikon biru tua kontras tinggi
    $activeClass =
        'flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold bg-blue-50 text-blue-600 shadow-sm transition-all duration-150';

    // Kelas normal: Teks abu-abu gelap kontras, hover berubah menjadi slate gelap (tidak samar)
    $normalClass =
        'flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-all duration-150';

    // Kelas ikon bawaan (bisa berubah dinamis mengikuti status aktif)
    $iconActive = 'text-blue-600';
    $iconNormal = 'text-slate-400 group-hover:text-slate-600';
@endphp

<ul class="space-y-1.5">

    {{-- ================= ADMIN MENU ================= --}}
    @if (auth()->user()->role === 'admin')
        {{-- DASHBOARD --}}
        <li>
            @php $isActive = request()->routeIs('admin.dashboard'); @endphp
            <a href="{{ route('admin.dashboard') }}" class="group {{ $isActive ? $activeClass : $normalClass }}">
                <svg class="w-5 h-5 {{ $isActive ? $iconActive : $iconNormal }}" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                </svg>
                Dashboard
            </a>
        </li>

        <li class="mt-6 px-4 text-[11px] font-bold uppercase tracking-wider text-slate-400">
            Master Data
        </li>

        {{-- DATA BUKU --}}
        <li>
            @php $isActive = request()->routeIs('admin.books.*'); @endphp
            <a href="{{ route('admin.books.index') }}" class="group {{ $isActive ? $activeClass : $normalClass }}">
                <svg class="w-5 h-5 {{ $isActive ? $iconActive : $iconNormal }}" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
                Data Buku
            </a>
        </li>

        {{-- DATA KATEGORI --}}
        <li>
            @php $isActive = request()->routeIs('admin.categories.*'); @endphp
            <a href="{{ route('admin.categories.index') }}" class="group {{ $isActive ? $activeClass : $normalClass }}">
                <svg class="w-5 h-5 {{ $isActive ? $iconActive : $iconNormal }}" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l6.499 6.499c.404.404.935.61 1.462.61.527 0 1.058-.206 1.462-.61l4.318-4.318c.404-.404.61-.935.61-1.462 0-.527-.206-1.058-.61-1.462L11.16 3.659A2.25 2.25 0 009.568 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                </svg>
                Data Kategori
            </a>
        </li>

        {{-- DATA KELAS --}}
        <li>
            @php $isActive = request()->routeIs('admin.kelas.*'); @endphp
            <a href="{{ route('admin.kelas.index') }}" class="group {{ $isActive ? $activeClass : $normalClass }}">
                <svg class="w-5 h-5 {{ $isActive ? $iconActive : $iconNormal }}" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.62 48.62 0 0112 20.904a48.62 48.62 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a48.47 48.47 0 016.638-3.414m-6.638 3.414A49.415 49.415 0 0012 11.25c1.697 0 3.359-.086 4.992-.253m.002 0a48.47 48.47 0 006.638-3.414m-6.638 3.414c-.21 1.964-.326 3.954-.346 5.962m-9.96-11.964L12 1.5l6.638 3.164m-13.275 0L12 5.625l6.638-2.961m0 0L21 6.75m0 0l-1.35 4.725" />
                </svg>
                Data Kelas
            </a>
        </li>

        <li class="mt-6 px-4 text-[11px] font-bold uppercase tracking-wider text-slate-400">
            Laporan
        </li>

        {{-- LAPORAN PEMINJAMAN --}}
        <li>
            @php $isActive = request()->routeIs('admin.borrowings.*'); @endphp
            <a href="{{ route('admin.borrowings.index') }}"
                class="group {{ $isActive ? $activeClass : $normalClass }}">
                <svg class="w-5 h-5 {{ $isActive ? $iconActive : $iconNormal }}" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                Laporan Peminjaman
            </a>
        </li>

        {{-- LAPORAN KRITIK & SARAN --}}
        <li>
            @php $isActive = request()->routeIs('admin.feedbacks.*'); @endphp
            <a href="{{ route('admin.feedbacks.index') }}"
                class="group {{ $isActive ? $activeClass : $normalClass }}">
                <svg class="w-5 h-5 {{ $isActive ? $iconActive : $iconNormal }}" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.255-3.353c.195-.29.516-.475.866-.501 1.152-.086 2.294-.213 3.422-.379Q20.75 16.5 20.75 14.76V6.16c0-1.601-1.123-2.995-2.707-3.228A48 48 0 0012 2.625c-2.106 0-4.156.144-6.168.423A3.001 3.001 0 003.25 6.16z" />
                </svg>
                Laporan Kritik & Saran
            </a>
        </li>

        <li class="mt-6 px-4 text-[11px] font-bold uppercase tracking-wider text-slate-400">
            Sistem
        </li>

        {{-- MANAJEMEN USER --}}
        <li>
            @php $isActive = request()->routeIs('admin.users.*'); @endphp
            <a href="{{ route('admin.users.index') }}" class="group {{ $isActive ? $activeClass : $normalClass }}">
                <svg class="w-5 h-5 {{ $isActive ? $iconActive : $iconNormal }}" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-2.533-3.076c-2.227-.479-4.584-.479-6.812 0a4.125 4.125 0 00-2.533 3.076 9.354 9.354 0 004.122.952 9.38 9.38 0 002.625-.372zm0-5.128A3.75 3.75 0 1015 6.5a3.75 3.75 0 000 7.5zm-6 3.696c-1.765-.468-3.596-.468-5.362 0A3.001 3.001 0 001.5 19.498v.5c0 .354.236.627.568.61a22.211 22.211 0 0110.864-1.924 13.914 13.914 0 00-2.932-2.115zM12 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Manajemen User
            </a>
        </li>
    @endif

    {{-- ================= USER MENU ================= --}}
    @if (in_array(auth()->user()->role, ['user']))
        <li class="mt-6 px-4 text-[11px] font-bold uppercase tracking-wider text-slate-400">
            Katalog
        </li>

        {{-- KOLEKSI KATALOG BUKU --}}
        <li>
            @php $isActive = request()->routeIs('user.catalogs.*'); @endphp
            <a href="{{ route('user.catalogs.index') }}" class="group {{ $isActive ? $activeClass : $normalClass }}">
                <svg class="w-5 h-5 {{ $isActive ? $iconActive : $iconNormal }}" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
                Koleksi Katalog Buku
            </a>
        </li>

        <li class="mt-6 px-4 text-[11px] font-bold uppercase tracking-wider text-slate-400">
            Peminjaman
        </li>

        {{-- RIWAYAT PEMINJAMAN --}}
        <li>
            @php $isActive = request()->routeIs('borrowings.user') || request()->routeIs('user.borrowings.index'); @endphp
            <a href="{{ route('user.borrowings.index') }}"
                class="group {{ $isActive ? $activeClass : $normalClass }}">
                <svg class="w-5 h-5 {{ $isActive ? $iconActive : $iconNormal }}" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Riwayat Peminjaman
            </a>
        </li>

        <li class="mt-6 px-4 text-[11px] font-bold uppercase tracking-wider text-slate-400">
            Lainnya
        </li>

        {{-- LAPORAN KRITIK & SARAN USER --}}
        <li>
            @php $isActive = request()->routeIs('user.feedbacks.*'); @endphp
            <a href="{{ route('user.feedbacks.index') }}"
                class="group {{ $isActive ? $activeClass : $normalClass }}">
                <svg class="w-5 h-5 {{ $isActive ? $iconActive : $iconNormal }}" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.255-3.353c.195-.29.516-.475.866-.501 1.152-.086 2.294-.213 3.422-.379Q20.75 16.5 20.75 14.76V6.16c0-1.601-1.123-2.995-2.707-3.228A48 48 0 0012 2.625c-2.106 0-4.156.144-6.168.423A3.001 3.001 0 003.25 6.16z" />
                </svg>
                Laporan Kritik & Saran
            </a>
        </li>
    @endif

</ul>
