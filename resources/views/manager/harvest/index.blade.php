@extends('manager.layouts.app')

@section('page-title', 'Manage Harvest')
@section('page-description', 'View, filter and analyze harvest records submitted by workers.')

@section('content')

{{-- Harvest Statistics --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-600">
        <p class="text-gray-500 text-sm">Total Records</p>
        <h2 class="text-3xl font-bold text-green-700">
            {{ $totalRecords }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-600">
        <p class="text-gray-500 text-sm">Total Yield</p>
        <h2 class="text-3xl font-bold text-blue-700">
            {{ number_format($totalYield, 2) }} KG
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-500">
        <p class="text-gray-500 text-sm">Average Yield</p>
        <h2 class="text-3xl font-bold text-yellow-600">
            {{ number_format($averageYield, 2) }} KG
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-purple-500">
        <p class="text-gray-500 text-sm">Grade A Records</p>
        <h2 class="text-3xl font-bold text-purple-700">
            {{ $gradeARecords }}
        </h2>
    </div>

</div>

{{-- Filter --}}
<div class="bg-white rounded-xl shadow p-6 mb-6">

    <h2 class="text-xl font-bold text-green-800 mb-4">
        Filter Harvest Records
    </h2>

    <form method="GET" action="{{ route('manager.harvest.index') }}">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div>
                <label class="block text-sm font-medium mb-1">Grade</label>
                <select name="grade" class="w-full rounded-lg border-gray-300">
                    <option value="">All Grades</option>
                    <option value="Grade A" {{ request('grade') == 'Grade A' ? 'selected' : '' }}>Grade A</option>
                    <option value="Grade B" {{ request('grade') == 'Grade B' ? 'selected' : '' }}>Grade B</option>
                    <option value="Grade C" {{ request('grade') == 'Grade C' ? 'selected' : '' }}>Grade C</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Farm Zone</label>
                <select name="crop_block_id" class="w-full rounded-lg border-gray-300">
                    <option value="">All Zones</option>

                    @foreach($cropBlocks as $block)
                        <option value="{{ $block->id }}" {{ request('crop_block_id') == $block->id ? 'selected' : '' }}>
                            {{ $block->block_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">From Date</label>
                <input type="date"
                       name="date_from"
                       value="{{ request('date_from') }}"
                       class="w-full rounded-lg border-gray-300">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">To Date</label>
                <input type="date"
                       name="date_to"
                       value="{{ request('date_to') }}"
                       class="w-full rounded-lg border-gray-300">
            </div>

        </div>

        <div class="mt-5 flex gap-3">
            <button type="submit"
                    class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">
                Filter
            </button>

            <a href="{{ route('manager.harvest.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg">
                Reset
            </a>
        </div>

    </form>

</div>

{{-- Harvest Table --}}
<div class="bg-white rounded-xl shadow p-6">

    <h2 class="text-xl font-bold text-green-800 mb-4">
        Harvest Records
    </h2>

    <table class="w-full text-sm">
        <thead class="bg-green-700 text-white">
            <tr>
                <th class="px-4 py-3 text-left">Worker</th>
                <th class="px-4 py-3 text-left">Farm Zone</th>
                <th class="px-4 py-3 text-left">Yield</th>
                <th class="px-4 py-3 text-left">Grade</th>
                <th class="px-4 py-3 text-left">Notes</th>
                <th class="px-4 py-3 text-left">Date</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Approved By</th>
                <th class="px-4 py-3 text-left">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($harvests as $harvest)
                <tr class="border-b hover:bg-green-50">
                    <td class="px-4 py-3">
                        {{ $harvest->user->name ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $harvest->cropBlock->block_name ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ number_format($harvest->yield_kg, 2) }} KG
                    </td>

                    <td class="px-4 py-3">
                        {{ $harvest->grade }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $harvest->notes ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $harvest->created_at->format('d M Y') }}
                    </td>
                    <td class="px-4 py-3">
                    @if($harvest->approval_status == 'Approved')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                            Approved
                        </span>
                    @elseif($harvest->approval_status == 'Rejected')
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
                            Rejected
                        </span>
                    @else
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                            Pending
                        </span>
                    @endif
                </td>

                <td class="px-4 py-3">
                    {{ $harvest->approvedBy->name ?? '-' }}
                </td>

                <td class="px-4 py-3">
                    @if($harvest->approval_status == 'Pending')
                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('manager.harvest.approve', $harvest->id) }}">
                                @csrf
                                @method('PUT')
                                <button class="bg-green-700 hover:bg-green-800 text-white px-3 py-1 rounded text-xs">
                                    Approve
                                </button>
                            </form>

                            <form method="POST" action="{{ route('manager.harvest.reject', $harvest->id) }}">
                                @csrf
                                @method('PUT')
                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                    Reject
                                </button>
                            </form>
                        </div>
                    @else
                        -
                    @endif
                </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                        No harvest records found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection