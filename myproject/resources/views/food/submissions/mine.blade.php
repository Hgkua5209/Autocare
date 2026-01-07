<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-10">
        <h1 class="text-2xl font-bold mb-6">My Food Submissions</h1>

        <div class="space-y-4">
            @forelse ($submissions as $item)
                <div class="bg-white p-5 rounded-xl shadow flex justify-between items-center">
                    <div>
                        <h2 class="font-semibold">{{ $item->name }}</h2>
                        <p class="text-sm text-gray-500">
                            Submitted on {{ $item->created_at->format('d M Y') }}
                        </p>
                    </div>

                    {{-- Status Badge --}}
                    @if ($item->status === 'pending')
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">
                            Pending Review
                        </span>
                    @elseif ($item->status === 'approved')
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                            Approved
                        </span>
                    @else
                        <div class="flex flex-col items-end gap-2">
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">
                                Rejected
                            </span>

                            @if ($item->rejection_reason)
                                <p class="text-sm text-red-600 max-w-xs text-right">
                                    <strong>Reason:</strong> {{ $item->rejection_reason }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-500">You haven’t submitted any food yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
