<!-- resources/views/transactions/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-8">
        <div class="mb-6 border-b border-slate-200 dark:border-slate-700 pb-5">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Edit Transaksi</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Perbarui detail transaksi Anda.</p>
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

        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Penting untuk form update --}}

            <div class="space-y-6">
                <!-- Keterangan -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Keterangan</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $transaction->name) }}" required
                           class="mt-1 block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <!-- Jumlah -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Jumlah (Rp)</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount', $transaction->amount) }}" required
                           class="mt-1 block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="transaction_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tanggal Transaksi</label>
                    <input type="date" name="transaction_date" id="transaction_date" value="{{ old('transaction_date', \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d')) }}" required
                           class="mt-1 block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <!-- Tipe Transaksi -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Jenis Transaksi</label>
                    <div class="mt-2 flex items-center space-x-6">
                        <label class="inline-flex items-center">
                            <input type="radio" name="type" value="pemasukan" class="text-teal-600 border-slate-300" {{ old('type', $transaction->type) == 'pemasukan' ? 'checked' : '' }}>
                            <span class="ml-2 text-slate-700 dark:text-slate-300">Pemasukan</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="type" value="pengeluaran" class="text-red-600 border-slate-300" {{ old('type', $transaction->type) == 'pengeluaran' ? 'checked' : '' }}>
                            <span class="ml-2 text-slate-700 dark:text-slate-300">Pengeluaran</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end mt-8 border-t border-slate-200 dark:border-slate-700 pt-6 space-x-4">
                <a href="{{ route('transactions.index') }}" class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition">Batal</a>
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase hover:bg-indigo-700 transition">
                    Update Transaksi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection