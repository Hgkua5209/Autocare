<x-app-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold">User Dashboard</h1>
        <p class="text-gray-600 mt-2">
            Welcome, {{ Auth::user()->name }}
        </p>
    </div>
</x-app-layout>
