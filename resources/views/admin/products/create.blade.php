@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Add New Product</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block mb-2 font-bold">Product Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-bold">Category</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-2 font-bold">Price (৳)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block mb-2 font-bold">Unit</label>
                <select name="unit" class="w-full border rounded px-3 py-2" required>
                    <option value="kg">kg</option>
                    <option value="liter">liter</option>
                    <option value="piece">piece</option>
                    <option value="packet">packet</option>
                    <option value="dozen">dozen</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-2 font-bold">Stock</label>
                <input type="number" name="stock" value="{{ old('stock') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block mb-2 font-bold">Expiry Date (Optional)</label>
                <input type="date" name="expiry_date" value="{{ old('expiry_date') }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-bold">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_fresh" value="1" class="mr-2">
                <span class="font-bold">Is Fresh?</span>
            </label>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-bold">Upload Image</label>
            <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2 bg-gray-50">
            <p class="text-xs text-gray-500 mt-1">JPG, PNG, WEBP (Max: 5MB)</p>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-bold">Or Provide an Image URL</label>
            <input type="text" name="image_url" placeholder="https://example.com/image.jpg" 
                   value="{{ old('image_url') }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 font-bold">
                ✅ Create Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection