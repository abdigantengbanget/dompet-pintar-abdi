<?php
// app/Http/Controllers/ExpenseController.php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    // Method index tidak ada, karena ditampilkan di dasbor. Ini sudah benar.

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $request->user()->expenses()->create($validated);

        // VVV INI BAGIAN YANG DIPERBAIKI VVV
        return redirect()->route('dashboard')->with('success', 'Pengeluaran rutin berhasil ditambahkan!');
    }

    public function edit(Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $expense->update($validated);

        // VVV PERBAIKI JUGA DI SINI VVV
        return redirect()->route('dashboard')->with('success', 'Pengeluaran rutin berhasil diperbarui!');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }
        $expense->delete();

        // VVV PERBAIKI JUGA DI SINI VVV
        return redirect()->route('dashboard')->with('success', 'Pengeluaran rutin berhasil dihapus!');
    }
}