@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10">

    <div class="flex justify-between items-center mb-8">
        <a href="/food-hub" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-black transition">
            <i class="fas fa-chevron-left mr-2"></i> Back to Food Hub
        </a>

        <div class="flex gap-3">
            {{-- Interaction logic using your new high-performance buttons --}}
            @php
                // Logic assuming you've passed $isLiked and $isSaved from the Controller
                $liked = $isLiked ?? false;
                $saved = $isSaved ?? false;
            @endphp
            
            <button onclick="handleInteraction({{ $food->id }}, 'like')" 
                class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-full shadow-sm hover:bg-gray-50 transition">
                <span class="heart-icon {{ $liked ? 'opacity-100' : 'opacity-40' }}">❤️</span>
                <span id="like-count-{{ $food->id }}" class="text-sm font-bold text-gray-700">{{ $food->likes_count ?? 0 }}</span>
            </button>

            <button onclick="handleInteraction({{ $food->id }}, 'save')" 
                class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-full shadow-sm hover:bg-gray-50 transition">
                <i class="{{ $saved ? 'fas' : 'far' }} fa-bookmark {{ $saved ? 'text-blue-500' : 'text-gray-400' }}"></i>
                <span class="text-sm font-bold text-gray-700">Save</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        
        <div>
            <div class="rounded-3xl overflow-hidden shadow-2xl bg-gray-100 sticky top-10">
                @php
                    $filePath = $food->data['image'] ?? null;
                    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                    $isVideo = in_array(strtolower($extension), ['mp4', 'mov', 'avi', 'm4v']);
                @endphp

                @if($filePath)
                    @if($isVideo)
                        <video controls class="w-full h-[500px] object-cover bg-black">
                            <source src="{{ asset('storage/' . $filePath) }}" type="video/{{ $extension }}">
                            Your browser does not support video.
                        </video>
                    @else
                        <img src="{{ asset('storage/' . $filePath) }}" alt="{{ $food->name }}"
                             class="w-full h-[500px] object-cover">
                    @endif
                @else
                    <div class="h-64 flex flex-col items-center justify-center text-gray-400 bg-gray-50">
                        <i class="fas fa-image text-4xl mb-2"></i>
                        <span>No visual media available</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-col gap-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ ($food->recommendation_type ?? 'Benefit') == 'Avoid' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                        {{ $food->recommendation_type ?? 'Benefit' }}
                    </span>
                    <span class="text-sm text-blue-600 font-semibold">{{ $food->disease_category }}</span>
                </div>
                <h1 class="text-4xl font-extrabold text-gray-900 leading-tight mb-4">
                    {{ $food->name }}
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed">
                    {{ $food->data['description'] }}
                </p>
            </div>

            <div>
                <h3 class="text-sm font-bold uppercase text-gray-400 tracking-widest mb-4">Key Ingredients</h3>
                <div class="flex flex-wrap gap-2">
                    @php $items = $food->data['ingredient'] ?? ($food->data['ingredients'] ?? []); @endphp
                    @forelse($items as $item)
                        <span class="bg-white border border-gray-200 text-gray-700 text-sm font-medium px-4 py-1.5 rounded-xl shadow-sm">
                            {{ $item }}
                        </span>
                    @empty
                        <span class="text-gray-400 italic">No ingredients listed</span>
                    @endforelse
                </div>
            </div>

            @if(isset($food->data['nutrition']))
            <div class="bg-neutral-900 rounded-3xl p-6 text-white shadow-xl">
                <h3 class="font-bold mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-pie text-blue-400"></i> Nutritional Profile
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    @foreach(['calories' => '🔥 Cal', 'protein' => '🥩 Pro', 'carbs' => '🍞 Carb', 'fat' => '🥑 Fat'] as $key => $label)
                        <div class="bg-neutral-800 rounded-2xl p-4 border border-neutral-700">
                            <p class="text-xs text-neutral-400 uppercase font-bold">{{ explode(' ', $label)[1] }}</p>
                            <p class="text-xl font-extrabold">{{ $food->data['nutrition'][$key] ?? '0' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if(isset($food->data['research']))
            <div class="p-6 bg-blue-50 rounded-3xl border border-blue-100 shadow-sm">
                <h3 class="text-blue-800 font-bold mb-3 flex items-center gap-2 text-lg">
                    <span>🔬</span> Evidence Based
                </h3>
                <h4 class="font-bold text-gray-800 mb-1 leading-snug">{{ $food->data['research']['title'] }}</h4>
                <p class="text-xs text-blue-600 font-medium mb-4 uppercase">{{ $food->data['research']['source'] }}</p>
                <p class="text-gray-700 text-sm leading-relaxed mb-6">
                    {{ $food->data['research']['summary'] }}
                </p>
                <a href="{{ $food->data['research']['url'] }}" target="_blank" 
                   class="inline-flex items-center text-sm font-bold text-blue-700 hover:text-blue-900 group">
                    View full research paper <i class="fas fa-external-link-alt ml-2 text-xs transition group-hover:translate-x-1"></i>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
function handleInteraction(foodId, type) {
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
            // 1. Update the Count
            const countElement = document.getElementById(`${type}-count-${foodId}`);
            if (countElement) {
                countElement.innerText = data.new_count;
            }

            // 2. Update Visual State (The "sticking" highlight)
            const btn = event.target.closest('button');
            if (type === 'like') {
                const heart = btn.querySelector('.heart-icon');
                // Logic depends on what your controller returns (status or liked)
                if (data.status) { 
                    heart.classList.replace('opacity-40', 'opacity-100');
                } else {
                    heart.classList.replace('opacity-100', 'opacity-40');
                }
            } else if (type === 'save') {
                const icon = btn.querySelector('i');
                if (data.status) {
                    icon.classList.replace('far', 'fas');
                    icon.classList.add('text-blue-500');
                } else {
                    icon.classList.replace('fas', 'far');
                    icon.classList.remove('text-blue-500');
                }
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

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
