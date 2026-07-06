@extends('admin.layouts.app')

@section('content')

<div class="mb-6">
    <h2 class="text-3xl font-bold text-green-800">Edit Crop Block</h2>
    <p class="text-gray-600 mt-2">Update farm block information.</p>
</div>

<div class="bg-white rounded-2xl shadow border border-green-100 p-8 max-w-2xl">

    <form method="POST" action="{{ route('admin.crops.update', $crop->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-2">Block / Zone Name</label>
            <input type="text" name="block_name" value="{{ old('block_name', $crop->block_name) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">
            @error('block_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-2">Crop / Star Fruit Variety</label>
            <input type="text" name="crop_variety" value="{{ old('crop_variety', $crop->crop_variety) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">
            @error('crop_variety') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-2">Tree Count</label>
            <input type="number" name="tree_count" value="{{ old('tree_count', $crop->tree_count) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">
            @error('tree_count') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-2">Initial Planting Date</label>
            <input type="date" name="planting_date" value="{{ old('planting_date', $crop->planting_date) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">
            @error('planting_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Growth Status</label>

            <select name="growth_status"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">
                <option value="Seedling" {{ old('growth_status', $crop->growth_status) == 'Seedling' ? 'selected' : '' }}>Seedling</option>
                <option value="Maturing" {{ old('growth_status', $crop->growth_status) == 'Maturing' ? 'selected' : '' }}>Maturing</option>
                <option value="Yielding" {{ old('growth_status', $crop->growth_status) == 'Yielding' ? 'selected' : '' }}>Yielding</option>
                <option value="Harvested" {{ old('growth_status', $crop->growth_status) == 'Harvested' ? 'selected' : '' }}>Harvested</option>
                <option value="Inactive" {{ old('growth_status', $crop->growth_status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>

            @error('growth_status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-3">
            <button class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">
                Update Crop Block
            </button>

            <a href="{{ route('admin.crops.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection