<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold mb-6">Pending Food Submissions</h1>

        <div class="space-y-4">
            @forelse ($submissions as $item)
                <div class="bg-white p-5 rounded-xl shadow flex justify-between items-center">
                    <div>
                        <h2 class="font-semibold">{{ $item->name }}</h2>
                        <p class="text-sm text-gray-500">
                            Submitted by User #{{ $item->user_id }}
                        </p>
                    </div>

                    <a href="{{ route('admin.food.submissions.show', $item->id) }}"
                       class="text-blue-600 hover:underline">
                        Review →
                    </a>
                </div>
            @empty
                <p class="text-gray-500">No pending submissions.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
