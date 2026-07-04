@extends('layouts.app')

@section('title', 'Detail Data Kelas')
@section('page-title', 'Detail Data Kelas')

@section('content')

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Detail Kelas
                </h2>

                <p class="text-sm text-slate-500">
                    Informasi lengkap mengenai kelas.
                </p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.kelas.edit', $kelas) }}"
                    class="px-5 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white">

                    Edit

                </a>

                <a href="{{ route('admin.kelas.index') }}"
                    class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-100">

                    ← Kembali

                </a>
            </div>

        </div>

        {{-- Informasi Kelas --}}
        <div class="bg-white rounded-xl shadow">

            <div class="border-b px-6 py-4">

                <h3 class="text-lg font-semibold">
                    Informasi Kelas
                </h3>

            </div>

            <div class="grid md:grid-cols-3 gap-6 p-6">

                <div>
                    <p class="text-sm text-slate-500">Nama Kelas</p>

                    <p class="text-lg font-semibold">
                        {{ $kelas->kelas }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Total Akun</p>

                    <p class="text-lg font-semibold text-blue-600">
                        {{ $kelas->users_count }} Siswa
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Akun Aktif</p>

                    <p class="text-lg font-semibold text-green-600">
                        {{ $kelas->active_users_count }} Siswa
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Akun Nonaktif</p>

                    <p class="text-lg font-semibold text-red-600">
                        {{ $kelas->inactive_users_count }} Siswa
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Dibuat</p>

                    <p>
                        {{ $kelas->created_at->translatedFormat('d F Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">Terakhir Diubah</p>

                    <p>
                        {{ $kelas->updated_at->translatedFormat('d F Y') }}
                    </p>
                </div>

            </div>

            <div class="border-t p-6">

                <p class="text-sm text-slate-500 mb-2">
                    Deskripsi
                </p>

                <p class="text-slate-700 leading-relaxed">
                    {{ $kelas->description ?: '-' }}
                </p>

            </div>

        </div>

        {{-- Daftar Siswa --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="border-b px-6 py-4 flex justify-between items-center">

                <div>

                    <h3 class="text-lg font-semibold">
                        Daftar Siswa Aktif
                    </h3>

                    <p class="text-sm text-slate-500">
                        Total {{ $users->total() }} akun aktif
                    </p>

                </div>

            </div>

            <table class="w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-4 py-3 text-left w-16">No</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">NIS</th>
                        <th class="px-4 py-3 text-left">Email</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)
                        <tr class="border-t hover:bg-slate-50">

                            <td class="px-4 py-3">
                                {{ $users->firstItem() + $loop->index }}
                            </td>

                            <td class="px-4 py-3 font-medium">
                                {{ $user->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $user->nis_nip }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $user->email }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center py-8 text-slate-500">

                                Belum ada siswa aktif pada kelas ini.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <div class="flex items-center justify-between">

            <p class="text-sm text-slate-500">

                Menampilkan

                <strong>{{ $users->firstItem() ?? 0 }}</strong>

                -

                <strong>{{ $users->lastItem() ?? 0 }}</strong>

                dari

                <strong>{{ $users->total() }}</strong>

                siswa.

            </p>

            {{ $users->onEachSide(1)->links() }}

        </div>

    </div>

@endsection
