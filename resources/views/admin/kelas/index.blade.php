@extends('layouts.app')

@section('title', 'Data Kelas')
@section('page-title', 'Data Kelas')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Data Kelas
            </h2>

            <p class="text-sm text-slate-500">
                Kelola data kelas yang tersedia di perpustakaan.
            </p>
        </div>

        <a href="{{ route('admin.kelas.create') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">

            + Tambah Kelas

        </a>

    </div>

    {{-- Search --}}
    <div class="bg-white rounded-xl shadow p-5">

        <form method="GET">

            <div class="flex flex-col md:flex-row gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama kelas..."
                    class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500">

                <button
                    class="px-5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                    Cari

                </button>

            </div>

        </form>

    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr class="text-left text-sm text-slate-700">

                    <th class="px-4 py-3 w-20">No</th>
                    <th class="px-4 py-3">Nama Kelas</th>
                    <th class="px-4 py-3 text-center">Akun Aktif</th>
                    <th class="px-4 py-3">Dibuat</th>
                    <th class="px-4 py-3 text-center w-64">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse ($kelas as $k)

                    <tr class="border-t hover:bg-slate-50">

                        <td class="px-4 py-3">
                            {{ $kelas->firstItem() + $loop->index }}
                        </td>

                        <td class="px-4 py-3 font-medium">
                            {{ $k->kelas }}
                        </td>

                        <td class="px-4 py-3 text-center">

                            <span class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">

                                {{ $k->active_users_count ?? 0 }} Siswa

                            </span>

                        </td>

                        <td class="px-4 py-3 text-slate-500">
                            {{ $k->created_at->format('d M Y') }}
                        </td>

                        <td class="px-4 py-3">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('admin.kelas.show', $k) }}"
                                    class="px-3 py-1 rounded bg-sky-500 hover:bg-sky-600 text-white">

                                    Detail

                                </a>

                                <a href="{{ route('admin.kelas.edit', $k) }}"
                                    class="px-3 py-1 rounded bg-amber-500 hover:bg-amber-600 text-white">

                                    Edit

                                </a>

                                <form
                                    action="{{ route('admin.kelas.destroy', $k) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus kelas ini?')"
                                        class="px-3 py-1 rounded bg-red-600 hover:bg-red-700 text-white">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="py-10 text-center text-slate-500">

                            Belum ada data kelas.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <p class="text-sm text-slate-500">

            Menampilkan

            <strong>{{ $kelas->firstItem() ?? 0 }}</strong>

            -

            <strong>{{ $kelas->lastItem() ?? 0 }}</strong>

            dari

            <strong>{{ $kelas->total() }}</strong>

            kelas.

        </p>

        {{ $kelas->onEachSide(1)->links() }}

    </div>

</div>

@endsection