<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Perpustakaan')</title>

    {{-- Pemanggilan Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{ sidebarOpen: false }" class="h-full bg-[#f8fafc] text-slate-800 antialiased">

    @auth
        {{-- Komponen Sidebar --}}
        @include('layouts.sidebar')

        {{-- Wrapper Utama Konten (Bergeser otomatis di desktop) --}}
        <div class="md:ml-64 flex flex-col min-h-screen">
            
            {{-- Komponen Topbar --}}
            @include('layouts.topbar')

            {{-- Area Konten Utama Halaman --}}
            <main class="flex-1 p-4 md:p-8">
                @yield('content')
            </main>

        </div>
    @else
        {{-- Kondisi jika user belum login (Halaman Login/Register) --}}
        <div class="min-h-screen">
            @yield('content')
        </div>
    @endauth

</body>
</html>