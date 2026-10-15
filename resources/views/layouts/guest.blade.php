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
            <div>
    <a href="{{ route('home') }}" class="flex flex-col items-center group">
        @if(request('admin'))
            <!-- Admin Login -->
            <div class="text-6xl mb-2">⚙️</div>
            <div class="text-2xl font-bold text-red-600 leading-none">Admin Panel</div>
            <div class="text-xs text-gray-500 mt-1">Administrative Access</div>
        @else
            <!-- Customer Login -->
            <div class="flex items-center gap-2">
                <span class="text-5xl">🛒</span>
                <div>
                    <div class="text-2xl font-bold text-green-600 leading-none">MiniGrocery</div>
                    <div class="text-xs text-gray-500 mt-1">Fresh • Fast • Reliable</div>
                </div>
            </div>
        @endif
    </a>
</div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
