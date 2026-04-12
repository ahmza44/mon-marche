<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">

    <div class="min-h-screen flex flex-col">

        <!-- Header Guest -->
        <header class="bg-red-600 shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

                <!-- Logo -->
                <a href="" class="text-white text-2xl font-bold tracking-wide">
                    MyShop
                </a>

                <!-- Nav Guest -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg border border-white text-white hover:bg-white hover:text-red-600 transition">
                        Login
                    </a>

                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-white text-red-600 font-semibold hover:bg-gray-100 transition">
                        Inscription
                    </a>
                </div>

            </div>
        </header>

        <!-- Main Content -->
        <div class="flex-1 flex items-center justify-center px-4 py-10">
            <div class="w-full max-w-md">

                <div class="text-center mb-6">
                    <a href="">
                        <x-application-logo class="w-16 h-16 mx-auto fill-current text-red-600" />
                    </a>
                    <h2 class="mt-4 text-2xl font-bold text-gray-800">Bienvenue sur MyShop</h2>
                    <p class="text-gray-500 mt-2">Connectez-vous ou créez votre compte pour continuer</p>
                </div>

                <div class="bg-white shadow-xl rounded-2xl px-6 py-8">
                    {{ $slot }}
                </div>

            </div>
        </div>

    </div>

</body>
</html>