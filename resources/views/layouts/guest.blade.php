<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
    <footer class="bg-gray-100 border-t mt-10">
        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row items-center justify-between text-sm text-gray-600">

            <!-- Left -->
            <div class="mb-3 md:mb-0">
                © {{ date('Y') }} <span class="font-semibold text-gray-800">AdminPanel</span>. All rights reserved.
            </div>

            <!-- Center Links -->
            <div class="flex space-x-6">
                <a href="#" class="hover:text-blue-600 transition">Privacy Policy</a>
                <a href="#" class="hover:text-blue-600 transition">Terms</a>
                <a href="#" class="hover:text-blue-600 transition">Support</a>
            </div>

            <!-- Right -->
            <div class="mt-3 md:mt-0 text-gray-500">
                Built with ❤️ using Laravel
            </div>

        </div>
    </footer>
</body>

</html>