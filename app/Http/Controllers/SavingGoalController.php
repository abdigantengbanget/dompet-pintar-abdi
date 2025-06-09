<?php

namespace App\Http\Controllers;

use App\Models\SavingGoal;
use Illuminate\Http\Request;

class SavingGoalController extends Controller
{
    public function index()
    {
        $goals = SavingGoal::where('user_id', auth()->id())->get();
        return view('saving_goals.index', compact('goals'));
    }

    public function create()
    {
        return view('saving_goals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date|after_or_equal:today',
            'monthly_income' => 'required|numeric|min:0',
            'installments' => 'required|integer|min:1',
            'frequency' => 'required|in:weekly,monthly',
            'saving_day' => 'required|integer|between:1,31',
        ]);

        $installment_value = $validated['amount'] / $validated['installments'];

        if ($installment_value > $validated['monthly_income']) {
            return back()->withErrors([
                'amount' => 'Jumlah cicilan melebihi penghasilan bulanan Anda.'
            ])->withInput();
        }

        $data = $validated;
        $data['user_id'] = auth()->id();

        SavingGoal::create($data);

        return redirect()->route('saving-goals.index')
            ->with('success', 'Saving goal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $savingGoal = SavingGoal::where('user_id', auth()->id())->findOrFail($id);
        return view('saving_goals.edit', compact('savingGoal'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date|after_or_equal:today',
            'monthly_income' => 'required|numeric|min:0',
            'installments' => 'required|integer|min:1',
            'frequency' => 'required|in:weekly,monthly',
            'saving_day' => 'required|integer|between:1,31',
        ]);

        $installment_value = $validated['amount'] / $validated['installments'];

        if ($installment_value > $validated['monthly_income']) {
            return back()->withErrors([
                'amount' => 'Jumlah cicilan melebihi penghasilan bulanan Anda.'
            ])->withInput();
        }

        $goal = SavingGoal::where('user_id', auth()->id())->findOrFail($id);
        $goal->update($validated);

        return redirect()->route('saving-goals.index')
            ->with('success', 'Saving goal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $goal = SavingGoal::where('user_id', auth()->id())->findOrFail($id);
        $goal->delete();

        return redirect()->route('saving-goals.index')
            ->with('success', 'Saving goal berhasil dihapus!');
    }
}
