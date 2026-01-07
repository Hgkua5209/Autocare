<x-app-layout>
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-8">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Total Users</p>
                <h2 class="text-3xl font-bold">{{ $totalUsers }}</h2>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <p class="text-gray-500">Foods Approved</p>
                <h2 class="text-3xl font-bold">{{ $totalFoods }}</h2>
            </div>

            <div class="bg-yellow-50 p-6 rounded-xl shadow">
                <p class="text-gray-500">Pending Reviews</p>
                <h2 class="text-3xl font-bold text-yellow-700">
                    {{ $pendingSubmissions }}
                </h2>
            </div>

            <div class="bg-green-50 p-6 rounded-xl shadow">
                <p class="text-gray-500">Approved</p>
                <h2 class="text-3xl font-bold text-green-700">
                    {{ $approvedSubmissions }}
                </h2>
            </div>

            <div class="bg-red-50 p-6 rounded-xl shadow">
                <p class="text-gray-500">Rejected</p>
                <h2 class="text-3xl font-bold text-red-700">
                    {{ $rejectedSubmissions }}
                </h2>
            </div>

        </div>
    </div>
</x-app-layout>

