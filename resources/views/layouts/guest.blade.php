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
    <div class="min-h-screen flex flex-col justify-center items-center bg-green-50">

      <div class="text-center mb-6">

    <img
        src="{{ asset('image/logo.png') }}"
        alt="Smart Farm Logo"
        class="mx-auto"
        style="width:110px; height:110px; object-fit:contain;">

    <h1 class="text-3xl font-bold text-green-700 mt-4">
        Smart Farm Management System
    </h1>

    <p class="text-gray-600 mt-2">
        Farm Monitoring & Management Platform
    </p>

</div>

        <div class="w-full sm:max-w-md px-6 py-6 bg-white shadow-lg rounded-lg">
            {{ $slot }}
        </div>

    </div>
</body>
</html>
