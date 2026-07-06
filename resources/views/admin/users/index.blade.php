@extends('admin.layouts.app')
@section('page-title', 'Manage Users')
@section('content')

<div class="flex justify-between items-center mb-6">

    
    <a href="{{ route('admin.users.create') }}"
       class="bg-green-700 hover:bg-green-800 text-white px-5 py-3 rounded-lg shadow">

        + Add User

    </a>

</div>

@if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow border border-green-100 overflow-hidden">

    <table class="w-full text-left">

        <thead class="bg-green-700 text-white">
            <tr>
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">Name</th>
                <th class="px-6 py-4">Email</th>
                <th class="px-6 py-4">Role</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4">Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse($users as $user)

                <tr class="border-b hover:bg-green-50">

                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-6 py-4 font-medium">
                        {{ $user->name }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>

                    <td class="px-6 py-4">

                        @if($user->role == 'admin')
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
                                Admin
                            </span>

                        @elseif($user->role == 'manager')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                Manager
                            </span>

                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                Worker
                            </span>
                        @endif

                    </td>

                    <td class="px-6 py-4">

                        @if($user->status == 'Active')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Active
                            </span>

                        @elseif($user->status == 'Inactive')

                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                Inactive
                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                Suspended
                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-4">

                        <div class="flex gap-2">

                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                                Edit
                            </a>

                            @if(auth()->id() != $user->id)

                                <form method="POST"
                                      action="{{ route('admin.users.destroy', $user->id) }}"
                                      onsubmit="return confirm('Delete this user?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                        Delete
                                    </button>

                                </form>

                            @endif

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                        No users found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection