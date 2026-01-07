<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            Food Hub
        </h1>

        <!-- Action Bar -->
        <div class="flex justify-center mb-8">
            <div class="bg-gray-200 rounded-xl px-6 py-4 flex gap-6 shadow-sm">
                <a href="{{ route('food.upload') }}" class="flex flex-col items-center text-sm font-medium text-gray-700 hover:text-black transition-transform hover:scale-105">
                    <span class="bg-gray-300 rounded-lg p-3 mb-1">
                        ⬆️
                    </span>
                    Upload
                </a>

                <a href="{{ url('/my-food-submissions') }}" class="flex flex-col items-center text-sm font-medium text-gray-700 hover:text-black transition-colors">
                    <span class="bg-gray-300 rounded-lg p-3 mb-1">
                        🔍
                    </span>
                    Check Food submissions
                </a>
            </div>
        </div>

        <!-- Recipes Tabs -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-3">Recipes</h2>

            <div class="inline-flex bg-gray-200 rounded-lg p-1">
                <button class="px-4 py-1 rounded-md bg-white text-sm font-medium shadow">
                    Food
                </button>
                <button class="px-4 py-1 rounded-md text-sm font-medium text-gray-600">
                    Meals
                </button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="flex gap-4 mb-8">
            <button class="px-4 py-2 rounded-full bg-black text-white text-sm">
                All
            </button>
            <button class="px-4 py-2 rounded-full border text-sm">
                Autoimmune Friendly
            </button>
            <button class="px-4 py-2 rounded-full border text-sm">
                Nutrition
            </button>
        </div>

        <!-- Meals of the Day -->
            @if ($mealOfDay)
            <div class="mb-10">
                <h3 class="text-lg font-semibold mb-4">Meals of the Day</h3>

                <div class="bg-white rounded-xl shadow flex overflow-hidden">
                    <!-- Image placeholder -->
                    <div class="w-1/3">
                        <img
                            src="{{ asset('storage/' . $mealOfDay->data['image']) }}"
                            alt="{{ $mealOfDay->name }}"
                            class="w-full h-full object-cover"
                        >
                    </div>


                    <!-- Content -->
                    <div class="w-2/3 p-5 relative">
                        <!-- Bookmark -->
                        <div class="absolute top-4 right-4 text-gray-400">
                            🔖 {{ $mealOfDay->data['saved'] ?? '0'}}
                        </div>

                        <h4 class="text-xl font-bold mb-1">
                            {{ $mealOfDay->name }}
                        </h4>

                        <p class="text-sm text-gray-500 mb-2">
                            By Auto Care
                        </p>

                        {{-- Rating --}}
                        <div class="flex items-center text-sm mb-4">
                            ⭐ {{ $mealOfDay->data['rating'] ?? '0.0' }}
                            <span class="ml-3 text-gray-500">
                                ❤️ {{ $mealOfDay->data['like'] ?? 0 }}
                            </span>
                            <span class="ml-3 text-gray-500">
                                💾 {{ $mealOfDay->data['saved'] ?? 0 }}
                            </span>
                        </div>

                        {{-- Description --}}
                        <p class="text-gray-600 text-sm mb-5">
                            {{ $mealOfDay->data['description'] ?? 'No description available.' }}
                        </p>

                        <a href="{{ route('food.show', $mealOfDay->id) }}"
                        class="text-sm text-blue-600 hover:underline">
                            View recipe →
                        </a>
                    </div>
                </div>
            </div>
            @endif

        <!-- Food Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($foods as $food)
                <div class="rounded-2xl p-6 shadow {{ $loop->index < 3 ? 'bg-neutral-800 text-white' : 'bg-neutral-100 text-gray-900' }} ">
                    {{-- Display Image --}}
                    <img
                        src="{{ asset('storage/' . $food->data['image']) }}"
                        class="w-full h-40 object-cover rounded-lg mb-3"
                        alt="{{ $food->name }}"
                    >

                    {{-- image video TESTING
                    @php
                        $filePath = $food->data['image'];
                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                        $isVideo = in_array(strtolower($extension), ['mp4', 'mov', 'avi', 'm4v']);
                    @endphp

                        @if($isVideo)
                            <div class="w-full h-40 bg-black rounded-lg mb-3 flex items-center justify-center relative overflow-hidden">
                                <video
                                    class="absolute w-full h-full object-cover"
                                    autoplay
                                    muted
                                    loop
                                    playsinline>
                                    <source src="{{ asset('storage/' . $filePath) }}" type="video/{{ $extension }}">
                                </video>

                                <span class="absolute bottom-2 right-2 bg-black/50 text-white text-[10px] px-2 py-0.5 rounded">
                                    Video
                                </span>
                            </div>
                        @else
                            <img
                                src="{{ asset('storage/' . $filePath) }}"
                                class="w-full h-40 object-cover rounded-lg mb-3"
                                alt="{{ $food->name }}"
                            >
                        @endif
                    --}}

                    <!-- Title -->
                    <h2 class="text-lg font-semibold mb-3">
                        {{ $food->name }}
                    </h2>

                    <div class="flex gap-4 text-sm text-gray-600 mb-3">
                        <span>⭐ {{ $food->data['rating']?? '0' }}</span>
                        <span>❤️ {{ $food->data['like']?? '0' }}</span>
                        <span>💾 {{ $food->data['saved'] ?? '0' }}</span>
                    </div>

                    <!-- Features -->
                    {{-- Safe Ingredients Loop --}}
                    <div class="flex flex-wrap gap-2 mb-4">
                        @php
                            // Try singular first, fall back to plural
                            $items = $food->data['ingredient'] ?? ($food->data['ingredients'] ?? null);
                        @endphp

                        @if($items && is_array($items))
                            @foreach ($items as $item)
                                <span class="bg-gray-600 text-white text-[10px] px-2 py-0.5 rounded-full">
                                    {{ $item }}
                                </span>
                            @endforeach
                        @else
                            <span class="text-xs text-gray-400 italic">No ingredients listed</span>
                        @endif
                    </div>


                    <p class="text-gray-600 text-sm mb-4">
                        {{ $food->data['description'] }}
                    </p>

                    <!-- Button -->
                    <div class="flex justify-center mt-6">
                        <a href="{{ route('food.show', $food->id) }}"
                        class="
                        px-6 py-1.5 rounded-md text-sm border
                        {{ $loop->index < 3
                            ? 'border-white text-white hover:bg-white hover:text-black'
                            : 'border-gray-400 hover:bg-gray-200'
                        }}">
                            View
                        </a>
                    </div>


                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
