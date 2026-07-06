@extends('worker.layouts.app')

@section('page-title', 'View Tasks')
@section('page-description', 'View and update assigned daily farm tasks.')

@section('content')

@if(session('success'))
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow p-6">
    <table class="w-full text-sm">
        <thead class="bg-green-700 text-white">
            <tr>
                <th class="px-4 py-3 text-left">Task</th>
                <th class="px-4 py-3 text-left">Zone</th>
                <th class="px-4 py-3 text-left">Date</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Update</th>
            </tr>
        </thead>

        <tbody>
            @forelse($tasks as $task)
                <tr class="border-b hover:bg-green-50">
                    <td class="px-4 py-3">{{ $task->task_name }}</td>
                    <td class="px-4 py-3">{{ $task->cropBlock->block_name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $task->task_date }}</td>
                    <td class="px-4 py-3">{{ $task->status }}</td>
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('worker.tasks.status', $task->id) }}" class="flex gap-2">
                            @csrf
                            @method('PUT')

                            <select name="status" class="rounded-lg border-gray-300 text-sm">
                                <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                            </select>

                            <button class="bg-green-700 text-white px-3 py-2 rounded-lg">
                                Save
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                        No tasks assigned.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection