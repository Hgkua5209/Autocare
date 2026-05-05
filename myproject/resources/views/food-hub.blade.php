@extends('layouts.app')
@php
    // If the controller forgets to send it, this prevents the error
    $userInteractions = $userInteractions ?? collect();
@endphp
@section('content')
    <div class="max-w-7xl mx-auto px-6 py-5">

        <!-- Page Title -->
<div class="flex items-center justify-between mb-8">

    <!-- Title -->
    <h1 class="text-3xl font-bold text-gray-800">
        Food Hub
    </h1>

    <!-- Buttons -->
    <div class="flex gap-3">
        @if(auth()->user()->role === 'admin')

            <a href="{{ route('food.manage') }}" class="btn-gradient-outline">
                <i class="fas fa-tasks mr-1"></i> Manage
            </a>

            <!-- Approval (Only Admin) -->
            <a href="{{ url('/my-food-submissions') }}" class="btn-gradient-outline">
                Approval
            </a>

            <!-- Upload (Only Admin) -->
            <a href="{{ route('food.upload') }}" class="btn-gradient">
                + Upload
            </a>
        @endif
    </div>

</div>

        <!-- Recipes Tabs -->
        <div class="hub-navigation mb-6">
            <div class="flex justify-center mb-8">
                <div class="bg-gray-100 p-1 rounded-xl flex items-center shadow-inner inline-flex">
                    <button
                        class="nav-btn px-8 py-2.5 rounded-lg text-sm font-bold transition-all duration-300 flex items-center gap-2 active bg-black text-white"
                        data-type="food"
                        id="foodToggle">
                        <i class="fas fa-apple-alt"></i>
                        Single Food
                    </button>
                    <button
                        class="nav-btn px-8 py-2.5 rounded-lg text-sm font-bold transition-all duration-300 flex items-center gap-2 text-gray-500 hover:text-black"
                        data-type="meal"
                        id="mealToggle">
                        <i class="fas fa-utensils"></i>
                        Full Meals
                    </button>
                </div>
            </div>

            <div class="flex justify-between items-center mb-6">
                <button id="viewSavedBtn"
                        class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-full text-sm font-semibold text-gray-700 hover:bg-gray-50 transition shadow-sm">
                    <i class="far fa-bookmark text-blue-500"></i>
                    <span>Saved Items</span>
                </button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="flex gap-2 overflow-x-auto pb-4 mb-6">
            @php
                $categories = [
                    'All', 'General', 'Rheumatoid Arthritis (RA)', 'Lupus (SLE)',
                    'Sjögren\'s Syndrome', 'Celiac Disease', 'Ankylosing Spondylitis',
                    'Inflammatory Bowel Disease', 'Psoriatic Arthritis'
                ];
            @endphp

            @foreach($categories as $cat)
                <a href="{{ route('food.hub', ['category' => $cat]) }}"
                class="px-4 py-2 rounded-full text-sm whitespace-nowrap {{ $selectedCategory == $cat ? 'bg-black text-white' : 'bg-gray-200 text-gray-700' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        @if($selectedCategory == 'All' && auth()->user()->detected_condition)
            <div class="bg-blue-50 p-4 rounded-lg mb-8 border border-blue-200">
                <h3 class="text-blue-800 font-bold">Recommended for your {{ auth()->user()->detected_condition }}:</h3>
                <p class="text-sm text-blue-600">Based on your survey, we have prioritized these foods for you.</p>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($foods as $food)
                @endforeach
        </div>

        <!-- Meals of the Day -->
@if ($mealOfDay)
    @php
        // Fetch real interaction status for the featured meal
        $mealInteraction = $userInteractions->get($mealOfDay->id);
        $mealIsSaved = $mealInteraction && $mealInteraction->is_saved;
        $mealIsLiked = $mealInteraction && $mealInteraction->is_liked;
    @endphp

    <div class="mb-10 food-card"
         data-type="{{ strtolower($mealOfDay->type ?? 'meal') }}"
         data-saved="{{ $mealIsSaved ? 'true' : 'false' }}">

        <h3 class="text-lg font-semibold mb-4">Meal of the Day</h3>

        <div class="flex flex-col md:flex-row bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
            <div class="md:w-1/3">
                <img
                    src="{{ asset('storage/' . ($mealOfDay->data['image'] ?? 'default.jpg')) }}"
                    class="w-full h-64 md:h-full object-cover hover:scale-105 transition duration-500"
                >
            </div>

            <div class="md:w-2/3 p-6 relative">
                {{-- Functional Save Button --}}
                <div class="absolute top-4 right-4">
                    <button onclick="toggleSave({{ $mealOfDay->id }}, this)"
                            class="save-btn transition-colors {{ $mealIsSaved ? 'text-blue-500' : 'text-gray-400' }}">
                        <i class="{{ $mealIsSaved ? 'fas' : 'far' }} fa-bookmark text-2xl"></i>
                    </button>
                </div>

                <h4 class="text-2xl font-bold mb-1 text-gray-900">
                    {{ $mealOfDay->name }}
                </h4>

                <p class="text-sm text-blue-600 font-medium mb-3">
                    Recommended for {{ $mealOfDay->disease_category }}
                </p>

                {{-- Real-time Stats --}}
                <div class="flex items-center gap-6 text-sm mb-4">
                    <button onclick="toggleLike({{ $mealOfDay->id }}, this)" class="flex items-center gap-1 group">
                        <span class="heart-icon transition-opacity {{ $mealIsLiked ? 'opacity-100' : 'opacity-40' }}">❤️</span>
                        <span class="like-count font-semibold text-gray-600">{{ $mealOfDay->likes_count ?? 0 }}</span>
                    </button>
                </div>

                {{-- Description --}}
                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                    {{ $mealOfDay->data['description'] ?? 'This specially selected meal is optimized for your dietary needs and health goals.' }}
                </p>

                <div class="flex items-center justify-between mt-auto">
                    <a href="{{ route('food.show', $mealOfDay->id) }}"
                       class="inline-flex items-center px-4 py-2 bg-neutral-900 text-white text-sm font-medium rounded-lg hover:bg-neutral-800 transition">
                        View recipe <span class="ml-2">→</span>
                    </a>
                    <span class="text-[10px] text-gray-400 uppercase tracking-widest">AutoCare Selection</span>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="foodContainer">
    @foreach ($foods as $food)
        @php
            // Get the interaction object
            $interaction = $userInteractions->get($food->id);

            // Simple boolean checks (thanks to your Model casts)
            $isActuallyLiked = $interaction && $interaction->is_liked;
            $isActuallySaved = $interaction && $interaction->is_saved;
        @endphp

        <div class="food-card rounded-2xl p-6 shadow {{ $loop->index < 3 ? 'bg-neutral-800 text-white' : 'bg-neutral-100 text-gray-900' }}"
            data-type="{{ strtolower($food->type ?? 'food') }}"
            data-saved="{{ $isActuallySaved ? 'true' : 'false' }}">

            {{-- Top Row: Badges & Save Button --}}
            <div class="mb-4 flex justify-between items-start">
                <div>
                    @if(($food->recommendation_type ?? $food->data['recommendation_type']) == "Avoid")
                        <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded">❌ Avoid</span>
                    @else
                        <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">✅ Benefit</span>
                    @endif
                    <span class="ml-2 text-[10px] opacity-70 italic">{{ $food->disease_category }}</span>
                </div>

                {{-- SAVE BUTTON --}}
                <button onclick="toggleSave({{ $food->id }}, this)"
                        class="save-btn transition-colors {{ $isActuallySaved ? 'text-blue-500' : 'text-gray-400' }}">
                    <i class="{{ $isActuallySaved ? 'fas' : 'far' }} fa-bookmark text-xl"></i>
                </button>
            </div>
        </p>
            {{-- Display Image --}}
                    <img
                        src="{{ str_contains($food->data['image'], 'food-submissions')
                            ? asset('storage/' . $food->data['image'])
                            : asset($food->data['image']) }}"
                        class="w-full h-52 object-cover rounded-xl mb-4 hover:scale-105 transition"
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

                    {{-- Title --}}
                    <h2 class="text-lg font-semibold mb-3">{{ $food->name }}</h2>

                    {{-- LIKE BUTTON --}}
                    <div class="flex gap-4 text-sm mb-3">
                        <button onclick="toggleLike({{ $food->id }}, this)" class="flex items-center gap-1 hover:scale-110 transition">
                            <span class="heart-icon {{ $isActuallyLiked ? 'opacity-100' : 'opacity-40' }}">❤️</span>
                            <span class="like-count {{ $loop->index < 3 ? 'text-gray-300' : 'text-gray-500' }}">
                                {{ $food->likes_count ?? 0 }}
                            </span>
                        </button>
                    </div>

                    {{-- Ingredients --}}
                    <div class="flex flex-wrap gap-2 mb-4">
                        @php
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

                    <p class="{{ $loop->index < 3 ? 'text-gray-300' : 'text-gray-600' }} text-sm mb-4 line-clamp-2">
                        {{ $food->data['description'] ?? 'No description available.' }}
                    </p>

                    {{-- Action Button --}}
                    <div class="flex justify-center mt-6">
                        <a href="{{ route('food.show', $food->id) }}"
                        class="px-6 py-1.5 rounded-md text-sm border
                        {{ $loop->index < 3
                            ? 'border-white text-white hover:bg-white hover:text-black'
                            : 'border-gray-400 hover:bg-gray-200' }}">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    <style>
        .btn-gradient {
    padding: 10px 18px;
    border-radius: 12px;
    background: #000;
    color: white;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: 0.2s;
}

.btn-gradient:hover {
        background: #111;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

/* outline version (Approval) */
.btn-gradient-outline {
    padding: 10px 18px;
    border-radius: 12px;
    border: 2px solid #000;
    color: #000;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    background: white;
    transition: 0.2s;
}

.btn-gradient-outline:hover {
    background: #000;
    color: white;
}
.meal-card {
    display: flex;              /* 🔥 INI FIX */
    gap: 20px;
    align-items: center;

    background: #ffffff;
    border-radius: 18px;
    padding: 20px;
    border: 1px solid rgba(0,0,0,0.05);
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transition: all 0.25s ease;
}

/* ✨ HOVER EFFECT */
.meal-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.12);
}
    </style>

<script>
// 1. GLOBAL FUNCTIONS (Accessible by HTML onclick)
function toggleSave(id, btn) {
    console.log("Saving food ID:", id);
    fetch(`/food/${id}/save`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        const icon = btn.querySelector('i');
        const card = btn.closest('.food-card');

        if(data.status) {
            card.setAttribute('data-saved', 'true');
            icon.classList.remove('far');
            icon.classList.add('fas');
            btn.classList.add('text-blue-500');
        } else {
            card.setAttribute('data-saved', 'false');
            icon.classList.remove('fas');
            icon.classList.add('far');
            btn.classList.remove('text-blue-500');
        }
    })
    .catch(err => console.error('Error:', err));
}

function toggleLike(id, btn) {
    fetch(`/food/${id}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            const countSpan = btn.querySelector('.like-count');
            const heart = btn.querySelector('.heart-icon');
            if (countSpan) countSpan.innerText = data.count;

            if(data.status) {
                heart.classList.add('opacity-100');
                heart.classList.remove('opacity-40');
            } else {
                heart.classList.add('opacity-40');
                heart.classList.remove('opacity-100');
            }
        }
    })
    .catch(err => console.error('Error:', err));
}

// 2. DOM CONTENT LOADED
document.addEventListener('DOMContentLoaded', function() {
    const navBtns = document.querySelectorAll('.nav-btn');
    const viewSavedBtn = document.getElementById('viewSavedBtn');
    const cards = document.querySelectorAll('.food-card');

    let currentType = 'food';
    let showingSavedOnly = false;

    // Filter Logic
    function applyFilters() {
        cards.forEach(card => {
            const isSaved = card.getAttribute('data-saved');
            const typeMatch = (card.dataset.type === currentType);
            const saveMatch = showingSavedOnly ? (isSaved === 'true') : true;

            card.style.display = (typeMatch && saveMatch) ? "block" : "none";
        });

        // Hide section headers if empty
        document.querySelectorAll('.mb-10, .grid').forEach(container => {
            const visibleCards = container.querySelectorAll('.food-card[style="display: block;"]').length;
            if (container.classList.contains('grid')) {
                container.style.display = (visibleCards === 0) ? "none" : "grid";
            }
        });
    }

    // Food vs Meal Toggle
    navBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active styles from all
            navBtns.forEach(b => {
                b.classList.remove('bg-black', 'text-white', 'shadow-md');
                b.classList.add('text-gray-500');
            });

            // Add active styles to clicked
            this.classList.add('bg-black', 'text-white', 'shadow-md');
            this.classList.remove('text-gray-500');

            currentType = this.dataset.type;
            applyFilters();
        });
    });

    // Save Filter Toggle
    if (viewSavedBtn) {
        viewSavedBtn.addEventListener('click', function() {
            showingSavedOnly = !showingSavedOnly;

            this.classList.toggle('bg-blue-600');
            this.classList.toggle('text-white');
            this.innerHTML = showingSavedOnly
                ? '<i class="fas fa-arrow-left mr-2"></i> Show All'
                : '<i class="fas fa-bookmark mr-2"></i> View Saved Items';

            applyFilters();
        });
    }

    // Run on load
    applyFilters();
});
</script>
@endsection
