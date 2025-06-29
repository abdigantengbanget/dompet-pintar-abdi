<!-- resources/views/profile/setup.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 sm:p-8">
        <div class="mb-6 border-b border-gray-200 dark:border-gray-700 pb-5">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">
                Lengkapi Profil Anda
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Sebelum melanjutkan, mohon lengkapi data diri Anda untuk pengalaman yang lebih baik.
            </p>
        </div>

        {{-- Penanganan Error --}}
        @if ($errors->any())
            <div class="mb-5 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg" role="alert">
                <p class="font-bold">Oops! Terjadi kesalahan.</p>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                {{-- Nama Lengkap --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required 
                               class="block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 transition">
                    </div>
                </div>

                {{-- Pekerjaan --}}
                <div>
                    <label for="job" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pekerjaan</label>
                    <div class="mt-1">
                        <input type="text" name="job" id="job" value="{{ old('job') }}" required placeholder="Contoh: Web Developer"
                               class="block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 transition">
                    </div>
                </div>

                {{-- Penghasilan Bulanan --}}
                <div>
                    <label for="monthly_income" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penghasilan Bulanan (Rp)</label>
                    <div class="mt-1">
                        <input type="number" name="monthly_income" id="monthly_income" value="{{ old('monthly_income') }}" required placeholder="Contoh: 5000000"
                               class="block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 transition">
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                    Simpan & Lanjutkan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection