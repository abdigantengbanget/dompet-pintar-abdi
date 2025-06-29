<!-- resources/views/expenses/edit.blade.php (Diperbaiki) -->
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-8">
        <div class="mb-6 border-b border-slate-200 dark:border-slate-700 pb-5">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Edit Pengeluaran Rutin</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1 text-sm">Perbarui detail pengeluaran rutin Anda.</p>
        </div>

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

        <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Penting untuk form update --}}
            <div class="space-y-6">
                <!-- Nama Pengeluaran -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nama Pengeluaran</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $expense->name) }}" required
                           class="mt-1 block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <!-- Jumlah Pengeluaran -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Jumlah per Bulan (Rp)</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount', $expense->amount) }}" required
                           class="mt-1 block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end mt-8 border-t border-slate-200 dark:border-slate-700 pt-6 space-x-4">
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition">Batal</a>
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase hover:bg-indigo-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection