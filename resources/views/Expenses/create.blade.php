<!-- resources/views/expenses/create.blade.php (Diperbaiki) -->
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
        <div class="mb-6 border-b border-gray-200 dark:border-gray-700 pb-5">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Tambah Pengeluaran Rutin</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1 text-sm">Masukkan pengeluaran yang terjadi secara periodik (misal: bulanan).</p>
        </div>

        {{-- VVV INI BAGIAN PERBAIKANNYA VVV --}}
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

        <form action="{{ route('expenses.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <!-- Nama Pengeluaran -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Pengeluaran</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Contoh: Sewa Kost, Internet"
                           class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 transition">
                </div>

                <!-- Jumlah Pengeluaran -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah per Bulan (Rp)</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}" required placeholder="Contoh: 1500000"
                           class="mt-1 block w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 transition">
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6 space-x-4">
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">Batal</a>
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase hover:bg-indigo-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection