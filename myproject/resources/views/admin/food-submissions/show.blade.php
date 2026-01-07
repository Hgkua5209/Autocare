<x-app-layout>
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
-->
            <div class="p-8">
                <div class="flex flex-wrap lg:flex-nowrap gap-10">

                    <div class="flex-grow space-y-8">
                        <div>
                            <span class="text-blue-600 text-xs font-black uppercase tracking-widest">{{ $submission->type }}</span>
                            <h1 class="text-4xl font-black text-gray-900 mt-1">{{ $submission->name }}</h1>
                        </div>

                        <section>
                            <h3 class="text-sm font-black text-gray-400 uppercase mb-3 tracking-tighter">Overview</h3>
                            <p class="text-gray-700 leading-relaxed text-lg">{{ $submission->data['description'] ?? 'No description.' }}</p>
                        </section>

                        <div class="bg-blue-50 border border-blue-100 p-6 rounded-2xl">
                            <h3 class="text-blue-900 font-bold flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                                Autoimmune Safety Notes
                            </h3>
                            <p class="text-blue-800 italic">"{{ $submission->data['autoimmune_notes'] ?? 'None provided' }}"</p>
                        </div>

                        <section>
                            <br>
                            <h3 class="text-sm font-black text-gray-900 uppercase mb-3 tracking-tighter">Research Evidence</h3>
                            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                                <p class="font-bold text-gray-900 mb-1">
                                    {{ $submission->data['research']['title'] ?? 'Study Title' }}
                                </p>
                                <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                    {{ $submission->data['research']['summary'] ?? 'No summary provided.' }}
                                </p>

                                {{-- Fixed Link and Icon Size --}}
                                <a href="{{ $submission->data['research']['url'] ?? '#' }}"
                                target="_blank"
                                class="inline-flex items-center text-blue-600 font-bold text-xs uppercase hover:underline">
                                    View Source Document
                                    {{-- Added w-4 h-4 to force the icon to stay small --}}
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                </a>
                            </div>
                        </section>
                    </div>

                    <div class="w-full lg:w-80 space-y-6 shrink-0">
                        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                            <h3 class="text-xs font-black text-gray-400 uppercase mb-4 tracking-widest">Nutrition Facts</h3>
                            <div class="space-y-3">
                                @php
                                    $nutrients = ['calories' => 'kcal', 'protein' => 'g', 'carbs' => 'g', 'fat' => 'g', 'fiber' => 'g'];
                                    $nutritionData = $submission->data['nutrition'] ?? [];
                                @endphp

                                @foreach($nutrients as $key => $unit)
                                    <div class="flex justify-between text-sm border-b border-gray-50 pb-2">
                                        <span class="text-gray-500 capitalize">{{ $key }}</span>
                                        <span class="font-bold text-gray-900">
                                            {{ $nutritionData[$key] ?? '0' }}<span class="text-[10px] ml-0.5 text-gray-400">{{ $unit }}</span>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="space-y-3">
                            <form method="POST" action="{{ route('admin.food.approve', $submission->id) }}">
                                @csrf
                                <button class="w-full bg-green-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-green-100 hover:bg-green-700 transition transform active:scale-95">
                                    Approve & Publish
                                </button>
                            </form>
                        </div>
                        <div class="space-y-3">
                            {{-- Main Rejection Toggle Button (Scaled down by 0.3) --}}
                            <button onclick="document.getElementById('reject-area').classList.toggle('hidden')"
                                    class="w-full text-gray-400 font-bold py-2.5 text-base hover:text-red-600 transition border border-transparent hover:border-red-100 rounded-xl">
                                Reject Submission...
                            </button>

                            {{-- Rejection Form Area --}}
                            <form id="reject-area" method="POST" action="{{ route('admin.food.reject', $submission->id) }}" class="hidden space-y-3 mt-2 p-4 bg-red-50/50 rounded-2xl border border-red-100">
                                @csrf
                                <label class="text-[10px] font-bold text-red-400 uppercase tracking-widest ml-1">Reason for Rejection</label>

                                {{-- Adjusted Textarea size and font --}}
                                <textarea name="rejection_reason"
                                        required
                                        class="w-full border-gray-200 rounded-xl text-base p-3 focus:ring-red-500 focus:border-red-500 shadow-sm"
                                        rows="3"
                                        placeholder="Explain why this submission was not accepted..."></textarea>

                                {{-- Increased Confirm Button size - +0.4 scaling --}}
                                <button class="w-full bg-red-600 text-white font-black py-5 px-6 text-xl rounded-2xl shadow-xl shadow-red-200 hover:bg-red-700 transition transform active:scale-95 tracking-tight">
                                    Confirm Rejection
                                </button>
                            </form>
                        </div>

                    </div> </div> </div> </div> </div>
</x-app-layout>
