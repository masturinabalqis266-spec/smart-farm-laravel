@extends('worker.layouts.app')

@section('page-title', 'Report Pest / Disease')
@section('page-description', 'Submit pest and disease findings from farm zones.')

@section('content')

@if(session('success'))
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow p-6 max-w-3xl">

    <form method="POST" action="{{ route('worker.pest_reports.store') }}">
        @csrf

        <label class="text-sm font-medium">Farm Zone</label>
        <select name="crop_block_id" class="w-full rounded-lg border-gray-300 mt-1 mb-4">
            @foreach($cropBlocks as $block)
                <option value="{{ $block->id }}">{{ $block->block_name }}</option>
            @endforeach
        </select>

        <label class="text-sm font-medium">Pest Type</label>
        <input type="text" name="pest_type"
               placeholder="Fruit Fly, Aphids, Fruit Borer"
               class="w-full rounded-lg border-gray-300 mt-1 mb-4">

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-medium">Temperature</label>
                <input type="number" step="0.01" name="temperature"
                       class="w-full rounded-lg border-gray-300 mt-1 mb-4">
            </div>

            <div>
                <label class="text-sm font-medium">Humidity</label>
                <input type="number" step="0.01" name="humidity"
                       class="w-full rounded-lg border-gray-300 mt-1 mb-4">
            </div>
        </div>

        <label class="text-sm font-medium">Severity</label>
        <select name="severity" class="w-full rounded-lg border-gray-300 mt-1 mb-4">
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>

        <label class="text-sm font-medium">Remarks</label>
        <textarea name="remarks" rows="3"
                  class="w-full rounded-lg border-gray-300 mt-1 mb-4"></textarea>

        <button class="w-full bg-red-600 text-white py-2 rounded-lg">
            Submit Pest Report
        </button>
    </form>

</div>

@endsection