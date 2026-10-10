@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Product</h1>
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-2">Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Category</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Price</label>
            <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Stock</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2" required>{{ $product->description }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Image</label>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover mb-2 rounded">
            @endif
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Update Product</button>
    </form>
</div>
@endsection