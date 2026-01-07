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

        <!-- Basic Info -->
        <div class="bg-white p-6 rounded-xl shadow space-y-4">
            <input name="name" class="w-full border rounded p-2" placeholder="Food Name" required>

            <select name="type" class="w-full border rounded p-2">
                <option value="food">Food</option>
                <option value="meal">Meal</option>
            </select>

            <textarea name="description" class="w-full border rounded p-2" placeholder="Description" required></textarea>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Ingredients</label>
                <input
                    type="text"
                    name="ingredients"
                    placeholder="e.g. Egg, Rice Flour, Vegetables"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    value="{{ old('ingredients') }}"
                >
                <p class="text-xs text-gray-500 mt-1">Separate ingredients with commas.</p>
            </div>
        </div>
<!------- Food Image Upload -->
        <div>
            <label class="block text-sm font-medium mb-1">Food Image</label>
            <input
                type="file"
                name="image"
                accept="image/*"
                class="w-full border rounded p-2"
                required
            >
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
                <option value="beneficial">Beneficial</option>
                <option value="neutral">Neutral</option>
                <option value="avoid">Avoid</option>
            </select>

            <textarea name="autoimmune_notes" class="w-full border rounded p-2"
                placeholder="Explain why this food is safe or unsafe for autoimmune users"
                required></textarea>
        </div>

        <!-- Nutrition -->
        <div class="bg-white p-6 rounded-xl shadow grid grid-cols-2 gap-4">
            <input name="calories" placeholder="Calories" class="border p-2 rounded">
            <input name="protein" placeholder="Protein" class="border p-2 rounded">
            <input name="carbs" placeholder="Carbs" class="border p-2 rounded">
            <input name="fat" placeholder="Fat" class="border p-2 rounded">
            <input name="fiber" placeholder="Fiber" class="border p-2 rounded">
        </div>

        <!-- Research Evidence -->
        <div class="bg-red-50 border border-red-200 p-6 rounded-xl space-y-4">
            <h3 class="font-semibold text-red-700">Research Evidence (Required)</h3>

            <input name="research_title" class="w-full border p-2 rounded" placeholder="Research Title" required>
            <input name="research_source" class="w-full border p-2 rounded" placeholder="Source (PubMed, WHO, etc)" required>
            <input name="research_url" class="w-full border p-2 rounded" placeholder="Research Link (URL)" required>

            <textarea name="research_summary" class="w-full border p-2 rounded"
                placeholder="Brief summary explaining autoimmune safety"></textarea>
        </div>

        <button class="bg-black text-white px-6 py-2 rounded">
            Submit for Review
        </button>

    </form>
</div>
</x-app-layout>
