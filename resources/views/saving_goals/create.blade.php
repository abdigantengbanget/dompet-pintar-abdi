@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10 max-w-xl">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">➕ Tambah Saving Goal</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 p-4 rounded-lg mb-6 shadow-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('saving-goals.store') }}" method="POST" class="bg-white shadow-xl rounded-2xl p-6 space-y-5 border border-gray-200">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Tujuan</label>
            <input type="text" name="name" id="name" required
                class="w-full border border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm transition"
                value="{{ old('name') }}">
        </div>

        <div>
            <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Jumlah (Rp)</label>
            <input type="number" step="0.01" name="amount" id="amount" required
                class="w-full border border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm transition"
                value="{{ old('amount') }}">
        </div>

        <div>
            <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Target</label>
            <input type="date" name="due_date" id="due_date" required
                class="w-full border border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm transition"
                value="{{ old('due_date') }}">
        </div>

        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('saving-goals.index') }}" class="text-blue-600 hover:underline text-sm inline-flex items-center gap-1">
                ← Kembali
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow transition text-sm font-medium">
                💾 Simpan
            </button>
        </div>
    </form>
</div>
@endsection
