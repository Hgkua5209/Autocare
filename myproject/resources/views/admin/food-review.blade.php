<x-app-layout>
    <div class="max-w-6xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">Food Submissions Review</h1>

            @foreach ($submissions as $item)
            <div class="bg-white p-6 rounded-xl shadow mb-6">
                <img
                src="{{ asset('storage/' . $item->data['image']) }}"
                class="w-full h-48 object-cover rounded-xl">

                <h2 class="text-lg font-semibold mt-4">{{ $item->name }}</h2>

                <p class="text-sm text-gray-600 mb-2">
                    Status: <span class="font-semibold uppercase">{{ $item->status }}</span>
                </p>

                <p class="mb-4 text-gray-700">{{ $item->data['description'] }}</p>

                <div class="bg-gray-100 p-4 rounded text-sm mb-4">
                    <strong>Research Evidence:</strong><br>
                    <span class="text-gray-800">{{ $item->data['research']['title'] }}</span> <br>
                    <a href="{{ $item->data['research']['url'] }}" target="_blank" class="text-blue-600 hover:underline">
                        View Source link
                    </a>
                </div>

                <div class="flex flex-col md:flex-row gap-6 border-t pt-4">
                    <form method="POST" action="{{ route('admin.food.approve',$item->id) }}">
                        @csrf
                        <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition font-medium">
                            Approve Submission
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.food.reject', $item->id) }}" class="flex-1">
                        @csrf
                        <div class="space-y-2">
                            <textarea name="rejection_reason"
                                class="w-full border rounded-lg p-3 @error('rejection_reason') border-red-500 bg-red-50 @enderror"
                                placeholder="Explain why this submission was rejected (required for rejection)..."
                                required>{{ old('rejection_reason') }}</textarea>

                            @error('rejection_reason')
                                <p class="text-red-600 text-xs font-semibold">{{ $message }}</p>
                            @enderror

                            <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition text-sm">
                                Reject Submission
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach

    </div>
</x-app-layout>
