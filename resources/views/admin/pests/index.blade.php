@extends('admin.layouts.app')

@section('page-title', 'Pest Database')
@section('page-description', 'Manage saved pest information and detection count.')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-green-800">Pest Database</h2>

        <a href="{{ route('admin.pests.create') }}"
           class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg">
            + Add Pest
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Pest Name</th>
                    <th class="px-4 py-3 text-left">Threat Level</th>
                    <th class="px-4 py-3 text-left">Treatment</th>
                    <th class="px-4 py-3 text-left">Location</th>
                    <th class="px-4 py-3 text-center">Detection Count</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pests as $pest)
                    <tr class="border-b hover:bg-green-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $pest->pest_name }}</td>

                        <td class="px-4 py-3">
                            @if($pest->threat_level == 'High')
                                <span class="bg-red-600 text-white px-3 py-1 rounded-full">High</span>
                            @elseif($pest->threat_level == 'Medium')
                                <span class="bg-yellow-500 text-white px-3 py-1 rounded-full">Medium</span>
                            @else
                                <span class="bg-green-600 text-white px-3 py-1 rounded-full">Low</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">{{ $pest->treatment }}</td>
                        <td class="px-4 py-3">{{ $pest->location }}</td>
                        <td class="px-4 py-3 text-center">{{ $pest->detection_count }}</td>

                        <td class="px-4 py-3">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('admin.pests.edit', $pest->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <form action="{{ route('admin.pests.destroy', $pest->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this pest data?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500">
                            No pest data found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection