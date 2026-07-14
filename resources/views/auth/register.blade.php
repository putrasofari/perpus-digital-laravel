<x-guest-layout>
    {{-- Membungkus penuh agar layout seimbang dengan halaman login --}}
    <div class="fixed inset-0 bg-slate-50/50 flex items-center justify-center p-4 sm:p-6 lg:p-8 overflow-y-auto antialiased selection:bg-purple-100 selection:text-purple-900">
        
        <!-- Ornamen Bulatan Samar Latar Belakang (Identik dengan Login) -->
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-purple-100/50 rounded-full mix-blend-multiply filter blur-3xl opacity-60 pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-amber-50/70 rounded-full mix-blend-multiply filter blur-3xl opacity-60 pointer-events-none"></div>

        <!-- Box Utama Panel Register (Lebih lebar dikit dibanding login karena form lebih banyak) -->
        <div class="relative w-full max-w-xl bg-white border border-slate-200/60 p-6 sm:p-8 rounded-2xl shadow-xs z-10 my-auto">
            
            {{-- Identitas Brand PustakaDigital --}}
            <div class="text-center mb-6 space-y-1">
                <div class="inline-flex items-center justify-center gap-2">
                    <span class="text-xl">📖</span>
                    <span class="text-base font-black tracking-tight text-slate-800">Pustaka<span class="text-purple-600 font-semibold">Digital</span></span>
                </div>
                <div class="pt-1.5 space-y-0.5">
                    <h2 class="text-base font-bold text-slate-800 tracking-tight">Pendaftaran Anggota Baru</h2>
                    <p class="text-xs text-slate-500">Lengkapi formulir di bawah untuk meminta hak akses peminjaman</p>
                </div>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Grid Form Layout (Dua Kolom di Layar Desktop agar Ramping) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    {{-- Nama Lengkap --}}
                    <div class="space-y-1">
                        <label for="name" class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Nama Lengkap</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-xs text-slate-400">👤</span>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Nama lengkap Anda"
                                   class="w-full text-xs text-slate-800 bg-slate-50/50 border border-slate-200 rounded-xl pl-8 pr-3 py-2.5 focus:outline-none focus:border-purple-500 focus:bg-white transition-all shadow-3xs">
                        </div>
                        @error('name')
                            <p class="text-[10px] font-medium text-rose-500 mt-0.5">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NIS --}}
                    <div class="space-y-1">
                        <label for="nis_nip" class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Nomor Induk Siswa (NIS)</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-xs text-slate-400">💳</span>
                            <input type="text" id="nis_nip" name="nis_nip" value="{{ old('nis_nip') }}" required placeholder="Contoh: 24001234"
                                   class="w-full text-xs text-slate-800 bg-slate-50/50 border border-slate-200 rounded-xl pl-8 pr-3 py-2.5 focus:outline-none focus:border-purple-500 focus:bg-white transition-all shadow-3xs">
                        </div>
                        @error('nis_nip')
                            <p class="text-[10px] font-medium text-rose-500 mt-0.5">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kelas --}}
                    <div class="space-y-1">
                        <label for="kelas_id" class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Kelas Tingkatan</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-xs text-slate-400">🏫</span>
                            <select id="kelas_id" name="kelas_id" required
                                    class="w-full text-xs text-slate-800 bg-slate-50/50 border border-slate-200 rounded-xl pl-8 pr-3 py-2.5 focus:outline-none focus:border-purple-500 focus:bg-white transition-all shadow-3xs appearance-none">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->kelas }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="absolute right-3 text-[10px] text-slate-400 pointer-events-none">▼</span>
                        </div>
                        @error('kelas_id')
                            <p class="text-[10px] font-medium text-rose-500 mt-0.5">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="space-y-1">
                        <label for="email" class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Alamat Email</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-xs text-slate-400">🔍</span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                                   class="w-full text-xs text-slate-800 bg-slate-50/50 border border-slate-200 rounded-xl pl-8 pr-3 py-2.5 focus:outline-none focus:border-purple-500 focus:bg-white transition-all shadow-3xs">
                        </div>
                        @error('email')
                            <p class="text-[10px] font-medium text-rose-500 mt-0.5">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="space-y-1">
                        <label for="password" class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Kata Sandi</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-xs text-slate-400">🔒</span>
                            <input type="password" id="password" name="password" required placeholder="Min. 8 Karakter"
                                   class="w-full text-xs text-slate-800 bg-slate-50/50 border border-slate-200 rounded-xl pl-8 pr-3 py-2.5 focus:outline-none focus:border-purple-500 focus:bg-white transition-all shadow-3xs">
                        </div>
                        @error('password')
                            <p class="text-[10px] font-medium text-rose-500 mt-0.5">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="space-y-1">
                        <label for="password_confirmation" class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Konfirmasi Sandi</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-xs text-slate-400">🛡️</span>
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi kata sandi"
                                   class="w-full text-xs text-slate-800 bg-slate-50/50 border border-slate-200 rounded-xl pl-8 pr-3 py-2.5 focus:outline-none focus:border-purple-500 focus:bg-white transition-all shadow-3xs">
                        </div>
                        @error('password_confirmation')
                            <p class="text-[10px] font-medium text-rose-500 mt-0.5">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Kotak Informasi Lembut (Gaya Pastel PustakaDigital) --}}
                <div class="rounded-xl border border-amber-200/70 bg-amber-50/50 p-3.5 mt-2">
                    <div class="flex gap-2.5 items-start">
                        <div class="text-xs pt-0.5">📢</div>
                        <div class="space-y-0.5">
                            <h3 class="font-bold text-xs text-amber-800 tracking-tight">Informasi Validasi Akun</h3>
                            <p class="text-[11px] text-amber-700/90 leading-relaxed">
                                Setelah dikirim, petugas perpustakaan akan meninjau kelayakan data Anda. Akses dasbor baca penuh dibuka segera setelah verifikasi status disetujui.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi Bawah --}}
                <div class="flex items-center justify-between pt-3 border-t border-slate-100 mt-4">
                    <a href="{{ route('login') }}" class="text-xs font-semibold text-purple-600 hover:text-purple-700 hover:underline transition-colors">
                        Sudah terdaftar? Masuk
                    </a>

                    <button type="submit"
                            class="px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs rounded-xl shadow-xs transition-all active:scale-[0.99]">
                        Kirim Pendaftaran
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-guest-layout>