<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-10">

        <!-- Back -->
        <a href="/food-hub" class="text-sm text-gray-500 hover:underline mb-6 inline-block">
            ← Back to Food Hub
        </a>

        <!-- Title -->
        <h1 class="text-3xl font-bold mb-4">
            {{ $food->name }}
        </h1>

        <!-- Stats -->
        <div class="flex gap-4 text-sm text-gray-600 mb-3">
            <span>⭐ {{ $food->data['rating'] ?? '0' }}</span>

            {{-- Like Button --}}
            <button onclick="handleInteraction({{ $food->id }}, 'like')" class="hover:scale-110 transition">
                ❤️ <span id="like-count-{{ $food->id }}">{{ $food->data['like'] ?? '0' }}</span>
            </button>

            {{-- Save Button --}}
            <button onclick="handleInteraction({{ $food->id }}, 'save')" class="hover:scale-110 transition">
                💾 <span id="save-count-{{ $food->id }}">{{ $food->data['saved'] ?? '0' }}</span>
            </button>
        </div>


        <!-- Ingredients -->
        {{-- Safe Ingredients Loop --}}
        <div class="flex flex-wrap gap-2 mb-4">
            @php
                // Try singular first, fall back to plural
                $items = $food->data['ingredient'] ?? ($food->data['ingredients'] ?? null);
            @endphp

            @if($items && is_array($items))
                @foreach ($items as $item)
                    <span class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-100">
                        {{ $item }}
                    </span>
                @endforeach
            @else
                <span class="text-xs text-gray-400 italic">No ingredients listed</span>
            @endif
        </div>

        <!-- Description -->
        <div>
            <h3 class="font-semibold mb-2">Description</h3>
            <p class="text-gray-700">
                {{ $food->data['description'] }}
            </p>
        </div>

<!-- Food Image Display -->
        <div class="mb-8 rounded-3xl overflow-hidden shadow-lg bg-gray-100">
            @php
                $imagePath = $food->data['image'] ?? null;
            @endphp

            @if($imagePath)
                <img
                    src="{{ asset('storage/' . $imagePath) }}"
                    alt="{{ $food->name }}"
                    class="w-full max-h-[500px] object-cover"
                    onerror="this.parentElement.innerHTML='<div class=\"p-10 text-center text-gray-400\">Image not found</div>'"
                >
            @else
                <div class="h-64 flex items-center justify-center text-gray-400 italic">
                    <span>No image provided for this entry</span>
                </div>
            @endif
        </div>


<!-- Food Image or Video Display TESTING
        <div class="mb-8 rounded-3xl overflow-hidden shadow-lg bg-gray-100">
            @php
                $filePath = $food->data['image'] ?? null;
                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                $videoExtensions = ['mp4', 'mov', 'avi', 'm4v'];
                $isVideo = in_array(strtolower($extension), $videoExtensions);
            @endphp

            @if($filePath)
                @if($isVideo)
                    <video controls class="w-full max-h-[500px] object-contain bg-black">
                        <source src="{{ asset('storage/' . $filePath) }}" type="video/{{ $extension }}">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <img
                        src="{{ asset('storage/' . $filePath) }}"
                        alt="{{ $food->name }}"
                        class="w-full max-h-[500px] object-cover"
                    >
                @endif
            @else
                <div class="h-64 flex items-center justify-center text-gray-400">
                    <span>No Image or Video available</span>
                </div>
            @endif
        </div>
-->
        {{-- Nutrition --}}
        @if(isset($food->data['nutrition']))
        <div class="mt-8">
            <h3 class="font-semibold mb-3">Nutrition</h3>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-gray-100 rounded-lg p-3 text-center">
                    <p class="text-sm text-gray-500">Calories</p>
                    <p class="font-bold">{{ $food->data['nutrition']['calories'] }}</p>
                </div>

                <div class="bg-gray-100 rounded-lg p-3 text-center">
                    <p class="text-sm text-gray-500">Protein</p>
                    <p class="font-bold">{{ $food->data['nutrition']['protein'] }}</p>
                </div>

                <div class="bg-gray-100 rounded-lg p-3 text-center">
                    <p class="text-sm text-gray-500">Carbs</p>
                    <p class="font-bold">{{ $food->data['nutrition']['carbs'] }}</p>
                </div>

                <div class="bg-gray-100 rounded-lg p-3 text-center">
                    <p class="text-sm text-gray-500">Fat</p>
                    <p class="font-bold">{{ $food->data['nutrition']['fat'] }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Add this to food-show.blade.php below the Nutrition section --}}
        @if(isset($food->data['research']))
        <div class="mt-10 p-6 bg-blue-50 rounded-2xl border border-blue-100">
            <h3 class="text-blue-800 font-bold mb-4 flex items-center gap-2">
                <span>🔬</span> Research Evidence
            </h3>
            <h4 class="font-bold text-gray-800">{{ $food->data['research']['title'] }}</h4>
            <p class="text-xs text-blue-600 mb-3">{{ $food->data['research']['source'] }}</p>

            <p class="text-gray-700 text-sm leading-relaxed mb-4">
                {{ $food->data['research']['summary'] }}
            </p>

            <a href="{{ $food->data['research']['url'] }}" target="_blank" class="text-sm font-bold text-blue-700 hover:underline">
                View Source Document ↗
            </a>
        </div>
        @endif

    </div>

    <script>
function handleInteraction(foodId, type) {
    // Determine the correct URL based on the type (like or save)
    const url = `/food/${foodId}/${type}`;

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Find the specific span and update its number
            const countElement = document.getElementById(`${type}-count-${foodId}`);
            if (countElement) {
                countElement.innerText = data.new_count;
            }
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
</x-app-layout>
