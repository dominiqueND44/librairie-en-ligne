<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Librairie Élégante') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,700|figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-800 antialiased bg-gray-50">
<div class="min-h-screen flex flex-col items-center justify-center p-4">
    <!-- Logo réduit -->
    <div class="mb-8">
        <a href="/">
            <img src="{{ asset('images/librairie.png') }}"
                 alt="Logo Librairie"
                 class="h-20 w-auto">
        </a>
    </div>

    <!-- Carte du formulaire -->
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        {{ $slot }}
    </div>

    <!-- Pied de page léger -->
    <div class="mt-8 text-xs text-gray-400">
        &copy; {{ date('Y') }} Librairie Élégante
    </div>
</div>
</body>
</html>
