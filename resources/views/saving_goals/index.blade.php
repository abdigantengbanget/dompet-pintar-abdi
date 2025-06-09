@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 transition hover:text-green-600">🎯 Saving Goals</h1>
        <a href="{{ route('saving-goals.create') }}" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow-md transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Goal
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($goals as $goal)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-xl transition p-6 relative">
                <div class="absolute top-4 right-4 text-sm text-gray-400">
                    📅 {{ \Carbon\Carbon::parse($goal->due_date)->translatedFormat('d M Y') }}
                </div>
                <h2 class="text-xl font-semibold text-blue-700 mb-2">{{ $goal->name }}</h2>
                <p class="text-gray-700">Jumlah: <span class="font-bold text-green-600">Rp {{ number_format($goal->amount, 2, ',', '.') }}</span></p>

                <div class="mt-4 flex justify-between gap-2">
                    <a href="{{ route('saving-goals.edit', $goal) }}" class="flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm shadow-sm">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('saving-goals.destroy', $goal) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="flex items-center gap-1 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm shadow-sm">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 text-lg mt-12">
                🚫 Belum ada saving goal. Yuk buat dulu!
            </div>
        @endforelse
    </div>
</div>
@endsection
