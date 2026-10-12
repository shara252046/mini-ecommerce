@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Product: {{ $product->name }}</h1>
    
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-bold">Product Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded px-3 py-2" required>
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-bold">Category</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-2 font-bold">Price (৳)</label>
                <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block mb-2 font-bold">Unit</label>
                <select name="unit" class="w-full border rounded px-3 py-2" required>
                    @foreach(['kg', 'liter', 'piece', 'packet', 'dozen'] as $unit)
                        <option value="{{ $unit }}" {{ $product->unit == $unit ? 'selected' : '' }}>{{ $unit }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-2 font-bold">Stock</label>
                <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block mb-2 font-bold">Expiry Date</label>
                <input type="date" name="expiry_date" value="{{ $product->expiry_date }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-bold">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2" required>{{ $product->description }}</textarea>
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_fresh" value="1" {{ $product->is_fresh ? 'checked' : '' }} class="mr-2">
                <span class="font-bold">Is Fresh? (মাছ/মাংস/সবজি)</span>
            </label>
        </div>

        <!-- Image Field -->
        <div class="mb-4">
            <label class="block mb-2 font-bold">Product Image</label>
            
            @if($product->image)
                <div class="mb-3">
                    <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         class="w-32 h-32 object-cover rounded border shadow">
                </div>
            @endif

            <input type="file" name="image" accept="image/*" 
                   class="w-full border rounded px-3 py-2 bg-gray-50">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Max: 2MB)</p>
            @error('image') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                ✅ Update Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection