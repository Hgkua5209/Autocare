@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-10">
        <div class="mb-6">
            <a href="{{ route('admin.food.review') }}" class="text-gray-500 hover:text-blue-600 flex items-center font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"></path></svg>
                Back to Review Queue
            </a>
        </div>
<!-- Submission Card -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative">
            <div class="h-64 bg-gray-200 relative">
                @if(isset($submission->data['image']))
                    <img src="{{ asset('storage/' . $submission->data['image']) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                        <span class="text-gray-400 font-bold uppercase tracking-widest text-xs">No Image Available</span>
                    </div>
                @endif

                <div class="absolute top-4 right-4">
                    <span class="bg-white/90 backdrop-blur px-4 py-1.5 rounded-full text-xs font-black shadow-sm border border-white">
                        STATUS: <span class="text-amber-600">PENDING APPROVAL</span>
                    </span>
                </div>
            </div>


<!-- Submission Card TESTING
            <div class="h-64 bg-gray-200 relative">
                @if(isset($submission->data['image']))
                    @php
                        $filePath = $submission->data['image'];
                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                        // Define video formats you want to support
                        $videoExtensions = ['mp4', 'mov', 'avi', 'm4v'];
                        $isVideo = in_array(strtolower($extension), $videoExtensions);
                    @endphp

                    @if($isVideo)
                        {{-- Video Preview --}}
                        <video class="w-full h-full object-cover bg-black" muted loop onmouseover="this.play()" onmouseout="this.pause()">
                            <source src="{{ asset('storage/' . $filePath) }}" type="video/{{ $extension }}">
                            Your browser does not support the video tag.
                        </video>
                        {{-- Play Icon Overlay for Videos --}}
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <span class="bg-black/50 text-white rounded-full p-2">▶</span>
                        </div>
                    @else
                        {{-- Image/GIF Preview --}}
                        <img src="{{ asset('storage/' . $filePath) }}" class="w-full h-full object-cover">
                    @endif
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                        <span class="text-gray-400 font-bold uppercase tracking-widest text-xs">No Media Available</span>
                    </div>
                @endif

                <div class="absolute top-4 right-4">
                    <span class="bg-white/90 backdrop-blur px-4 py-1.5 rounded-full text-xs font-black shadow-sm border border-white">
                        STATUS: <span class="text-amber-600">PENDING APPROVAL</span>
                    </span>
                </div>
            </div>
--><div class="p-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- LEFT CONTENT --}}
        <div class="lg:col-span-2 space-y-8">

            <div>
                <span class="text-blue-600 text-xs font-black uppercase tracking-widest">
                    {{ $submission->type }}
                </span>
                <h1 class="text-4xl font-black text-gray-900 mt-1">
                    {{ $submission->name }}
                </h1>
            </div>

            {{-- Overview --}}
            <section>
                <h3 class="text-sm font-black text-gray-400 uppercase mb-3">Overview</h3>
                <p class="text-gray-700 text-lg">
                    {{ $submission->data['description'] ?? 'No description.' }}
                </p>
            </section>

            {{-- Safety --}}
            <div class="bg-blue-50 border border-blue-100 p-6 rounded-2xl">
                <h3 class="text-blue-900 font-bold mb-2">Autoimmune Safety Notes</h3>
                <p class="text-blue-800 italic">
                    "{{ $submission->data['autoimmune_notes'] ?? 'None provided' }}"
                </p>
            </div>

            {{-- Research --}}
            <section>
                <h3 class="text-sm font-black text-gray-900 uppercase mb-3">
                    Research Evidence
                </h3>

                <div class="bg-gray-50 p-6 rounded-2xl border">
                    <p class="font-bold">
                        {{ $submission->data['research']['title'] ?? 'Study Title' }}
                    </p>

                    <p class="text-gray-600 text-sm mb-4">
                        {{ $submission->data['research']['summary'] ?? 'No summary' }}
                    </p>

                    <a href="{{ $submission->data['research']['url'] ?? '#' }}"
                       target="_blank"
                       class="text-blue-600 font-bold text-xs hover:underline">
                        View Source Document →
                    </a>
                </div>
            </section>

        </div>

        {{-- RIGHT SIDEBAR (IMPORTANT FIX) --}}
        <div class="lg:col-span-1">

            <div class="sticky top-24 space-y-6">

                {{-- Nutrition --}}
                <div class="bg-white border rounded-2xl p-6 shadow-sm">
                    <h3 class="text-xs font-black text-gray-400 uppercase mb-4">
                        Nutrition Facts
                    </h3>

                    @php
                        $nutrition = $submission->data['nutrition'] ?? [];
                    @endphp

                    @foreach(['calories','protein','carbs','fat','fiber'] as $n)
                        <div class="flex justify-between text-sm mb-2">
                            <span>{{ ucfirst($n) }}</span>
                            <span class="font-bold">
                                {{ $nutrition[$n] ?? 0 }}
                            </span>
                        </div>
                    @endforeach
                </div>

                {{-- APPROVE BUTTON --}}
                <form method="POST" action="{{ route('admin.food.approve', $submission->id) }}">
                    @csrf
                    <button class="w-full bg-green-600 text-white font-bold py-4 rounded-xl hover:bg-green-700">
                        ✅ Approve & Publish
                    </button>
                </form>

                {{-- REJECT --}}
                <button onclick="toggleReject()"
                        class="w-full text-gray-500 font-bold py-2 hover:text-red-600">
                    ❌ Reject Submission
                </button>

                <form id="rejectBox"
                      method="POST"
                      action="{{ route('admin.food.reject', $submission->id) }}"
                      class="hidden space-y-3 p-4 bg-red-50 rounded-xl">
                    @csrf

                    <textarea name="rejection_reason"
                              required
                              class="w-full border rounded-lg p-3"
                              placeholder="Reason..."></textarea>

                    <button class="w-full bg-red-600 text-white py-3 rounded-xl">
                        Confirm Reject
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection
