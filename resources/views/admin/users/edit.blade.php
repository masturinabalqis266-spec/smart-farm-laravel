@extends('admin.layouts.app')

@section('content')

<div class="mb-6">
    <h2 class="text-3xl font-bold text-green-800">Edit User</h2>
    <p class="text-gray-600 mt-2">Update user information, role and status.</p>
</div>

<div class="bg-white rounded-2xl shadow border border-green-100 p-8 max-w-2xl">

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-2">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">

            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">

            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-2">Role</label>

            <select name="role"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="worker" {{ old('role', $user->role) == 'worker' ? 'selected' : '' }}>Worker</option>
            </select>

            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Status</label>

            <select name="status"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500">
                <option value="Active" {{ old('status', $user->status) == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ old('status', $user->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="Suspended" {{ old('status', $user->status) == 'Suspended' ? 'selected' : '' }}>Suspended</option>
            </select>

            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">
                Update User
            </button>

            <a href="{{ route('admin.users.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection