@extends('admin.layouts.app')

@section('page-title', 'Admin Dashboard')
@section('page-description', 'Overview of the Smart Farm Management System.')

@section('content')

{{-- Welcome --}}
<div class="mb-6">
    <h2 class="text-3xl font-bold text-green-800">
        Welcome, {{ auth()->user()->name }}
    </h2>

    <p class="text-gray-500 mt-1">
        Manage users, crops, inventory and monitor overall farm operations.
    </p>
</div>

{{-- User Statistics --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-600">
        <p class="text-gray-500 text-sm">Total Users</p>
        <h2 class="text-3xl font-bold">{{ $totalUsers }}</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-600">
        <p class="text-gray-500 text-sm">Workers</p>
        <h2 class="text-3xl font-bold">{{ $totalWorkers }}</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-500">
        <p class="text-gray-500 text-sm">Managers</p>
        <h2 class="text-3xl font-bold">{{ $totalManagers }}</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-red-600">
        <p class="text-gray-500 text-sm">Admins</p>
        <h2 class="text-3xl font-bold">{{ $totalAdmins }}</h2>
    </div>

</div>

{{-- Farm Statistics --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">

    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-gray-500 text-sm">Crop Blocks</p>
        <h2 class="text-3xl font-bold text-green-700">
            {{ $totalCropBlocks }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-gray-500 text-sm">Inventory Items</p>
        <h2 class="text-3xl font-bold text-blue-700">
            {{ $totalInventory }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-gray-500 text-sm">Pest Reports</p>
        <h2 class="text-3xl font-bold text-red-600">
            {{ $totalPestReports }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-gray-500 text-sm">Total Harvest</p>
        <h2 class="text-3xl font-bold text-green-700">
            {{ number_format($totalHarvest, 2) }} KG
        </h2>
    </div>

</div>

{{-- Task Summary --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold text-green-800 mb-4">
            Task Summary
        </h2>

        <div class="flex justify-between border-b py-3">
            <span>Active Tasks</span>
            <strong>{{ $activeTasks }}</strong>
        </div>

        <div class="flex justify-between py-3">
            <span>Completed Tasks</span>
            <strong>{{ $completedTasks }}</strong>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold text-green-800 mb-4">
            System Status
        </h2>

        <p class="text-green-700 font-semibold">
            ✅ Smart Farm System Online
        </p>

        <p class="text-gray-500">
            Database Connected
        </p>

        <p class="text-gray-500">
            Last Updated: {{ now()->format('d M Y, h:i A') }}
        </p>
    </div>

</div>

{{-- Quick Actions --}}
<div class="bg-white rounded-xl shadow p-6">

    <h2 class="text-xl font-bold text-green-800 mb-5">
        Quick Actions
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <a href="{{ route('admin.users.index') }}"
           class="bg-green-700 hover:bg-green-800 text-white rounded-xl p-5 text-center transition">
            <div class="text-4xl mb-2">👤</div>
            <div class="font-semibold">Manage Users</div>
        </a>

        <a href="{{ route('admin.crops.index') }}"
           class="bg-blue-700 hover:bg-blue-800 text-white rounded-xl p-5 text-center transition">
            <div class="text-4xl mb-2">🌱</div>
            <div class="font-semibold">Manage Crops</div>
        </a>

        <a href="{{ route('admin.inventories.index') }}"
           class="bg-yellow-600 hover:bg-yellow-700 text-white rounded-xl p-5 text-center transition">
            <div class="text-4xl mb-2">📦</div>
            <div class="font-semibold">Inventory</div>
        </a>

        <a href="{{ route('admin.pests.index') }}"
           class="bg-red-600 hover:bg-red-700 text-white rounded-xl p-5 text-center transition">
            <div class="text-4xl mb-2">🐛</div>
            <div class="font-semibold">Pest Reports</div>
        </a>

    </div>

</div>

@endsection