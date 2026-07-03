<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('title', 'Perpustakaan Digital')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    x-data="{ sidebarOpen: false }"
    class="bg-gray-100"
>

    @auth

        @include('layouts.sidebar')

        <div class="md:ml-64 min-h-screen">

            @include('layouts.topbar')

            <main class="p-6">
                @yield('content')
            </main>

        </div>

    @else

        @yield('content')

    @endauth

</body>
</html>