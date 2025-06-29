<!-- resources/views/saving_goals/edit.blade.php (Diperbaiki) -->
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-6 sm:p-8">
        <div class="mb-6 border-b border-slate-200 dark:border-slate-700 pb-5">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-slate-100">
                Edit Saving Goal
            </h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                Perbarui detail tujuan finansial Anda.
            </p>
        </div>
        
        <form action="{{ route('saving-goals.update', $savingGoal->id) }}" method="POST">
            @csrf
            @method('PUT')
            {{-- Meng-include form parsial yang sama dengan halaman create --}}
            @include('saving_goals._form', ['savingGoal' => $savingGoal])
        </form>
    </div>
</div>
@endsection