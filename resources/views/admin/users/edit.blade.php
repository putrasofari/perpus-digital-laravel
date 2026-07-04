@extends('layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

        {{-- HEADER FORM --}}
        <div class="border-b border-slate-100 px-6 py-5 bg-slate-50/50">
            <h1 class="text-xl font-bold text-slate-900 tracking-tight">
                Edit Profil Pengguna
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Ubah informasi akun, hak akses, atau perbarui kata sandi pengguna secara berkala.
            </p>
        </div>

        {{-- BODY FORM --}}
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- NAMA LENGKAP --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 placeholder-slate-400 transition-all"
                        placeholder="Contoh: Budi Santoso, S.Pd.">
                    @error('name')
                        <p class="text-rose-600 text-xs font-semibold mt-1 flex items-center gap-1">
                            <span class="w-1 h-1 rounded-full bg-rose-600"></span> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500">
                        Alamat Email
                    </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 placeholder-slate-400 transition-all"
                        placeholder="budisantoso@sekolah.sch.id">
                    @error('email')
                        <p class="text-rose-600 text-xs font-semibold mt-1 flex items-center gap-1">
                            <span class="w-1 h-1 rounded-full bg-rose-600"></span> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- NIS / NIP --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500">
                        Nomor Induk (NIS / NIP)
                    </label>
                    <input type="text" name="nis_nip" value="{{ old('nis_nip', $user->nis_nip) }}" 
                        placeholder="Masukkan NIP atau NIS pengguna"
                        class="w-full px-4 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 placeholder-slate-400 transition-all">
                    @error('nis_nip')
                        <p class="text-rose-600 text-xs font-semibold mt-1 flex items-center gap-1">
                            <span class="w-1 h-1 rounded-full bg-rose-600"></span> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- ROLE --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500">
                        Hak Akses (Role)
                    </label>
                    <select name="role"
                        class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700">
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin (Pusat Kontrol)</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Pengguna (Pengunjung)</option>
                    </select>
                    @error('role')
                        <p class="text-rose-600 text-xs font-semibold mt-1 flex items-center gap-1">
                            <span class="w-1 h-1 rounded-full bg-rose-600"></span> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            {{-- ALERT INFO PASSWORD --}}
            <div class="bg-blue-50 border border-blue-200/60 rounded-xl p-3.5 flex gap-2.5 items-start">
                <svg class="w-4 h-4 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-xs text-blue-800 leading-relaxed">
                    <span class="font-bold">Tips Keamanan:</span> Biarkan kolom password di bawah ini <span class="font-bold">kosong</span> jika pengguna tidak ingin mengganti kata sandi lamanya.
                </p>
            </div>

            {{-- KATA SANDI BARU (Dua Kolom) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500">
                        Kata Sandi Baru
                    </label>
                    <input type="password" name="password" placeholder="Isi hanya jika ingin ganti sandi"
                        class="w-full px-4 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 placeholder-slate-400 transition-all">
                    @error('password')
                        <p class="text-rose-600 text-xs font-semibold mt-1 flex items-center gap-1">
                            <span class="w-1 h-1 rounded-full bg-rose-600"></span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold uppercase tracking-wider text-slate-500">
                        Konfirmasi Kata Sandi Baru
                    </label>
                    <input type="password" name="password_confirmation" placeholder="Ketik ulang kata sandi baru"
                        class="w-full px-4 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 placeholder-slate-400 transition-all">
                </div>
            </div>

            {{-- STATUS OPERASIONAL --}}
            <div class="space-y-1.5">
                <label class="text-xs font-bold uppercase tracking-wider text-slate-500">
                    Status Aktivasi Akun
                </label>
                <select name="is_active"
                    class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all text-slate-700">
                    <option value="1" {{ old('is_active', $user->is_active) == '1' ? 'selected' : '' }}>Aktif (Diberikan Akses Masuk)</option>
                    <option value="0" {{ old('is_active', $user->is_active) == '0' ? 'selected' : '' }}>Nonaktif (Tangguhkan Sementara)</option>
                </select>
            </div>

            {{-- FOOTER / NAVIGASI BUTTONS --}}
            <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-100 mt-6">
                <a href="{{ route('admin.users.index') }}"
                    class="px-5 py-2 text-sm font-semibold rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors text-center">
                    Batal
                </a>

                <button type="submit" 
                    class="px-5 py-2 text-sm font-semibold rounded-xl bg-blue-600 hover:bg-blue-700 text-white shadow-sm shadow-blue-500/10 transition-colors">
                    Perbarui Data User
                </button>
            </div>

        </form>

    </div>
</div>
@endsection