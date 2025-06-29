<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dompet Pintar') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="min-h-screen">
        
        @auth
            @include('layouts.navigation')
        @endauth

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <footer class="text-center text-gray-500 dark:text-gray-400 py-6 text-sm">
        © {{ date('Y') }} Dompet Pintar. Dibuat oleh Abdi Nurhaqqin.
    </footer>
    
    @stack('scripts') <!-- Tambahkan ini untuk script per halaman (seperti Chart.js) -->
</body>
</html>