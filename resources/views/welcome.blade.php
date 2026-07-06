<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Farm Management System</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-green-100 to-green-300 min-h-screen">

<div class="flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-2xl rounded-3xl p-12 w-full max-w-3xl text-center">

        <!-- Logo -->
        <img src="{{ asset('image/logo.png') }}"
             class="w-32 h-32 mx-auto mb-6"
             alt="Logo">

        <!-- Title -->
        <h1 class="text-5xl font-bold text-green-700">
            Smart Farm
        </h1>

        <h2 class="text-2xl font-semibold text-green-600 mt-2">
            Management System
        </h2>

        <p class="text-gray-500 mt-5 text-lg">
            Welcome to Din Star Farm
        </p>

        <p class="text-gray-400 mt-2">
            Smart Monitoring • Smart Farming • Better Harvest
        </p>

        <!-- Buttons -->
        <div class="mt-10 flex justify-center gap-6">

            <a href="{{ route('login') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl text-lg font-semibold shadow">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="bg-white border-2 border-green-600 hover:bg-green-50 text-green-700 px-8 py-3 rounded-xl text-lg font-semibold shadow">
                Register
            </a>

        </div>

    </div>

</div>

</body>
</html>