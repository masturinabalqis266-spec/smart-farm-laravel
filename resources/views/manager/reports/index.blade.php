@extends('manager.layouts.app')

@section('page-title', 'Review Pest Reports')
@section('page-description', 'Review pest reports submitted by workers.')

@section('content')

@if(session('success'))
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow p-6">

    <h2 class="text-xl font-bold text-green-800 mb-4">
        Worker Pest Reports
    </h2>

    <table class="w-full text-sm">
        <thead class="bg-green-700 text-white">
            <tr>
                <th class="px-4 py-3 text-left">Worker</th>
                <th class="px-4 py-3 text-left">Farm Zone</th>
                <th class="px-4 py-3 text-left">Pest Type</th>
                <th class="px-4 py-3 text-left">Temperature</th>
                <th class="px-4 py-3 text-left">Humidity</th>
                <th class="px-4 py-3 text-left">Severity</th>
                <th class="px-4 py-3 text-left">Remarks</th>
                <th class="px-4 py-3 text-left">Date</th>
                <th class="px-4 py-3 text-left">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($reports as $report)
                <tr class="border-b hover:bg-green-50">
                    <td class="px-4 py-3">
                        {{ $report->user->name ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $report->cropBlock->block_name ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $report->pest_type }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $report->temperature ?? '-' }} °C
                    </td>

                    <td class="px-4 py-3">
                        {{ $report->humidity ?? '-' }} %
                    </td>

                    <td class="px-4 py-3">
                        @if($report->severity == 'High')
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                                High
                            </span>
                        @elseif($report->severity == 'Medium')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                                Medium
                            </span>
                        @else
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                Low
                            </span>
                        @endif
                    </td>

                    <td class="px-4 py-3">
                        {{ $report->remarks ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $report->created_at->format('d M Y') }}
                    </td>

                    <td class="px-4 py-3">
                    <form method="POST" action="{{ route('manager.reports.update', $report->id) }}">
                        @csrf
                        @method('PUT')

                        <select name="severity" class="rounded-lg border-gray-300 text-sm mb-2">
                            <option value="Low" {{ $report->severity == 'Low' ? 'selected' : '' }}>Low</option>
                            <option value="Medium" {{ $report->severity == 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option value="High" {{ $report->severity == 'High' ? 'selected' : '' }}>High</option>
                        </select>

                        <button type="submit"
                                class="bg-green-700 hover:bg-green-800 text-white px-3 py-1 rounded-lg">
                            Review
                        </button>
                    </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="px-4 py-6 text-center text-gray-500">
                        No pest reports found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection