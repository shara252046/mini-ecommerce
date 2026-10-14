@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">🛍️ Manage Products</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Add Product
    </a>
</div>

<!-- Category Filter -->
<form method="GET" class="bg-white p-4 rounded shadow mb-4 flex gap-3">
    <select name="category" class="border rounded px-3 py-2 flex-1">
        <option value="">All Categories</option>
        @foreach(\App\Models\Category::all() as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Filter</button>
    <a href="{{ route('admin.products.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded">Reset</a>
</form>

<div class="bg-white rounded shadow">
    <table class="w-full">
        <thead>
            <tr class="border-b bg-gray-50">
                <th class="text-left py-3 px-4">ID</th>
                <th class="text-left py-3 px-4">Image</th>
                <th class="text-left py-3 px-4">Name</th>
                <th class="text-left py-3 px-4">Category</th>
                <th class="text-left py-3 px-4">Price</th>
                <th class="text-left py-3 px-4">Stock</th>
                <th class="text-left py-3 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $product->id }}</td>
                    <td class="py-3 px-4">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" class="w-12 h-12 object-cover rounded">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">🛍️</div>
                        @endif
                    </td>
                    <td class="py-3 px-4 font-bold">{{ $product->name }}</td>
                    <td class="py-3 px-4">
                        <a href="{{ route('admin.categories.show', $product->category->id) }}" 
                           class="text-blue-600 hover:underline">
                            {{ $product->category->name }}
                        </a>
                    </td>
                    <td class="py-3 px-4">৳{{ number_format($product->price, 2) }} / {{ $product->unit }}</td>
                    <td class="py-3 px-4">
                        @if($product->stock > 0)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">{{ $product->stock }}</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">Out</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 flex gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-600">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection