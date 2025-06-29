<!-- resources/views/transactions/create_income.blade.php (KODE FINAL) -->
@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-8">
        <div class="mb-6 border-b border-slate-200 dark:border-slate-700 pb-5">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Tambah Pemasukan Tambahan</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Catat pendapatan di luar gaji rutin Anda.</p>
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

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            
            {{-- Ini adalah kuncinya: kita mengirim tipe 'pemasukan' secara tersembunyi --}}
            <input type="hidden" name="type" value="pemasukan">

            <div class="space-y-6">
                <!-- Keterangan -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Sumber Pemasukan</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Contoh: Proyek Freelance, Bonus, Hadiah"
                           class="mt-1 block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <!-- Jumlah -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Jumlah (Rp)</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}" required placeholder="Contoh: 1500000"
                           class="mt-1 block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="transaction_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Tanggal Diterima</label>
                    <input type="date" name="transaction_date" id="transaction_date" value="{{ old('transaction_date', now()->format('Y-m-d')) }}" required
                           class="mt-1 block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end mt-8 border-t border-slate-200 dark:border-slate-700 pt-6 space-x-4">
                <a href="{{ route('transactions.index') }}" class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition">Batal</a>
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-teal-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase hover:bg-teal-700 transition">
                    Simpan Pemasukan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection