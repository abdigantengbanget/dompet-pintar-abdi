<?php
// app/Http/Controllers/SavingGoalController.php (Versi Final dengan Logika Menyisihkan Dana)

namespace App\Http\Controllers;

use App\Models\SavingGoal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class SavingGoalController extends Controller
{
    public function create()
    {
        return view('saving_goals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1000',
            'due_date' => 'required|date|after:today',
            'frequency' => 'required|in:monthly,weekly',
        ]);

        $request->user()->savingGoals()->create([
            'name' => $validated['name'],
            'amount' => $validated['amount'],
            'due_date' => $validated['due_date'],
            'frequency' => $validated['frequency'],
            'installments' => $this->calculateInstallments(
                $validated['amount'],
                $validated['due_date'],
                $validated['frequency']
            ),
        ]);

        return redirect()->route('dashboard')->with('success', 'Target tabungan berhasil ditambahkan!');
    }

    public function edit(SavingGoal $savingGoal)
    {
        if ($savingGoal->user_id !== auth()->id()) {
            abort(403, 'Aksi tidak diizinkan.');
        }
        return view('saving_goals.edit', compact('savingGoal'));
    }

    public function update(Request $request, SavingGoal $savingGoal)
    {
        if ($savingGoal->user_id !== auth()->id()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1000',
            'due_date' => 'required|date|after:today',
            'frequency' => 'required|in:monthly,weekly',
        ]);

        $validated['installments'] = $this->calculateInstallments(
            $validated['amount'],
            $validated['due_date'],
            $validated['frequency']
        );

        $savingGoal->update($validated);

        return redirect()->route('dashboard')->with('success', 'Target tabungan berhasil diperbarui!');
    }

    public function destroy(SavingGoal $savingGoal)
    {
        if ($savingGoal->user_id !== auth()->id()) {
            abort(403, 'Aksi tidak diizinkan.');
        }
        $savingGoal->delete();
        return redirect()->route('dashboard')->with('success', 'Target tabungan berhasil dihapus!');
    }

    // VVV INI METHOD BARU YANG DITAMBAHKAN VVV
    /**
     * Menandai dana cicilan telah disisihkan.
     */
    public function markAsSaved(SavingGoal $savingGoal): RedirectResponse
    {
        if ($savingGoal->user_id !== auth()->id()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $amountToSave = $savingGoal->installments;
        $newAmount = $savingGoal->current_amount + $amountToSave;
        
        if ($newAmount > $savingGoal->amount) {
            $newAmount = $savingGoal->amount;
        }

        $savingGoal->update(['current_amount' => $newAmount]);
        
        // Buat transaksi 'pengeluaran' untuk sinkronisasi dengan dasbor
        $savingGoal->user->transactions()->create([
            'name' => 'Menabung untuk: ' . $savingGoal->name,
            'amount' => $amountToSave,
            'type' => 'pengeluaran',
            'transaction_date' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Dana untuk "' . $savingGoal->name . '" berhasil disisihkan!');
    }

    private function calculateInstallments($amount, $dueDate, $frequency): int
    {
        $startDate = Carbon::now();
        $endDate = Carbon::parse($dueDate);

        $periods = 1;
        if ($endDate->isFuture()) {
            if ($frequency === 'monthly') {
                $periods = max(1, $startDate->diffInMonths($endDate) + 1);
            } else {
                $periods = max(1, $startDate->diffInWeeks($endDate) + 1);
            }
        }
        
        return (int) ceil($amount / $periods);
    }
}