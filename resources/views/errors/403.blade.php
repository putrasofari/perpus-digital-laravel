{{-- resources/views/errors/403.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>403 — Akses Ditolak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-900 text-white flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-8xl font-bold text-indigo-500">403</h1>
        <p class="text-2xl mt-4">Akses Ditolak</p>
        <p class="text-slate-400 mt-2">Kamu tidak memiliki izin untuk mengakses halaman ini.</p>
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
</body>

</html>
