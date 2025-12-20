@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-neutral-900 text-white">

<!-- Welcome Bar -->
<div class="flex items-center justify-center gap-3 text-white">
    <div class="w-10 h-10 rounded-full bg-neutral-600 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
    </div>

    <h2 class="text-xl font-semibold">
        Welcome {{ auth()->user()->name }},
    </h2>
</div>

<!-- Services Grid -->
<div class="max-w-7xl mx-auto px-6 py-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Condition Explore -->
        <div class="bg-neutral-800 text-white rounded-xl p-6 flex flex-col justify-between min-h-[220px]">
            <div>
                <h2 class="text-lg font-semibold mb-2">Condition Explore</h2>
                <ul class="text-sm text-gray-300 list-disc list-inside space-y-1">
                    <li>Select Your Condition</li>
                    <li>Learn About Your Condition</li>
                    <li>Share & Discuss</li>
                </ul>
            </div>
            <button class="mt-6 border border-gray-400 rounded px-4 py-1 self-center">Explore</button>
        </div>

        <!-- Health Tracker -->
        <div class="bg-neutral-800 text-white rounded-xl p-6 flex flex-col justify-between min-h-[220px]">
            <div>
                <h2 class="text-lg font-semibold mb-2">Health Tracker</h2>
                <ul class="text-sm text-gray-300 list-disc list-inside space-y-1">
                    <li>Log Symptoms</li>
                    <li>Track Progress</li>
                    <li>Medication Log</li>
                </ul>
            </div>
            <button class="mt-6 border border-gray-400 rounded px-4 py-1 self-center">Track</button>
        </div>

        <!-- Support Circle -->
        <div class="bg-neutral-200 text-black rounded-lg p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-semibold mb-2">Support Circle</h2>
                <ul class="text-sm list-disc list-inside space-y-1">
                    <li>Join Discussions</li>
                    <li>Ask Experts</li>
                    <li>Share Stories</li>
                </ul>
            </div>
            <button class="mt-6 border border-gray-600 rounded px-4 py-1 self-center">Join</button>
        </div>

        <!-- Treatment Library -->
        <div class="bg-neutral-200 text-black rounded-lg p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-semibold mb-2">Treatment Library</h2>
                <ul class="text-sm list-disc list-inside space-y-1">
                    <li>Explore Treatments</li>
                    <li>Read Reviews</li>
                    <li>Track Effectiveness</li>
                </ul>
            </div>
            <button class="mt-6 border border-gray-600 rounded px-4 py-1 self-center">View</button>
        </div>

        <!-- Recipe Hub -->
        <div class="bg-neutral-200 text-black rounded-lg p-6 flex flex-col justify-between md:col-span-2">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold mb-2">Recipe Hub</h2>
                    <ul class="text-sm list-disc list-inside space-y-1">
                        <li>Find Recipes</li>
                        <li>Save Favorites</li>
                        <li>Share Recipes</li>
                    </ul>
                </div>
                <div class="border-l pl-6">
                    <h2 class="text-lg font-semibold mb-2">Diet Planner</h2>
                    <ul class="text-sm list-disc list-inside space-y-1">
                        <li>Food Database</li>
                        <li>Meal Logger</li>
                        <li>Personalized Tips</li>
                    </ul>
                </div>
            </div>
            <button class="mt-6 border border-gray-600 rounded px-4 py-1 self-center">View</button>
        </div>

        <!-- Analytics -->
        <div class="bg-neutral-800 text-white rounded-xl p-6 flex flex-col justify-between min-h-[220px]">
            <div>
                <h2 class="text-lg font-semibold mb-2">Analytics</h2>
                <ul class="text-sm text-gray-300 list-disc list-inside space-y-1">
                    <li>View Patterns</li>
                    <li>Progress Reports</li>
                    <li>Export Data</li>
                </ul>
            </div>
            <button class="mt-6 border border-gray-400 rounded px-4 py-1 self-center">View</button>
        </div>

        <!-- Education Center -->
        <div class="bg-neutral-800 text-white rounded-xl p-6 flex flex-col justify-between min-h-[220px]">
            <div>
                <h2 class="text-lg font-semibold mb-2">Education Center</h2>
                <ul class="text-sm text-gray-300 list-disc list-inside space-y-1">
                    <li>Learn More</li>
                    <li>Take Quizzes</li>
                    <li>Earn Badges</li>
                </ul>
            </div>
            <button class="mt-6 border border-gray-400 rounded px-4 py-1 self-center">View</button>
        </div>

        <!-- Profile & Settings -->
        <div class="bg-neutral-800 text-white rounded-xl p-6 flex flex-col justify-between min-h-[220px]">
            <div>
                <h2 class="text-lg font-semibold mb-2">Profile & Settings</h2>
                <ul class="text-sm text-gray-300 list-disc list-inside space-y-1">
                    <li>Manage Account</li>
                    <li>Set Preferences</li>
                    <li>Data Controls</li>
                </ul>
            </div>
            <button class="mt-6 border border-gray-400 rounded px-4 py-1 self-center">Setting</button>
        </div>

    </div>
</div>

</div>
@endsection
