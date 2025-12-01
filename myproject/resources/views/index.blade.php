<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autocare Compass</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">

    <!-- NAVBAR -->
    <nav class="w-full bg-white shadow-sm px-8 py-4 flex items-center justify-between">

        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="/images/logo2.png" alt="Logo" class="w-8 h-8">
        </div>

        <!-- Menu -->
        <div class="hidden md:flex items-center space-x-6 text-gray-700">
            <a href="#" class="hover:text-black">Service</a>
            <a href="#" class="hover:text-black">Solutions</a>
            <a href="#" class="hover:text-black">Community</a>
            <a href="#" class="hover:text-black">Contact</a>
            <a href="#" class="hover:text-black">Help</a>
        </div>

        <!-- Auth Buttons -->
        <div class="flex items-center space-x-3">
            <a href="/login" class="px-4 py-1 border rounded-md hover:bg-gray-100">Sign in</a>
            <a href="/register" class="px-4 py-1 bg-black text-white rounded-md hover:bg-gray-800">Register</a>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="w-full flex flex-col items-center text-center py-20">

        <!-- Center Logo -->
        <img src="/images/logo.png" class="w-24 mb-6" alt="Logo">

        <!-- Title -->
        <h1 class="text-4xl font-extrabold text-gray-900 mb-2">
            Autocare Compass
        </h1>

        <!-- Subtitle -->
        <p class="text-gray-500 text-lg mb-6">
            Your guide to managing autoimmune conditions
        </p>

        <!-- Button -->
        <a href="#"
           class="mt-4 px-8 py-2 bg-black text-white text-lg rounded-md hover:bg-gray-800">
            Explore
        </a>
    </section>

</body>
</html>
