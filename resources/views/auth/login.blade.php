<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-500 to-indigo-600">
        <div class="w-full max-w-md p-8 space-y-6 bg-white shadow-xl rounded-2xl">
            <h2 class="text-3xl font-bold text-center text-gray-800">Login ke Dompet Pintar</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                    </label>

                    <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit" class="w-full px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 transition">
                        Masuk
                    </button>
                </div>
            </form>

            <div class="relative mt-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">atau login dengan</span>
                </div>
            </div>

            <!-- Login with Google -->
            <div>
                <a href="{{ route('login.google') }}" class="flex items-center justify-center gap-2 w-full px-4 py-2 text-white bg-red-600 hover:bg-red-700 transition rounded-md">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21.805 10.023h-9.765v3.954h5.626c-.237 1.343-1.062 2.482-2.251 3.187l3.63 2.819c2.131-1.964 3.377-4.88 3.377-8.296 0-.673-.063-1.327-.178-1.94z" />
                        <path d="M12.04 22c2.7 0 4.963-.89 6.617-2.408l-3.63-2.819c-1.006.675-2.295 1.073-3.713 1.073-2.85 0-5.265-1.925-6.128-4.51h-3.68v2.837c1.648 3.26 5.053 5.827 9.534 5.827z" />
                        <path d="M5.912 13.336a7.613 7.613 0 0 1 0-4.671v-2.837h-3.68a10.991 10.991 0 0 0 0 10.345l3.68-2.837z" />
                        <path d="M12.04 5.66c1.47 0 2.787.505 3.828 1.495l2.871-2.871c-1.649-1.536-3.911-2.494-6.699-2.494-4.48 0-8.005 2.567-9.534 5.827l3.68 2.837c.863-2.585 3.278-4.51 6.128-4.51z" />
                    </svg>
                    Login dengan Google
                </a>
            </div>

            <!-- Register link -->
            <p class="text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Daftar sekarang</a>
            </p>
        </div>
    </div>
</x-guest-layout>
