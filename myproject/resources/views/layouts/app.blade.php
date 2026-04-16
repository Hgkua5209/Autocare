<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body>

<div class="dashboard-container">

    <!-- SIDEBAR -->
    @include('layouts.navigation')

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
@yield('content')
        </main>

    </div>

</div>

<style>
/* Sidebar */
.sidebar {
    width: 260px;
    background: white;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    z-index: 100;
    position: fixed;
    height: 100vh;
    overflow-y: auto;
}
body {
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif !important;
}
.logo {
    padding: 25px 20px;
    border-bottom: 1px solid #e2e8f0;
    text-align: center;
}
.main-content {
    margin-left: 260px;
    width: calc(100% - 260px);
    padding: 20px;
}
.logo h1 {
    color: #667eea;
    font-size: 1.6rem;
    font-weight: 650 !important;
}

.logo span {
    color: #764ba2;
}

.nav-menu {
    padding: 20px 0;
}

.nav-item {
    display: flex;
    align-items: center;
    padding: 14px 25px;
    color: #64748b;
    text-decoration: none;
    transition: none;
    border-left: 4px solid transparent;
}

.nav-item:hover, .nav-item.active {
    background: #f1f5ff;
    color: #667eea;
    border-left-color: #667eea;
}

.nav-item i {
    width: 24px;
    margin-right: 12px;
    font-size: 1.1rem;
}

.user-profile {
    padding: 20px;
    border-top: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    margin-top: auto;
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    margin-right: 12px;
}

.logo {
    padding: 25px 20px;
    border-bottom: 1px solid #e2e8f0;
    text-align: center;
}

.logo span {
    color: #764ba2;
}


</style>

</body>
</html>
