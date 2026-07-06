<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Farm Manager</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-green-50 font-sans">

    @include('manager.layouts.sidebar')

    <div class="ml-72 min-h-screen">

        <header class="bg-white border-b border-green-100 shadow-sm px-8 py-5">
            <h1 class="text-2xl font-bold text-green-800">
                @yield('page-title', 'Manager Dashboard')
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                @yield('page-description', 'Smart Farm Management')
            </p>
        </header>

        <main class="p-8">
            @yield('content')
        </main>

    </div>

</body>
</html>