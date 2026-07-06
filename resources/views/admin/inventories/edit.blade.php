@extends('admin.layouts.app')

@section('page-title', 'Edit Inventory')
@section('page-description', 'Update inventory item details.')

@section('content')

<div class="bg-white rounded-xl shadow p-8 max-w-3xl">

    <form action="{{ route('admin.inventories.update', $inventory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block font-semibold mb-2">Item Name</label>
            <input type="text" name="item_name"
                   value="{{ old('item_name', $inventory->item_name) }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Category</label>
            <select name="category" class="w-full border rounded-lg px-4 py-2">
                <option value="Fertilizers" {{ old('category', $inventory->category) == 'Fertilizers' ? 'selected' : '' }}>Fertilizers</option>
                <option value="Pesticides" {{ old('category', $inventory->category) == 'Pesticides' ? 'selected' : '' }}>Pesticides</option>
                <option value="Packaging" {{ old('category', $inventory->category) == 'Packaging' ? 'selected' : '' }}>Packaging</option>
                <option value="Tools" {{ old('category', $inventory->category) == 'Tools' ? 'selected' : '' }}>Tools</option>
                <option value="Other" {{ old('category', $inventory->category) == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Current Stock</label>
            <input type="number" name="current_stock"
                   value="{{ old('current_stock', $inventory->current_stock) }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Minimum Stock Level</label>
            <input type="number" name="minimum_stock"
                   value="{{ old('minimum_stock', $inventory->minimum_stock) }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Unit</label>
            <input type="text" name="unit"
                   value="{{ old('unit', $inventory->unit) }}"
                   placeholder="kg, litre, pcs, unit"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Supplier</label>
            <input type="text" name="supplier"
                   value="{{ old('supplier', $inventory->supplier) }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Description</label>
            <textarea name="description"
                      rows="4"
                      class="w-full border rounded-lg px-4 py-2">{{ old('description', $inventory->description) }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">
                Update Item
            </button>

            <a href="{{ route('admin.inventories.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection