<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Farm Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-green-50 font-sans">

<div class="flex">

    @include('admin.layouts.sidebar')

    <div class="flex-1 ml-72">

        <header class="bg-white border-b border-green-100 shadow-sm px-8 py-5 sticky top-0 z-10">
            <h1 class="text-2xl font-bold text-green-800">
                @yield('page-title', 'Admin Dashboard')
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                @yield('page-description', 'Smart Farm Management System')
            </p>
        </header>

        <main class="p-8">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>