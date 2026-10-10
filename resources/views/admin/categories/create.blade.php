@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Add Category</h1>
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-2">Name</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Create</button>
    </form>
</div>
@endsection