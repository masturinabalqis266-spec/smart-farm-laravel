@extends('admin.layouts.app')

@section('page-title', 'Add Inventory Item')
@section('page-description', 'Register a new master consumable item.')

@section('content')

<div class="bg-white rounded-2xl shadow border border-green-100 p-8 max-w-2xl">

    <form method="POST" action="{{ route('admin.inventories.store') }}">
        @csrf

        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-2">Item Name</label>
            <input type="text" name="item_name" value="{{ old('item_name') }}"
                   placeholder="Example: Organic Fertilizer"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">
            @error('item_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-2">Category</label>
            <select name="category"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">
                <option value="Fertilizers">Fertilizers</option>
                <option value="Pesticides">Pesticides</option>
                <option value="Packaging">Packaging</option>
                <option value="Tools">Tools</option>
                <option value="Other">Other</option>
            </select>
            @error('category') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-2">Unit</label>
            <input type="text" name="unit" value="{{ old('unit') }}"
                   placeholder="Example: kg, litre, bottle, pack, unit"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">
            @error('unit') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" rows="4"
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500"
                      placeholder="Optional item description">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3">
            <button class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">
                Save Item
            </button>

            <a href="{{ route('admin.inventories.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                Cancel
            </a>
        </div>

        <div class="mb-5">
    <label class="block font-medium mb-2">Current Stock</label>
    <input type="number" name="current_stock" value="{{ old('current_stock', $inventory->current_stock ?? 0) }}"
           class="w-full border-gray-300 rounded-lg">
</div>

<div class="mb-5">
    <label class="block font-medium mb-2">Minimum Stock Level</label>
    <input type="number" name="minimum_stock" value="{{ old('minimum_stock', $inventory->minimum_stock ?? 0) }}"
           class="w-full border-gray-300 rounded-lg">
</div>

<div class="mb-5">
    <label class="block font-medium mb-2">Unit</label>
    <input type="text" name="unit" value="{{ old('unit', $inventory->unit ?? '') }}"
           placeholder="kg, litre, pcs, unit"
           class="w-full border-gray-300 rounded-lg">
</div>

<div class="mb-5">
    <label class="block font-medium mb-2">Supplier</label>
    <input type="text" name="supplier" value="{{ old('supplier', $inventory->supplier ?? '') }}"
           class="w-full border-gray-300 rounded-lg">
</div>

    </form>

</div>

@endsection