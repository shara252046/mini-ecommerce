@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold">📂 {{ $category->name }}</h1>
        <p class="text-gray-600">{{ $products->total() }} products in this category</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.categories.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
            ← Back
        </a>
        <a href="{{ route('admin.products.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Add Product
        </a>
    </div>
</div>

@if($products->count() > 0)
    <div class="bg-white rounded shadow">
        <table class="w-full">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="text-left py-3 px-4">Image</th>
                    <th class="text-left py-3 px-4">Name</th>
                    <th class="text-left py-3 px-4">Price</th>
                    <th class="text-left py-3 px-4">Stock</th>
                    <th class="text-left py-3 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" class="w-12 h-12 object-cover rounded">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">🛍️</div>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-semibold">{{ $product->name }}</td>
                        <td class="py-3 px-4">৳{{ number_format($product->price, 2) }} / {{ $product->unit }}</td>
                        <td class="py-3 px-4">{{ $product->stock }}</td>
                        <td class="py-3 px-4 flex gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $products->links() }}</div>
@else
    <div class="bg-white p-8 rounded shadow text-center">
        <p class="text-gray-600">No products in this category yet.</p>
    </div>
@endif
@endsection

