@extends('admin.layouts.app')
@section('page-title', 'Manage Crops')
@section('content')

<div class="flex justify-between items-center mb-6">
    
    <a href="{{ route('admin.crops.create') }}"
       class="bg-green-700 hover:bg-green-800 text-white px-5 py-3 rounded-lg shadow">
        + Add Crop Block
    </a>
</div>

@if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow border border-green-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-green-700 text-white">
            <tr>
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">Block / Zone</th>
                <th class="px-6 py-4">Crop Variety</th>
                <th class="px-6 py-4">Tree Count</th>
                <th class="px-6 py-4">Planting Date</th>
                <th class="px-6 py-4">Growth Status</th>
                <th class="px-6 py-4">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($crops as $crop)
                <tr class="border-b hover:bg-green-50">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-medium">{{ $crop->block_name }}</td>
                    <td class="px-6 py-4">{{ $crop->crop_variety }}</td>
                    <td class="px-6 py-4">{{ $crop->tree_count }}</td>
                    <td class="px-6 py-4">{{ $crop->planting_date }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            {{ $crop->growth_status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.crops.edit', $crop->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.crops.destroy', $crop->id) }}"
                                  onsubmit="return confirm('Delete this crop block?')">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-6 text-center text-gray-500">
                        No crop blocks found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection