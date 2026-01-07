<x-app-layout>
<div class="max-w-6xl mx-auto py-10">

<h1 class="text-2xl font-bold mb-6">Food Submissions Review</h1>

@foreach ($submissions as $item)
<div class="bg-white p-6 rounded-xl shadow mb-6">
    <img
    src="{{ asset('storage/' . $item->data['image']) }}"
    class="w-full h-48 object-cover rounded-xl">

    <h2 class="text-lg font-semibold">{{ $item->name }}</h2>

    <p class="text-sm text-gray-600 mb-2">
        Status: <span class="font-semibold">{{ $item->status }}</span>
    </p>

    <p class="mb-4">{{ $item->data['description'] }}</p>

    <div class="bg-gray-100 p-4 rounded text-sm mb-4">
        <strong>Research:</strong><br>
        {{ $item->data['research']['title'] }} <br>
        <a href="{{ $item->data['research']['url'] }}" class="text-blue-600">
            View Source
        </a>
    </div>

    <div class="flex gap-4">
        <form method="POST" action="{{ route('admin.food.approve',$item->id) }}">
            @csrf
            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Approve
            </button>
        </form>

        <form method="POST" action="{{ route('admin.food.reject', $item->id) }}">
            @csrf

            <textarea name="rejection_reason"
                class="w-full border rounded-lg p-3 mb-3"
                placeholder="Explain why this submission was rejected..."
                required></textarea>

            <button class="bg-red-600 text-white px-4 py-2 rounded-lg">
                Reject Submission
            </button>
        </form>
    </div>
</div>
@endforeach

</div>
</x-app-layout>
