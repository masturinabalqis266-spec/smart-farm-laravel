@extends('admin.layouts.app')

@section('page-title', 'Add Pest')
@section('page-description', 'Add new pest information.')

@section('content')

<div class="bg-white rounded-xl shadow p-8 max-w-3xl">

    <form action="{{ route('admin.pests.store') }}" method="POST">
        @csrf

        @include('admin.pests.form')

        <button type="submit"
                class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg">
            Save Pest
        </button>

        <a href="{{ route('admin.pests.index') }}"
           class="bg-gray-600 text-white px-6 py-2 rounded-lg ml-2">
            Cancel
        </a>
    </form>

</div>

@endsection