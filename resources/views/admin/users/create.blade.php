@extends('admin.layouts.app')

@section('content')

<h2 class="text-3xl font-bold text-green-800 mb-6">
    Add New User
</h2>

<div class="bg-white rounded-2xl shadow border border-green-100 p-8 max-w-2xl">

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="mb-5">
            <label>Name</label>

            <input type="text"
                   name="name"
                   class="w-full border rounded-lg p-2">
        </div>

        <div class="mb-5">
            <label>Email</label>

            <input type="email"
                   name="email"
                   class="w-full border rounded-lg p-2">
        </div>

        <div class="mb-5">
            <label>Password</label>

            <input type="password"
                   name="password"
                   class="w-full border rounded-lg p-2">
        </div>

        <div class="mb-5">
            <label>Role</label>

            <select name="role"
                    class="w-full border rounded-lg p-2">

                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="worker">Worker</option>

            </select>
        </div>

        <div class="mb-5">
            <label>Status</label>

            <select name="status"
                    class="w-full border rounded-lg p-2">

                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Suspended">Suspended</option>

            </select>
        </div>

        <button
            class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">

            Create User

        </button>

    </form>

</div>

@endsection