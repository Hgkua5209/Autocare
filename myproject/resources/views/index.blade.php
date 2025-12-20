<!DOCTYPE html>
<html lang="en">
    <!-- test -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autocare Compass</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">
    <x-app-layout>
        <section class="w-full flex flex-col items-center text-center py-20 bg-white">

            <img src="/images/logo.png" class="w-24 mb-6" alt="Logo">

            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">
                Autocare Compass
            </h1>

            <p class="text-gray-500 text-lg mb-6">
                Your guide to managing autoimmune conditions
            </p>

            <a href="{{ route('checksurvey') }}"
            class="mt-4 px-8 py-2 bg-black text-white text-lg rounded-md hover:bg-gray-800 transition">
                Explore
            </a>
        </section>
    </x-app-layout>
</body>
</html>
