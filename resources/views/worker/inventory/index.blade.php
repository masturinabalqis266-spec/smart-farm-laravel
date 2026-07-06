@extends('worker.layouts.app')

@section('page-title', 'Update Inventory Usage')
@section('page-description', 'Log consumable items used during field work.')

@section('content')

@if(session('success'))
    <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
        {{ session('error') }}
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
    $inventories = $inventories ?? collect();
    $usages = $usages ?? collect();
@endphp

{{-- Inventory Usage Form --}}
<div class="bg-white rounded-xl shadow p-6 max-w-3xl mb-6">

    <h2 class="text-xl font-bold text-green-800 mb-4">
        Log Inventory Usage
    </h2>

    <form method="POST" action="{{ route('worker.inventory_usages.store') }}">
        @csrf

        <div class="mb-4">
            <label class="text-sm font-medium">Consumable Item</label>
            <select name="inventory_id" class="w-full rounded-lg border-gray-300 mt-1" required>
                <option value="">Select Item</option>

                @foreach($inventories as $item)
                    <option value="{{ $item->id }}" {{ old('inventory_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->item_name }} 
                        @if($item->unit)
                            - Unit: {{ $item->unit }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="text-sm font-medium">Quantity Used</label>
            <input type="number"
                   name="quantity_used"
                   value="{{ old('quantity_used') }}"
                   class="w-full rounded-lg border-gray-300 mt-1"
                   required>
        </div>

        <div class="mb-4">
            <label class="text-sm font-medium">Remarks</label>
            <textarea name="remarks"
                      rows="3"
                      class="w-full rounded-lg border-gray-300 mt-1"
                      placeholder="Example: Used for pest control at North Block A...">{{ old('remarks') }}</textarea>
        </div>

        <button type="submit"
                class="w-full bg-green-700 hover:bg-green-800 text-white py-2 rounded-lg">
            Save Inventory Usage
        </button>
    </form>

</div>

{{-- Inventory Usage Table --}}
<div class="bg-white rounded-xl shadow p-6">

    <h2 class="text-xl font-bold text-green-800 mb-4">
        My Inventory Usage Records
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">Item Name</th>
                    <th class="px-4 py-3 text-left">Category</th>
                    <th class="px-4 py-3 text-left">Quantity Used</th>
                    <th class="px-4 py-3 text-left">Unit</th>
                    <th class="px-4 py-3 text-left">Remarks</th>
                    <th class="px-4 py-3 text-left">Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($usages as $usage)
                    <tr class="border-b hover:bg-green-50">
                        <td class="px-4 py-3">
                            {{ $usage->inventory->item_name ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $usage->inventory->category ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $usage->quantity_used }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $usage->inventory->unit ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $usage->remarks ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $usage->created_at ? $usage->created_at->format('d M Y, h:i A') : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            No inventory usage records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection