@extends('worker.layouts.app')

@section('page-title', 'Harvest Logging')
@section('page-description', 'Submit harvest details for manager approval.')

@section('content')

@if(session('success'))
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
        <ul class="list-disc ml-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    $harvests = $harvests ?? collect();
    $cropBlocks = $cropBlocks ?? collect();
@endphp

{{-- Harvest Form --}}
<div class="bg-white rounded-xl shadow p-6 max-w-3xl mb-6">

    <h2 class="text-xl font-bold text-green-800 mb-4">
        Submit Harvest Record
    </h2>

    <form method="POST" action="{{ route('worker.harvest.store') }}">
        @csrf

        <div class="mb-4">
            <label class="text-sm font-medium">Farm Zone</label>
            <select name="crop_block_id" class="w-full rounded-lg border-gray-300 mt-1" required>
                <option value="">Select Farm Zone</option>

                @foreach($cropBlocks as $block)
                    <option value="{{ $block->id }}" {{ old('crop_block_id') == $block->id ? 'selected' : '' }}>
                        {{ $block->block_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="mb-4">
                <label class="text-sm font-medium">Harvest Date</label>
                <input type="date"
                       name="harvest_date"
                       value="{{ old('harvest_date', date('Y-m-d')) }}"
                       class="w-full rounded-lg border-gray-300 mt-1"
                       required>
            </div>

            <div class="mb-4">
                <label class="text-sm font-medium">Harvest Time</label>
                <input type="time"
                       name="harvest_time"
                       value="{{ old('harvest_time', date('H:i')) }}"
                       class="w-full rounded-lg border-gray-300 mt-1"
                       required>
            </div>

        </div>

        <div class="mb-4">
            <label class="text-sm font-medium">Yield Amount (KG)</label>
            <input type="number"
                   step="0.01"
                   name="yield_kg"
                   value="{{ old('yield_kg') }}"
                   class="w-full rounded-lg border-gray-300 mt-1"
                   required>
        </div>

        <div class="mb-4">
            <label class="text-sm font-medium">Fruit Grade</label>
            <select name="grade" class="w-full rounded-lg border-gray-300 mt-1" required>
                <option value="">Select Grade</option>
                <option value="Grade A" {{ old('grade') == 'Grade A' ? 'selected' : '' }}>Grade A</option>
                <option value="Grade B" {{ old('grade') == 'Grade B' ? 'selected' : '' }}>Grade B</option>
                <option value="Grade C" {{ old('grade') == 'Grade C' ? 'selected' : '' }}>Grade C</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="text-sm font-medium">Notes</label>
            <textarea name="notes"
                      rows="3"
                      class="w-full rounded-lg border-gray-300 mt-1"
                      placeholder="Example: Harvest from mature trees, good fruit quality...">{{ old('notes') }}</textarea>
        </div>

        <button type="submit"
                class="w-full bg-green-700 hover:bg-green-800 text-white py-2 rounded-lg">
            Submit for Manager Approval
        </button>

    </form>

</div>

{{-- Harvest Records Table --}}
<div class="bg-white rounded-xl shadow p-6">

    <h2 class="text-xl font-bold text-green-800 mb-4">
        My Harvest Records
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">Farm Zone</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Time</th>
                    <th class="px-4 py-3 text-left">Yield</th>
                    <th class="px-4 py-3 text-left">Grade</th>
                    <th class="px-4 py-3 text-left">Approval Status</th>
                    <th class="px-4 py-3 text-left">Approved By</th>
                </tr>
            </thead>

            <tbody>
                @forelse($harvests as $harvest)
                    <tr class="border-b hover:bg-green-50">

                        <td class="px-4 py-3">
                            {{ $harvest->cropBlock->block_name ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $harvest->harvest_date ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $harvest->harvest_time ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ number_format($harvest->yield_kg ?? 0, 2) }} KG
                        </td>

                        <td class="px-4 py-3">
                            {{ $harvest->grade ?? '-' }}
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

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                            No harvest records submitted yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection