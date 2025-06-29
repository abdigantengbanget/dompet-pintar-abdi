<!-- resources/views/saving_goals/index.blade.php (Final dengan Tombol Hapus) -->
@extends('layouts.app')

@section('body_class', 'bg-slate-100 dark:bg-slate-900')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <!-- Header Estetik dengan Gradasi -->
    <header class="relative bg-gradient-to-br from-teal-400 to-indigo-600 dark:from-teal-500 dark:to-indigo-700 p-8 sm:p-12 rounded-3xl shadow-2xl overflow-hidden mb-12 text-white">
        <div class="absolute -top-12 -right-12 w-48 h-48 bg-white/10 rounded-full"></div>
        <div class="absolute -bottom-16 -left-8 w-40 h-40 bg-white/5 rounded-full"></div>
        <div class="relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tighter" style="text-shadow: 0px 2px 4px rgba(0,0,0,0.2);">
                Selamat Datang, {{ strtok(Auth::user()->name, ' ') }}!
            </h1>
            <p class="mt-3 text-lg md:text-xl text-indigo-100 max-w-2xl" style="text-shadow: 0px 1px 3px rgba(0,0,0,0.1);">
                Berikut adalah ringkasan kondisi keuanganmu bulan ini. Siap untuk mencapai tujuan finansialmu?
            </p>
        </div>
    </header>
    
    <!-- Notifikasi -->
    @if (session('success'))
        <div class="mb-6 bg-teal-50 border-l-4 border-teal-400 text-teal-800 p-4 rounded-lg shadow-sm">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if ($remaining_balance < 0)
        <div class="mb-6 bg-amber-50 border-l-4 border-amber-400 text-amber-800 p-4 rounded-lg shadow-sm">
            <p><span class="font-bold">Peringatan!</span> Pengeluaran dan komitmen tabungan Anda melebihi total pemasukan bulan ini.</p>
        </div>
    @endif

    <!-- Kartu Ringkasan Keuangan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        @php
            $summaryCards = [
                ['title' => 'Total Pemasukan', 'value' => $total_income, 'icon' => 'M12 6v12m-6-6h12', 'color' => 'text-green-500'],
                ['title' => 'Total Pengeluaran', 'value' => $total_expenses, 'icon' => 'M18 12H6', 'color' => 'text-red-500'],
                ['title' => 'Komitmen Tabungan', 'value' => $total_monthly_commitment_savings, 'icon' => 'M5 13l4 4L19 7', 'color' => 'text-indigo-500'],
                ['title' => 'Sisa Dana', 'value' => $remaining_balance, 'icon' => 'M21 12a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9', 'color' => 'text-blue-500'],
            ];
        @endphp
        @foreach ($summaryCards as $card)
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 flex items-start space-x-4">
            <div class="flex-shrink-0 h-12 w-12 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-700">
                <svg class="h-6 w-6 {{ $card['color'] }}" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}" /></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ $card['title'] }}</p>
                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100 mt-1">Rp {{ number_format($card['value'], 0, ',', '.') }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Konten Utama -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Kiri: Target Tabungan -->
        <div class="lg:col-span-2 space-y-8">
            <section>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-200">Target Tabungan</h2>
                    <a href="{{ route('saving-goals.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-teal-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-600 transition shadow-md hover:shadow-lg">+ Tambah Goal</a>
                </div>
                <div class="space-y-4">
                    @forelse ($goals as $goal)
                        @php
                            $percentage = ($goal->amount > 0) ? ($goal->current_amount / $goal->amount) * 100 : 0;
                        @endphp
                        <div class="bg-white dark:bg-slate-800 p-5 rounded-xl shadow-md flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="font-bold text-lg text-slate-800 dark:text-slate-100">{{ $goal->name }}</p>
                                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                                            Rp {{ number_format($goal->current_amount, 0, ',', '.') }} / <span class="font-medium text-teal-600 dark:text-teal-400">Rp {{ number_format($goal->amount, 0, ',', '.') }}</span>
                                        </p>
                                    </div>
                                    <div class="text-right ml-4">
                                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ number_format($percentage, 1) }}%</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Tercapai</p>
                                    </div>
                                </div>
                                
                                <div class="mt-4 w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2.5">
                                    <div class="bg-teal-500 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-700">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-slate-500 dark:text-slate-400">
                                        Sisihkan: Rp {{ number_format($goal->installments, 0, ',', '.') }}/{{ $goal->frequency == 'monthly' ? 'bln' : 'mgg' }}
                                    </span>
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('saving-goals.edit', $goal->id) }}" class="text-sm font-medium text-indigo-500 hover:text-indigo-400">Edit</a>
                                        
                                        <!-- VVV TOMBOL HAPUS DITAMBAHKAN DI SINI VVV -->
                                        <form action="{{ route('saving-goals.destroy', $goal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus goal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-400">Hapus</button>
                                        </form>

                                        @if ($goal->current_amount < $goal->amount)
                                            <form action="{{ route('saving-goals.mark-as-saved', $goal) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 bg-teal-500 text-white rounded-lg text-xs font-semibold hover:bg-teal-600 transition shadow">
                                                    ✓ Tandai Sudah Disisihkan
                                                </button>
                                            </form>
                                        @else
                                            <span class="px-3 py-1 bg-green-200 text-green-800 rounded-lg text-xs font-semibold flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                Lunas!
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white dark:bg-slate-800 rounded-xl shadow-md">
                            <p class="text-slate-500 dark:text-slate-400">Belum ada target tabungan. Ayo buat satu!</p>
                            <a href="{{ route('saving-goals.create') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-teal-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-600 transition shadow-md hover:shadow-lg">Buat Goal Pertama</a>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

        <!-- Kolom Kanan: Pengeluaran Rutin & Alokasi Dana -->
        <div class="lg:col-span-1 space-y-8">
            <section>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-200">Pengeluaran Rutin</h2>
                    <a href="{{ route('expenses.create') }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-amber-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 transition shadow-md hover:shadow-lg">+ Tambah</a>
                </div>
                <div class="bg-white dark:bg-slate-800 p-5 rounded-xl shadow-md space-y-4">
                    @forelse ($expenses as $expense)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-slate-700 dark:text-slate-200">{{ $expense->name }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Rp {{ number_format($expense->amount) }} / bulan</p>
                            </div>
                            <div class="flex space-x-3 items-center">
                                <a href="{{ route('expenses.edit', $expense->id) }}" class="text-xs font-medium text-indigo-500 hover:text-indigo-400">Edit</a>
                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengeluaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-medium text-red-500 hover:text-red-400">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8"><p class="text-slate-500 dark:text-slate-400">Belum ada data pengeluaran rutin.</p></div>
                    @endforelse
                </div>
            </section>
            
            <section>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-200 mb-4">Alokasi Dana</h2>
                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-lg">
                    @if($total_income > 0)
                        <div class="text-center mb-6">
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Pemasukan Bulan Ini</p>
                            <p class="text-3xl font-bold text-slate-900 dark:text-slate-100 mt-1">
                                Rp {{ number_format($total_income, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="h-64 w-64 mx-auto">
                            <canvas id="financialPieChart"></canvas>
                        </div>
                    @else
                        <div class="text-center py-12 px-4">
                            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h12M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-12a2.25 2.25 0 01-2.25-2.25V3.75m16.5 0v16.5h-16.5V3.75" /></svg>
                            <h3 class="mt-2 text-sm font-semibold text-slate-700 dark:text-slate-200">Data Tidak Cukup</h3>
                            <p class="mt-1 text-sm text-slate-500">Catat pemasukan untuk melihat alokasi dana.</p>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const totalIncome = {{ $total_income }};
        
        if (totalIncome > 0) {
            const ctx = document.getElementById('financialPieChart').getContext('2d');

            const remainingBalance = Math.max(0, {{ $remaining_balance }});
            const totalExpenses = {{ $total_expenses }};
            const totalSavings = {{ $total_monthly_commitment_savings }};

            const remainingPercent = ((remainingBalance / totalIncome) * 100).toFixed(1);
            const expensesPercent = ((totalExpenses / totalIncome) * 100).toFixed(1);
            const savingsPercent = ((totalSavings / totalIncome) * 100).toFixed(1);
            
            const financialPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: [
                        ` Sisa Dana (${remainingPercent}%)`,
                        ` Total Pengeluaran (${expensesPercent}%)`,
                        ` Komitmen Tabungan (${savingsPercent}%)`
                    ],
                    datasets: [{
                        label: 'Alokasi Dana Bulanan',
                        data: [remainingBalance, totalExpenses, totalSavings],
                        backgroundColor: ['#0d9488', '#f59e0b', '#4f46e5'],
                        borderColor: document.documentElement.classList.contains('dark') ? '#1e293b' : '#ffffff',
                        borderWidth: 4,
                        hoverOffset: 12,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: document.documentElement.classList.contains('dark') ? '#94a3b8' : '#64748b',
                                padding: 15,
                                font: { size: 12 },
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: (context) => {
                                    const rawValue = context.raw;
                                    const formattedValue = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(rawValue);
                                    return `${context.label.trim()}: ${formattedValue}`;
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush