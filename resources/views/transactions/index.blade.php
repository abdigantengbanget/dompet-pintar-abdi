<!-- resources/views/transactions/index.blade.php (Final dengan Header Estetik) -->
@extends('layouts.app')

@section('body_class', 'bg-slate-100 dark:bg-slate-900')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <!-- Header Estetik dengan Gradasi -->
    <header class="relative bg-gradient-to-br from-indigo-600 to-sky-500 dark:from-indigo-700 dark:to-sky-600 p-8 sm:p-12 rounded-3xl shadow-2xl overflow-hidden mb-12 text-white">
        <!-- Elemen Dekoratif: Lingkaran di Latar Belakang -->
        <div class="absolute -top-4 -right-16 w-48 h-48 bg-white/10 rounded-full opacity-50"></div>
        <div class="absolute -bottom-24 -left-8 w-40 h-40 bg-white/5 rounded-full"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tighter" style="text-shadow: 0px 2px 4px rgba(0,0,0,0.2);">
                    Riwayat Transaksi
                </h1>
                <p class="mt-3 text-lg md:text-xl text-sky-100 max-w-2xl" style="text-shadow: 0px 1px 3px rgba(0,0,0,0.1);">
                    Semua catatan pemasukan dan pengeluaranmu ada di sini.
                </p>
            </div>
            
            <!-- Tombol Aksi -->
            <div class="flex-shrink-0 flex items-center space-x-3">
                <a href="{{ route('transactions.create_income') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-teal-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition shadow-lg hover:shadow-xl">
                    + Pemasukan
                </a>
                <a href="{{ route('transactions.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-amber-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition shadow-lg hover:shadow-xl">
                    - Pengeluaran
                </a>
            </div>
        </div>
    </header>
    
    <!-- Notifikasi Sukses -->
    @if (session('success'))
        <div class="mb-6 bg-teal-50 border-l-4 border-teal-400 text-teal-800 p-4 rounded-lg shadow-sm">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Tabel Transaksi dengan Desain Baru -->
    <div class="bg-white dark:bg-slate-800 shadow-xl rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 dark:text-slate-300 uppercase tracking-wider">
                            Keterangan
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 dark:text-slate-300 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-500 dark:text-slate-300 uppercase tracking-wider">
                            Jumlah
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse ($transactions as $transaction)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full 
                                        @if ($transaction->type == 'pemasukan') bg-green-100 dark:bg-green-900/50 
                                        @else bg-red-100 dark:bg-red-900/50 @endif">
                                        
                                        @if ($transaction->type == 'pemasukan')
                                            <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        @else
                                            <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $transaction->name }}</div>
                                        <div class="text-sm text-slate-500 dark:text-slate-400 capitalize">{{ $transaction->type }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                {{ \Carbon\Carbon::parse($transaction->transaction_date)->isoFormat('D MMMM YYYY') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold 
                                @if ($transaction->type == 'pemasukan') text-green-600 dark:text-green-400 
                                @else text-red-600 dark:text-red-400 @endif">
                                Rp {{ number_format($transaction->amount) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-4">
                                <a href="{{ route('transactions.edit', $transaction) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</a>
                                <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-24 text-center">
                                <h3 class="text-lg font-semibold text-slate-700 dark:text-slate-200">Belum Ada Transaksi</h3>
                                <p class="text-slate-500 dark:text-slate-400 mt-1">Mulai catat pemasukan dan pengeluaranmu sekarang.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        @if ($transactions->hasPages())
            <div class="p-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-700">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</div>
@endsection