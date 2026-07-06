@extends('manager.layouts.app')

@section('page-title', 'Monitor Crop')
@section('page-description', 'Monitor crop growth, varieties, tree counts and farm block status.')

@section('content')

{{-- Filter Section --}}
<div class="bg-white rounded-xl shadow p-6 mb-6">

    <h2 class="text-xl font-bold text-green-800 mb-4">
        Filter Crop Blocks
    </h2>

    <form method="GET" action="{{ route('manager.crops.index') }}">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div>
                <label class="block text-sm font-medium mb-1">Block Name</label>
                <input type="text"
                       name="block_name"
                       value="{{ request('block_name') }}"
                       placeholder="Search block name"
                       class="w-full rounded-lg border-gray-300">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Variety</label>
                <select name="crop_variety" class="w-full rounded-lg border-gray-300">
                    <option value="">All Varieties</option>

                    @foreach($varieties as $variety)
                        <option value="{{ $variety }}" {{ request('crop_variety') == $variety ? 'selected' : '' }}>
                            {{ $variety }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Growth Status</label>
                <select name="growth_status" class="w-full rounded-lg border-gray-300">
                    <option value="">All Status</option>
                    <option value="Seedling" {{ request('growth_status') == 'Seedling' ? 'selected' : '' }}>Seedling</option>
                    <option value="Maturing" {{ request('growth_status') == 'Maturing' ? 'selected' : '' }}>Maturing</option>
                    <option value="Yielding" {{ request('growth_status') == 'Yielding' ? 'selected' : '' }}>Yielding</option>
                </select>
            </div>

        </div>

        <div class="mt-5 flex gap-3">
            <button type="submit"
                    class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">
                Filter
            </button>

            <a href="{{ route('manager.crops.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg">
                Reset
            </a>
        </div>

    </form>
</div>

{{-- Crop Table --}}
<div class="bg-white rounded-xl shadow p-6">

    <table class="w-full text-sm">
        <thead class="bg-green-700 text-white">
            <tr>
                <th class="px-4 py-3 text-left">Block</th>
                <th class="px-4 py-3 text-left">Variety</th>
                <th class="px-4 py-3 text-left">Tree Count</th>
                <th class="px-4 py-3 text-left">Planting Date</th>
                <th class="px-4 py-3 text-left">Growth Status</th>
                <th class="px-4 py-3 text-left">Readiness</th>
            </tr>
        </thead>

        <tbody>
            @forelse($cropBlocks as $crop)
                <tr class="border-b hover:bg-green-50">
                    <td class="px-4 py-3 font-medium">{{ $crop->block_name }}</td>
                    <td class="px-4 py-3">{{ $crop->crop_variety }}</td>
                    <td class="px-4 py-3">{{ $crop->tree_count }}</td>
                    <td class="px-4 py-3">{{ $crop->planting_date }}</td>
                    <td class="px-4 py-3">{{ $crop->growth_status }}</td>
                    <td class="px-4 py-3">
                        @if($crop->growth_status == 'Yielding')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">90%</span>
                        @elseif($crop->growth_status == 'Maturing')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">60%</span>
                        @else
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs">30%</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                        No crop blocks found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection