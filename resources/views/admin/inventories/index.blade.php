@extends('admin.layouts.app')

@section('page-title', 'Manage Inventory')
@section('page-description', 'Manage farm consumables and inventory stock levels.')

@section('content')

<div class="mb-6">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-500">
            <h3 class="text-gray-500 text-sm">Total Items</h3>
            <p class="text-3xl font-bold text-green-700">
                {{ $inventories->count() }}
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-500">
            <h3 class="text-gray-500 text-sm">Low Stock</h3>
            <p class="text-3xl font-bold text-yellow-600">
                {{ $inventories->where('current_stock', '<=', 'minimum_stock')->where('current_stock', '>', 0)->count() }}
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-red-500">
            <h3 class="text-gray-500 text-sm">Out of Stock</h3>
            <p class="text-3xl font-bold text-red-600">
                {{ $inventories->where('current_stock', 0)->count() }}
            </p>
        </div>

    </div>

</div>

@if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    <!-- Add Item Form -->
    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="text-xl font-bold text-green-700 mb-4">
            Register New Inventory Item
        </h3>

        <form method="POST" action="{{ route('admin.inventories.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-2">
                    Item Name
                </label>

                <input
                    type="text"
                    name="item_name"
                    class="w-full border-gray-300 rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">
                    Category
                </label>

                <select
                    name="category"
                    class="w-full border-gray-300 rounded-lg">

                    <option value="Fertilizers">Fertilizers</option>
                    <option value="Pesticides">Pesticides</option>
                    <option value="Packaging">Packaging</option>
                    <option value="Tools">Tools</option>
                    <option value="Other">Other</option>

                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="block font-medium mb-2">
                        Current Stock
                    </label>

                    <input
                        type="number"
                        name="current_stock"
                        value="0"
                        class="w-full border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block font-medium mb-2">
                        Minimum Stock
                    </label>

                    <input
                        type="number"
                        name="minimum_stock"
                        value="0"
                        class="w-full border-gray-300 rounded-lg">
                </div>

            </div>

            <div class="mt-4">
                <label class="block font-medium mb-2">
                    Unit
                </label>

                <input
                    type="text"
                    name="unit"
                    placeholder="kg, litre, pcs"
                    class="w-full border-gray-300 rounded-lg">
            </div>

            <div class="mt-4">
                <label class="block font-medium mb-2">
                    Supplier
                </label>

                <input
                    type="text"
                    name="supplier"
                    class="w-full border-gray-300 rounded-lg">
            </div>

            <div class="mt-4">
                <label class="block font-medium mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="3"
                    class="w-full border-gray-300 rounded-lg"></textarea>
            </div>

            <button
                type="submit"
                class="mt-5 w-full bg-green-700 hover:bg-green-800 text-white py-3 rounded-lg">
                Save Inventory Item
            </button>

        </form>

    </div>

    <!-- Categories -->
    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="text-xl font-bold text-green-700 mb-4">
            Inventory Categories
        </h3>

        <div class="space-y-3">

            <div class="flex justify-between border-b pb-3">
                <span>🌱 Fertilizers</span>
                <span>{{ $inventories->where('category','Fertilizers')->count() }}</span>
            </div>

            <div class="flex justify-between border-b pb-3">
                <span>🐛 Pesticides</span>
                <span>{{ $inventories->where('category','Pesticides')->count() }}</span>
            </div>

            <div class="flex justify-between border-b pb-3">
                <span>📦 Packaging</span>
                <span>{{ $inventories->where('category','Packaging')->count() }}</span>
            </div>

            <div class="flex justify-between border-b pb-3">
                <span>🔧 Tools</span>
                <span>{{ $inventories->where('category','Tools')->count() }}</span>
            </div>

            <div class="flex justify-between">
                <span>📄 Others</span>
                <span>{{ $inventories->where('category','Other')->count() }}</span>
            </div>

        </div>

    </div>

</div>

<!-- Inventory Table -->

<div class="bg-white rounded-xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-green-700 text-white">

            <tr>
                <th class="px-4 py-3 text-left">Item Name</th>
                <th class="px-4 py-3 text-left">Category</th>
                <th class="px-4 py-3 text-left">Stock</th>
                <th class="px-4 py-3 text-left">Unit</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Action</th>
            </tr>

        </thead>

        <tbody>

            @foreach($inventories as $inventory)

                <tr class="border-b hover:bg-green-50">

                    <td class="px-4 py-3">
                        {{ $inventory->item_name }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $inventory->category }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $inventory->current_stock }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $inventory->unit }}
                    </td>

                    <td class="px-4 py-3">

                        @if($inventory->current_stock == 0)

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                Out of Stock
                            </span>

                        @elseif($inventory->current_stock <= $inventory->minimum_stock)

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                Low Stock
                            </span>

                        @else

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                In Stock
                            </span>

                        @endif

                    </td>

                    <td class="px-4 py-3">

                        <div class="flex gap-2">

                            <a href="{{ route('admin.inventories.edit', $inventory->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.inventories.destroy', $inventory->id) }}">
                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete this item?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection