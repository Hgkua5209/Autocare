@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10">
    <div class="flex items-center justify-between mb-10">
        <h1 class="text-3xl font-bold text-gray-800">Food Inventory Management</h1>
        <a href="{{ route('food.hub') }}" class="text-sm font-medium text-gray-500 hover:text-black">
            ← Back to Hub
        </a>
    </div>

    <div class="space-y-4">
        @foreach($foods as $food)
            <div class="flex items-center justify-between bg-neutral-900 text-white p-5 rounded-2xl shadow-lg border border-neutral-800 transition hover:scale-[1.01]">
                <div>
                    <h3 class="font-bold text-lg">{{ $food->name }}</h3>
                    <p class="text-xs text-neutral-400 uppercase tracking-wider">
                        {{ $food->disease_category }} • Added {{ $food->created_at->format('d M Y') }}
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Blue View Button -->
                    <a href="{{ route('food.show', $food->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl text-sm font-bold transition shadow-sm">
                        View
                    </a>

                    <!-- Longer Red Delete Button -->
                    <form action="{{ route('food.destroy', $food->id) }}" method="POST" class="w-30" onsubmit="return confirm('Confirm deletion?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-xl text-sm font-bold transition shadow-sm">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
