@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-gray-800 transition duration-300 hover:text-green-500">Daftar Saving Goals</h1>
        <a href="{{ route('saving-goals.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg shadow-lg transition duration-300">
            + Tambah Goal
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4 shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($goals as $goal)
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition duration-300">
                <h2 class="text-2xl font-semibold text-blue-600">{{ $goal->name }}</h2>
                <p class="text-gray-600 mt-2">Jumlah: <strong class="text-lg">Rp {{ number_format($goal->amount, 2, ',', '.') }}</strong></p>
                <p class="text-gray-500">Target: {{ \Carbon\Carbon::parse($goal->due_date)->translatedFormat('d F Y') }}</p>

                <div class="mt-4 flex gap-3">
                    <a href="{{ route('saving-goals.edit', $goal) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-sm transition duration-300">
                        Edit
                    </a>
                    <form action="{{ route('saving-goals.destroy', $goal) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm transition duration-300">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                Belum ada saving goal. Yuk buat dulu!
            </div>
        @endforelse
    </div>
</div>
@endsection