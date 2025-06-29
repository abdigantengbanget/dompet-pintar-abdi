<!-- resources/views/auth/login.blade.php (Diperbaiki) -->
<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dompet Pintar</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-100 dark:bg-gray-900">
    <main class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
        <!-- Logo -->
        <div>
            <a href="/" class="flex items-center space-x-3">
                <svg class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m12 3V9" />
                </svg>
                <span class="text-2xl font-bold text-gray-800 dark:text-gray-200">Dompet Pintar</span>
            </a>
        </div>

        <!-- Form Card -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-xl overflow-hidden sm:rounded-2xl">

            <!-- Session Status (contoh: untuk reset password) -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Menampilkan semua error validasi di atas form -->
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                    <p class="font-bold">Oops! Terjadi kesalahan:</p>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="block mt-1 w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 transition">
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Kata Sandi</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="block mt-1 w-full rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 transition">
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 dark:bg-gray-900 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Ingat saya</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                        Masuk
                    </button>
                </div>
            </form>

            <div class="flex items-center my-6">
                <hr class="flex-grow border-gray-300 dark:border-gray-600">
                <span class="mx-4 text-sm font-semibold text-gray-500">ATAU</span>
                <hr class="flex-grow border-gray-300 dark:border-gray-600">
            </div>

            <a href="{{ route('auth.google') }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                <svg class="w-5 h-5 mr-2 -ml-1" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.42-4.55H24v8.51h12.8c-.57 5.4-4.36 9.38-9.8 9.38-5.88 0-10.68-4.8-10.68-10.68s4.8-10.68 10.68-10.68c3.36 0 6.17 1.42 8.08 3.24l6.16-6.16C36.85 5.25 30.98 2 24 2 11.98 2 2.19 8.53 2.19 18.5S11.98 35 24 35c8.43 0 15.22-2.82 20.1-8.52 3.53-3.9 4.88-9.45 4.88-11.93z"></path>
                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 21.05 0 24s.92 7.54 2.56 10.78l7.97-6.19z"></path>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.52-5.81c-2.15 1.45-4.92 2.3-8.37 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                    <path fill="none" d="M0 0h48v48H0z"></path>
                </svg>
                Masuk dengan Google
            </a>
        </div>
    </main>
</body>
</html>