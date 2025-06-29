<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor utama dengan data keuangan yang sinkron.
     */
    public function index(): View
    {
        $user = Auth::user();
        $now = now(); // Simpan tanggal saat ini

        // 1. Ambil data dasar
        $goals = $user->savingGoals()->get();
        $routine_expenses = $user->expenses()->get(); // Pengeluaran rutin bulanan

        // 2. Ambil data transaksi HANYA untuk bulan dan tahun ini
        $monthly_transactions = $user->transactions()
                                     ->whereYear('transaction_date', $now->year)
                                     ->whereMonth('transaction_date', $now->month)
                                     ->get();

        // 3. Kalkulasi Total Pemasukan
        $base_income = $user->monthly_income; // Gaji/pemasukan rutin
        $additional_income = $monthly_transactions->where('type', 'pemasukan')->sum('amount');
        $total_income = $base_income + $additional_income;

        // 4. Kalkulasi Total Pengeluaran
        $total_routine_expenses = $routine_expenses->sum('amount'); // Total pengeluaran rutin
        $non_routine_expenses = $monthly_transactions->where('type', 'pengeluaran')->sum('amount');
        $total_expenses = $total_routine_expenses + $non_routine_expenses;

        // 5. Kalkulasi Komitmen Tabungan
        $total_monthly_commitment_savings = $goals->sum('installments');
        
        // 6. Kalkulasi Sisa Saldo yang Sebenarnya
        // Sisa Saldo = (Total Pemasukan) - (Total Pengeluaran) - (Komitmen Tabungan)
        $remaining_balance = $total_income - $total_expenses - $total_monthly_commitment_savings;

        // 7. Kirim semua data yang sudah sinkron ke view
        return view('saving_goals.index', [
            'goals' => $goals,
            'expenses' => $routine_expenses, // Tetap kirim ini untuk ditampilkan di list
            'total_income' => $total_income,
            'total_expenses' => $total_expenses,
            'total_monthly_commitment_savings' => $total_monthly_commitment_savings,
            'remaining_balance' => $remaining_balance,
        ]);
    }
}