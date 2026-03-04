<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
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