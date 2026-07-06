@extends('manager.layouts.app')

@section('page-title', 'Manager Dashboard')
@section('page-description', 'Overview of farm operations, tasks, crops, reports and harvest.')

@section('content')

<div class="mb-6">
    <h2 class="text-3xl font-bold text-green-800">
        Welcome, {{ auth()->user()->name }}
    </h2>

    <p class="text-gray-500 mt-1">
        Manage task assignments, crop monitoring, pest reports and harvest progress.
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-600">
        <p class="text-gray-500 text-sm">Total Tasks</p>
        <h2 class="text-3xl font-bold">{{ $totalTasks ?? 0 }}</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-500">
        <p class="text-gray-500 text-sm">Pending Tasks</p>
        <h2 class="text-3xl font-bold">{{ $pendingTasks ?? 0 }}</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-red-600">
        <p class="text-gray-500 text-sm">Pest Reports</p>
        <h2 class="text-3xl font-bold">{{ $totalPestReports ?? 0 }}</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-600">
        <p class="text-gray-500 text-sm">Total Harvest</p>
        <h2 class="text-3xl font-bold">{{ number_format($totalHarvest ?? 0, 2) }} KG</h2>
    </div>

</div>

<div class="bg-white rounded-xl shadow p-6 mb-6">

    <h2 class="text-xl font-bold text-green-800 mb-5">
        Quick Actions
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <a href="{{ route('manager.tasks.index') }}"
           class="bg-green-700 hover:bg-green-800 text-white rounded-xl p-5 text-center">
            <div class="text-4xl mb-2">✅</div>
            <div class="font-semibold">Assign Task</div>
        </a>

        <a href="{{ route('manager.crops.index') }}"
           class="bg-blue-700 hover:bg-blue-800 text-white rounded-xl p-5 text-center">
            <div class="text-4xl mb-2">🌿</div>
            <div class="font-semibold">Monitor Crop</div>
        </a>

        <a href="{{ route('manager.reports.index') }}"
           class="bg-red-600 hover:bg-red-700 text-white rounded-xl p-5 text-center">
            <div class="text-4xl mb-2">🐛</div>
            <div class="font-semibold">Review Report</div>
        </a>

        <a href="{{ route('manager.analytics.index') }}"
           class="bg-yellow-600 hover:bg-yellow-700 text-white rounded-xl p-5 text-center">
            <div class="text-4xl mb-2">📈</div>
            <div class="font-semibold">Analytics</div>
        </a>

    </div>

</div>

@endsection