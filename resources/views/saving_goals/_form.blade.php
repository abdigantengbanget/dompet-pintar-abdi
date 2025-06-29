<!-- resources/views/saving_goals/_form.blade.php (Diperbaiki) -->

{{-- Menampilkan semua error validasi di bagian atas --}}
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

<div class="space-y-6">
    {{-- Nama Tujuan --}}
    <div>
        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
            Nama Tujuan
        </label>
        <div class="mt-1">
            <input type="text" name="name" id="name" value="{{ old('name', $savingGoal->name ?? '') }}" required placeholder="Contoh: Beli HP Baru, Dana Darurat"
                   class="block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
        </div>
    </div>

    {{-- Target Nominal --}}
    <div>
        <label for="amount" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
            Target Nominal (Rp)
        </label>
        <div class="mt-1">
            <input type="number" name="amount" id="amount" value="{{ old('amount', $savingGoal->amount ?? '') }}" required placeholder="Contoh: 15000000"
                   class="block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
        </div>
    </div>

    {{-- Target Tanggal Selesai --}}
    <div>
        <label for="due_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
            Target Tanggal Selesai
        </label>
        <div class="mt-1">
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $savingGoal->due_date ? \Carbon\Carbon::parse($savingGoal->due_date)->format('Y-m-d') : '') }}" required 
                   class="block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
        </div>
    </div>

    {{-- Frekuensi Menabung --}}
    <div>
        <label for="frequency" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
            Frekuensi Menabung
        </label>
        <div class="mt-1">
            <select name="frequency" id="frequency" required 
                    class="block w-full rounded-lg border-slate-300 dark:bg-slate-900 dark:border-slate-700 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                <option value="monthly" {{ old('frequency', $savingGoal->frequency ?? 'monthly') == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                <option value="weekly" {{ old('frequency', $savingGoal->frequency ?? '') == 'weekly' ? 'selected' : '' }}>Mingguan</option>
            </select>
        </div>
    </div>
</div>

{{-- Tombol Aksi --}}
<div class="flex items-center justify-end mt-8 border-t border-slate-200 dark:border-slate-700 pt-6 space-x-4">
    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition">
        Batal
    </a>
    <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-teal-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase hover:bg-teal-700 transition">
        Simpan
    </button>
</div>