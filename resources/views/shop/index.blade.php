@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Our Products</h1>

<!-- Search & Filter -->
<form method="GET" action="{{ route('search') }}" class="bg-white p-4 rounded shadow mb-6 flex gap-4">
    <input type="text" name="search" placeholder="Search products..." class="flex-1 border rounded px-3 py-2" value="{{ request('search') }}">
    <select name="category" class="border rounded px-3 py-2">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Search</button>
</form>

<!-- Products Grid -->
@if($products->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded shadow hover:shadow-lg transition">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t">
                @else
                    <div class="w-full h-48 bg-gray-300 flex items-center justify-center rounded-t">No Image</div>
                @endif
                <div class="p-4">
                    <h3 class="text-xl font-bold">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $product->category->name }}</p>
                    <p class="text-blue-600 font-bold text-lg">${{ number_format($product->price, 2) }}</p>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('product.show', $product->slug) }}" class="flex-1 text-center bg-gray-200 text-gray-800 py-2 rounded hover:bg-gray-300">View</a>
                        @auth
                            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Add to Cart</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-6">
        {{ $products->links() }}
    </div>
@else
    <div class="bg-white p-8 rounded shadow text-center">
        <p class="text-gray-600">No products found. Please add products from the admin panel.</p>
    </div>
@endif
@endsection

