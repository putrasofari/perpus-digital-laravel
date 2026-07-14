@extends('layouts.app')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')

<div class="max-w-6xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="flex items-center gap-5">

            {{-- Avatar --}}
            <div
                class="w-20 h-20 rounded-full bg-blue-600
                flex items-center justify-center
                text-white text-3xl font-bold">

                {{ strtoupper(substr(auth()->user()->name,0,1)) }}

            </div>

            <div class="flex-1">

                <h2 class="text-2xl font-bold text-slate-800">
                    {{ auth()->user()->name }}
                </h2>

                <p class="text-slate-500 mt-1">
                    {{ auth()->user()->email }}
                </p>

                <div class="flex flex-wrap gap-2 mt-4">

                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">

                        {{ auth()->user()->role }}

                    </span>

                    @if(auth()->user()->is_active)

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                            Aktif
                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                            Menunggu Aktivasi
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>

    {{-- Informasi Akun --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <h3 class="text-lg font-semibold mb-5">
            Informasi Akun
        </h3>

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <p class="text-sm text-slate-500">
                    Nama Lengkap
                </p>

                <p class="font-semibold mt-1">
                    {{ auth()->user()->name }}
                </p>

            </div>

            <div>

                <p class="text-sm text-slate-500">
                    NIS / NIP
                </p>

                <p class="font-semibold mt-1">
                    {{ auth()->user()->nis_nip }}
                </p>

            </div>

            <div>

                <p class="text-sm text-slate-500">
                    Email
                </p>

                <p class="font-semibold mt-1">
                    {{ auth()->user()->email }}
                </p>

            </div>

            <div>

                <p class="text-sm text-slate-500">
                    Kelas
                </p>

                <p class="font-semibold mt-1">
                    {{ auth()->user()->kelas->kelas ?? '-' }}
                </p>

            </div>

        </div>

    </div>

    {{-- Edit Profile --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        @include('profile.partials.update-profile-information-form')

    </div>

    {{-- Password --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        @include('profile.partials.update-password-form')

    </div>

    {{-- Delete --}}
    <div class="bg-white rounded-2xl border border-red-200 shadow-sm p-6">

        @include('profile.partials.delete-user-form')

    </div>

</div>

@endsection