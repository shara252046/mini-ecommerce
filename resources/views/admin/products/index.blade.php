@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Products</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add Product</a>
</div>

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
            @foreach($products as $product)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $product->id }}</td>
                    <td class="py-3 px-4">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded">
                        @endif
                    </td>
                    <td class="py-3 px-4">{{ $product->name }}</td>
                    <td class="py-3 px-4">{{ $product->category->name }}</td>
                    <td class="py-3 px-4">${{ number_format($product->price, 2) }}</td>
                    <td class="py-3 px-4">{{ $product->stock }}</td>
                    <td class="py-3 px-4 flex gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600">Edit</a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection