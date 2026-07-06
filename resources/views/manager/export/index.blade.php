@extends('manager.layouts.app')

@section('page-title', 'Export Reports')
@section('page-description', 'Generate downloadable farm operation reports.')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold text-green-800 mb-3">Harvest Report</h2>
        <p class="text-gray-600 mb-4">Export harvest records including yield, grade and worker details.</p>

        <a href="{{ route('manager.export.harvest.pdf') }}"
           target="_blank"
           class="block text-center w-full bg-green-700 hover:bg-green-800 text-white py-2 rounded-lg">
            Print / Save PDF
        </a>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold text-green-800 mb-3">Pest Report</h2>
        <p class="text-gray-600 mb-4">Export pest and disease report history with severity levels.</p>

        <a href="{{ route('manager.export.pest.pdf') }}"
           target="_blank"
           class="block text-center w-full bg-green-700 hover:bg-green-800 text-white py-2 rounded-lg">
            Print / Save PDF
        </a>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold text-green-800 mb-3">Inventory Report</h2>
        <p class="text-gray-600 mb-4">Export inventory usage and consumable stock records.</p>

        <a href="{{ route('manager.export.inventory.pdf') }}"
           target="_blank"
           class="block text-center w-full bg-green-700 hover:bg-green-800 text-white py-2 rounded-lg">
            Print / Save PDF
        </a>
    </div>

</div>

@endsection