@csrf

<!-- Nama Saving Goal -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Nama Tujuan</label>
    <input type="text" name="name" value="{{ old('name', $savingGoal->name ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
</div>

<!-- Nominal Target -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Nominal Target</label>
    <input type="number" name="amount" value="{{ old('amount', $savingGoal->amount ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
</div>

<!-- Deadline -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Tanggal Deadline</label>
    <input type="date" name="due_date" value="{{ old('due_date', isset($savingGoal->due_date) ? $savingGoal->due_date->format('Y-m-d') : '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
</div>

<!-- Penghasilan Bulanan -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Penghasilan Bulanan</label>
    <input type="number" name="monthly_income" value="{{ old('monthly_income', $savingGoal->monthly_income ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
</div>

<!-- Jumlah Cicilan -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Jumlah Cicilan</label>
    <input type="number" name="installments" value="{{ old('installments', $savingGoal->installments ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
</div>

<!-- Frekuensi -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Frekuensi Menabung</label>
    <select name="frequency" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        <option value="weekly" {{ old('frequency', $savingGoal->frequency ?? '') == 'weekly' ? 'selected' : '' }}>Mingguan</option>
        <option value="monthly" {{ old('frequency', $savingGoal->frequency ?? '') == 'monthly' ? 'selected' : '' }}>Bulanan</option>
    </select>
</div>

<!-- Tanggal Menabung -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Tanggal Menabung (1-31)</label>
    <input type="number" name="saving_day" min="1" max="31" value="{{ old('saving_day', $savingGoal->saving_day ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
</div>

<!-- Tombol Submit -->
<div class="mt-4">
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Simpan
    </button>
</div>
