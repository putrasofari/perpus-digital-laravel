<x-guest-layout>
    {{-- Kita override pembungkus default Breeze menggunakan kontainer kustom kita --}}
    <div class="fixed inset-0 bg-slate-50/50 flex items-center justify-center p-4 sm:p-6 lg:p-8 antialiased selection:bg-purple-100 selection:text-purple-900">
        
        <!-- Ornamen Bulatan Samar Latar Belakang (Sama seperti Hero Section Perpustakaan) -->
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-purple-100/50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-amber-50/70 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>

        <!-- Box Utama Panel Login (Gaya Panel Kontrol Dasbor) -->
        <div class="relative w-full max-w-md bg-white border border-slate-200/60 p-6 sm:p-8 rounded-2xl shadow-xs z-10">
            
            {{-- Identitas Brand PustakaDigital --}}
            <div class="text-center mb-8 space-y-2">
                <div class="inline-flex items-center justify-center gap-2 group">
                    <span class="text-2xl">📖</span>
                    <span class="text-lg font-black tracking-tight text-slate-800">Pustaka<span class="text-purple-600 font-semibold">Digital</span></span>
                </div>
                <div class="pt-2 space-y-0.5">
                    <h2 class="text-base font-bold text-slate-800 tracking-tight">Selamat Datang Kembali</h2>
                    <p class="text-xs text-slate-500">Silakan masuk ke pusat kontrol akses Anda</p>
                </div>
            </div>

            <!-- Laravel Breeze Session Status -->
            <x-auth-session-status class="mb-4 text-xs font-semibold text-emerald-600 bg-emerald-50 border border-emerald-200/50 p-3 rounded-xl" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div class="space-y-1">
                    <label for="email" class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block">Alamat Email</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3.5 text-xs text-slate-400">🔍</span>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username"
                               placeholder="nama@email.com"
                               class="w-full text-xs text-slate-800 bg-slate-50/50 border border-slate-200 rounded-xl pl-9 pr-4 py-3 placeholder-slate-400 focus:outline-none focus:border-purple-500 focus:bg-white transition-all shadow-3xs">
                    </div>
                    @if($errors->has('email'))
                        <p class="text-[11px] font-medium text-rose-500 mt-1">⚠️ {{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div class="space-y-1">
                    <label for="password" class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block">Kata Sandi</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3.5 text-xs text-slate-400">🔒</span>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               placeholder="••••••••"
                               class="w-full text-xs text-slate-800 bg-slate-50/50 border border-slate-200 rounded-xl pl-9 pr-4 py-3 placeholder-slate-400 focus:outline-none focus:border-purple-500 focus:bg-white transition-all shadow-3xs">
                    </div>
                    @if($errors->has('password'))
                        <p class="text-[11px] font-medium text-rose-500 mt-1">⚠️ {{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-purple-600 focus:ring-purple-500/30 focus:ring-offset-0 bg-slate-50">
                        <span class="ms-2 text-xs font-medium text-slate-500">Ingat saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-xs font-semibold text-purple-600 hover:text-purple-700 transition-colors" href="{{ route('password.request') }}">
                            Lupa sandi?
                        </a>
                    @endif
                </div>

                <!-- Tombol Masuk Utama -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-slate-800 hover:bg-slate-900 text-xs font-bold text-white rounded-xl shadow-xs transition-all flex items-center justify-center gap-1.5 active:scale-[0.99]">
                        <span>Masuk ke Akun</span> →
                    </button>
                </div>

                <!-- Tautan Navigasi Halaman Register -->
                <div class="mt-6 border-t border-slate-100 pt-4 text-center">
                    <p class="text-xs text-slate-500 font-medium">
                        Belum terdaftar sebagai anggota? 
                        <a href="{{ route('register') }}" class="font-bold text-purple-600 hover:text-purple-700 hover:underline transition-colors ms-0.5">
                            Buat Akun Baru
                        </a>
                    </p>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>