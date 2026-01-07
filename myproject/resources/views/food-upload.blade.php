<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">Upload Food for Review</h1>

        <p class="text-sm text-gray-600 mb-6">
            All submissions must include credible research evidence.
            Admin approval is required before public listing.
        </p>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('food.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-white p-6 rounded-xl shadow space-y-4">
                <div>
                    <input name="name" value="{{ old('name') }}"
                        class="w-full border rounded p-2 @error('name') border-red-500 @enderror"
                        placeholder="Food Name" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <select name="type" class="w-full border rounded p-2 @error('type') border-red-500 @enderror">
                    <option value="food" {{ old('type') == 'food' ? 'selected' : '' }}>Food</option>
                    <option value="meal" {{ old('type') == 'meal' ? 'selected' : '' }}>Meal</option>
                </select>

                <div>
                    <textarea name="description"
                            class="w-full border rounded p-2 @error('description') border-red-500 @enderror"
                            placeholder="Description" required>{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ingredients</label>
                    <input
                        type="text"
                        name="ingredients"
                        placeholder="e.g. Egg, Rice Flour, Vegetables"
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('ingredients') border-red-500 @enderror"
                        value="{{ old('ingredients') }}"
                    >
                    @error('ingredients') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <p class="text-xs text-gray-500 mt-1">Separate ingredients with commas.</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Food Image</label>
                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    class="w-full border rounded p-2 @error('image') border-red-500 @enderror"
                    required
                >
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

        <!-- Food Image or Video Upload TESTING
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Food Image or Video</label>
                    <input
                        type="file"
                        name="image"
                        {{-- Updated to accept images (including gifs) and videos --}}
                        accept="image/*,video/*"
                        class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500"
                        required
                    >
                    <p class="text-xs text-gray-500 mt-1">Supported: JPG, PNG, WEBP, GIF, MP4, MOV (Max 20MB)</p>
                </div>
        -->
                <!-- Autoimmune Safety -->
        <div class="bg-white p-6 rounded-xl shadow space-y-4">
                <h3 class="font-semibold">Autoimmune Safety</h3>

                <select name="status" class="w-full border rounded p-2">
                    <option value="beneficial" {{ old('status') == 'beneficial' ? 'selected' : '' }}>Beneficial</option>
                    <option value="neutral" {{ old('status') == 'neutral' ? 'selected' : '' }}>Neutral</option>
                    <option value="avoid" {{ old('status') == 'avoid' ? 'selected' : '' }}>Avoid</option>
                </select>

                <div>
                    <textarea name="autoimmune_notes"
                        class="w-full border rounded p-2 @error('autoimmune_notes') border-red-500 @enderror"
                        placeholder="Explain why this food is safe or unsafe for autoimmune users"
                        required>{{ old('autoimmune_notes') }}</textarea>
                    @error('autoimmune_notes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow grid grid-cols-2 gap-4">
                <input name="calories" value="{{ old('calories') }}" placeholder="Calories" class="border p-2 rounded @error('calories') border-red-500 @enderror">
                <input name="protein" value="{{ old('protein') }}" placeholder="Protein" class="border p-2 rounded @error('protein') border-red-500 @enderror">
                <input name="carbs" value="{{ old('carbs') }}" placeholder="Carbs" class="border p-2 rounded @error('carbs') border-red-500 @enderror">
                <input name="fat" value="{{ old('fat') }}" placeholder="Fat" class="border p-2 rounded @error('fat') border-red-500 @enderror">
                <input name="fiber" value="{{ old('fiber') }}" placeholder="Fiber" class="border p-2 rounded @error('fiber') border-red-500 @enderror">
            </div>

            <div class="bg-red-50 border border-red-200 p-6 rounded-xl space-y-4">
                <h3 class="font-semibold text-red-700">Research Evidence (Required)</h3>

                <div>
                    <input name="research_title" value="{{ old('research_title') }}"
                        class="w-full border p-2 rounded @error('research_title') border-red-500 @enderror"
                        placeholder="Research Title" required>
                    @error('research_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <input name="research_source" value="{{ old('research_source') }}"
                        class="w-full border p-2 rounded @error('research_source') border-red-500 @enderror"
                        placeholder="Source (PubMed, WHO, etc)" required>
                    @error('research_source') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <input name="research_url" value="{{ old('research_url') }}"
                        class="w-full border p-2 rounded @error('research_url') border-red-500 @enderror"
                        placeholder="Research Link (URL)" required>
                    @error('research_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <textarea name="research_summary"
                    class="w-full border p-2 rounded @error('research_summary') border-red-500 @enderror"
                    placeholder="Brief summary explaining autoimmune safety">{{ old('research_summary') }}</textarea>
            </div>

            <button class="bg-black text-white px-6 py-2 rounded">
                Submit for Review
            </button>

        </form>
    </div>
</x-app-layout>
