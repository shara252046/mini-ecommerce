@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Add Product</h1>
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block mb-2">Name</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-2">Category</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Price</label>
            <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Stock</label>
            <input type="number" name="stock" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Image</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Create Product</button>
    </form>
</div>
@endsection