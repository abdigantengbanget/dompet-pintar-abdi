<!-- resources/views/profile/edit.blade.php (Diperbaiki) -->
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-6 sm:p-8">
        <div class="mb-6 border-b border-slate-200 dark:border-slate-700 pb-5">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-slate-100">
                Profil Akun
            </h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                Perbarui data diri dan informasi keuangan Anda.
            </p>
        </div>

        @if (session('success'))
            <div class="mb-5 bg-teal-50 border-l-4 border-teal-500 text-teal-700 p-4 rounded-lg" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                <p class="font-bold">Oops! Terjadi kesalahan:</p>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="space-y-6">
                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                           class="mt-1 block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Alamat Email</label>
                    <input type="email" id="email" value="{{ $user->email }}" readonly disabled 
                           class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm bg-slate-100 dark:bg-slate-900/50 dark:border-slate-700 cursor-not-allowed">
                    <p class="text-xs text-slate-500 mt-1">Email tidak dapat diubah.</p>
                </div>

                <!-- Pekerjaan -->
                <div>
                    <label for="job" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Pekerjaan</label>
                    <input type="text" name="job" id="job" value="{{ old('job', $user->job) }}" required 
                           class="mt-1 block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <!-- Penghasilan -->
                <div>
                    <label for="monthly_income" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Penghasilan Bulanan (Rp)</label>
                    <input type="number" name="monthly_income" id="monthly_income" value="{{ old('monthly_income', $user->monthly_income) }}" required 
                           class="mt-1 block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>
            </div>

            <div class="flex justify-end mt-8 border-t border-slate-200 dark:border-slate-700 pt-6">
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection