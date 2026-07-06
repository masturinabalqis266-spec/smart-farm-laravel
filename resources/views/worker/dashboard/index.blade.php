@extends('worker.layouts.app')

@section('page-title', 'Worker Dashboard')
@section('page-description', 'Overview of your farm activities and assigned tasks.')

@section('content')

<div class="mb-6">
    <h2 class="text-3xl font-bold text-green-800">
        Welcome, {{ auth()->user()->name }}
    </h2>

    <p class="text-gray-500 mt-1">
        View your tasks, harvest records, pest reports and inventory usage.
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-600">
        <p class="text-gray-500 text-sm">Total Tasks</p>
        <h2 class="text-3xl font-bold">{{ $totalTasks }}</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-500">
        <p class="text-gray-500 text-sm">Pending Tasks</p>
        <h2 class="text-3xl font-bold">{{ $pendingTasks }}</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-600">
        <p class="text-gray-500 text-sm">Completed Tasks</p>
        <h2 class="text-3xl font-bold">{{ $completedTasks }}</h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-red-600">
        <p class="text-gray-500 text-sm">Pest Reports</p>
        <h2 class="text-3xl font-bold">{{ $totalPestReports }}</h2>
    </div>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold text-green-800 mb-4">
            Farm Activity Summary
        </h2>

        <div class="flex justify-between border-b py-3">
            <span>Total Harvest</span>
            <strong>{{ number_format($totalHarvest, 2) }} KG</strong>
        </div>

        <div class="flex justify-between py-3">
            <span>Inventory Usage Records</span>
            <strong>{{ $totalInventoryUsages }}</strong>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold text-green-800 mb-4">
            System Status
        </h2>

        <p class="text-green-700 font-semibold">
            ✅ Worker Panel Active
        </p>

        <p class="text-gray-500 mt-2">
            Last Updated: {{ now()->format('d M Y, h:i A') }}
        </p>
    </div>

</div>

<div class="bg-white rounded-xl shadow p-6 mb-6">

    <h2 class="text-xl font-bold text-green-800 mb-5">
        Quick Actions
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <a href="{{ route('worker.tasks.index') }}"
           class="bg-green-700 hover:bg-green-800 text-white rounded-xl p-5 text-center">
            <div class="text-4xl mb-2">📋</div>
            <div class="font-semibold">My Tasks</div>
        </a>

        <a href="{{ route('worker.harvest.index') }}"
           class="bg-blue-700 hover:bg-blue-800 text-white rounded-xl p-5 text-center">
            <div class="text-4xl mb-2">🍈</div>
            <div class="font-semibold">Harvest</div>
        </a>

        <a href="{{ route('worker.pest_reports.index') }}"
           class="bg-red-600 hover:bg-red-700 text-white rounded-xl p-5 text-center">
            <div class="text-4xl mb-2">🐛</div>
            <div class="font-semibold">Pest Report</div>
        </a>

        <a href="{{ route('worker.inventory.index') }}"
           class="bg-yellow-600 hover:bg-yellow-700 text-white rounded-xl p-5 text-center">
            <div class="text-4xl mb-2">📦</div>
            <div class="font-semibold">Inventory</div>
        </a>

    </div>

</div>

<div class="bg-white rounded-xl shadow p-6">

    <h2 class="text-xl font-bold text-green-800 mb-4">
        Recent Tasks
    </h2>

    <table class="w-full">
        <thead class="bg-green-700 text-white">
            <tr>
                <th class="px-4 py-3 text-left">Task</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Date</th>
            </tr>
        </thead>

        <tbody>
            @forelse($recentTasks as $task)
                <tr class="border-b hover:bg-green-50">
                    <td class="px-4 py-3">{{ $task->title ?? $task->task_name }}</td>
                    <td class="px-4 py-3">{{ $task->status }}</td>
                    <td class="px-4 py-3">{{ $task->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-5 text-gray-500">
                        No recent tasks found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection