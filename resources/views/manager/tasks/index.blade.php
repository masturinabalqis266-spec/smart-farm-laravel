@extends('manager.layouts.app')

@section('page-title', 'Assign Task')
@section('page-description', 'Create and assign daily farm tasks to workers.')

@section('content')

@if(session('success'))
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow p-6 mb-6">
    <h2 class="text-xl font-bold text-green-800 mb-4">Create New Task</h2>

    <form method="POST" action="{{ route('manager.tasks.store') }}">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-medium">Task Name</label>
                <input type="text" name="task_name" class="w-full rounded-lg border-gray-300 mt-1">
            </div>

            <div>
                <label class="text-sm font-medium">Assign Worker</label>
                <select name="user_id" class="w-full rounded-lg border-gray-300 mt-1">
                    @foreach($workers as $worker)
                        <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm font-medium">Farm Zone</label>
                <select name="crop_block_id" class="w-full rounded-lg border-gray-300 mt-1">
                    @foreach($cropBlocks as $block)
                        <option value="{{ $block->id }}">{{ $block->block_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm font-medium">Task Date</label>
                <input type="date" name="task_date" class="w-full rounded-lg border-gray-300 mt-1">
            </div>

            <div>
                <label class="text-sm font-medium">Status</label>
                <select name="status" class="w-full rounded-lg border-gray-300 mt-1">
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Done">Done</option>
                </select>
            </div>
        </div>

        <div class="mt-4">
            <label class="text-sm font-medium">Description</label>
            <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 mt-1"></textarea>
        </div>

        <button class="mt-4 bg-green-700 text-white px-6 py-2 rounded-lg">
            Assign Task
        </button>
    </form>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-green-800">Active Tasks</h2>

        <a href="{{ route('manager.tasks.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm">
            Reset
        </a>
    </div>

    <form method="GET" action="{{ route('manager.tasks.index') }}">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-green-700 text-white">
                    <th class="px-4 py-3 text-left">Task</th>
                    <th class="px-4 py-3 text-left">Worker</th>
                    <th class="px-4 py-3 text-left">Zone</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Action</th>
                </tr>

                {{-- Filter Row --}}
                <tr class="bg-green-50">
                    <th class="px-3 py-2">
                        <input type="text"
                               name="task_name"
                               value="{{ request('task_name') }}"
                               placeholder="Search task"
                               class="w-full rounded-lg border-gray-300 text-sm">
                    </th>

                    <th class="px-3 py-2">
                        <select name="user_id" class="w-full rounded-lg border-gray-300 text-sm">
                            <option value="">All Workers</option>
                            @foreach($workers as $worker)
                                <option value="{{ $worker->id }}" {{ request('user_id') == $worker->id ? 'selected' : '' }}>
                                    {{ $worker->name }}
                                </option>
                            @endforeach
                        </select>
                    </th>

                    <th class="px-3 py-2">
                        <select name="crop_block_id" class="w-full rounded-lg border-gray-300 text-sm">
                            <option value="">All Zones</option>
                            @foreach($cropBlocks as $block)
                                <option value="{{ $block->id }}" {{ request('crop_block_id') == $block->id ? 'selected' : '' }}>
                                    {{ $block->block_name }}
                                </option>
                            @endforeach
                        </select>
                    </th>

                    <th class="px-3 py-2">
                        <input type="date"
                               name="task_date"
                               value="{{ request('task_date') }}"
                               class="w-full rounded-lg border-gray-300 text-sm">
                    </th>

                    <th class="px-3 py-2">
                        <select name="status" class="w-full rounded-lg border-gray-300 text-sm">
                            <option value="">All Status</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Done" {{ request('status') == 'Done' ? 'selected' : '' }}>Done</option>
                        </select>
                    </th>

                    <th class="px-3 py-2">
                        <button type="submit"
                                class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg text-sm">
                            Filter
                        </button>
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse($tasks as $task)
                    <tr class="border-b hover:bg-green-50">
                        <td class="px-4 py-3">{{ $task->task_name }}</td>
                        <td class="px-4 py-3">{{ $task->user->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $task->cropBlock->block_name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $task->task_date }}</td>
                        <td class="px-4 py-3">
                            @if($task->status == 'Done')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                    Done
                                </span>
                            @elseif($task->status == 'In Progress')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                                    In Progress
                                </span>
                            @else
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs">
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">-</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            No tasks found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </form>
</div>

@endsection