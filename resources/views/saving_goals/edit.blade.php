@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Saving Goal</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('saving-goals.update', $savingGoal->id) }}" method="POST">
        @method('PUT')
        @include('saving_goals._form')
    </form>
</div>
@endsection
