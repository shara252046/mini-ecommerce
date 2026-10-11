@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="bg-gradient-to-r from-green-500 to-blue-600 text-white rounded-lg shadow-lg p-8 mb-8">
    <h1 class="text-4xl font-bold mb-2">🛒 Welcome to MiniGrocery</h1>
    <p class="text-lg">Fresh groceries delivered to your doorstep</p>
</div>

<!-- Search Bar -->
<form method="GET" action="{{ route('search') }}" class="bg-white p-4 rounded shadow mb-8 flex gap-4 flex-wrap">
    <input type="text" name="search" placeholder="Search groceries..." class="flex-1 border rounded px-3 py-2 min-w-64">
    <select name="category" class="border rounded px-3 py-2">
        <option value="">All Categories</option>
        @foreach(\App\Models\Category::all() as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">🔍 Search</button>
</form>

<!-- Categories Quick Links -->
<div class="bg-white rounded shadow p-4 mb-8">
    <h2 class="text-xl font-bold mb-4">📂 Shop by Category</h2>
    <div class="flex flex-wrap gap-2">
        @foreach($categories as $category)
            <a href="{{ route('category.show', $category->slug) }}" 
               class="bg-gray-100 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-full text-sm font-semibold transition">
                {{ $category->name }} ({{ $category->products->count() }})
            </a>
        @endforeach
    </div>
</div>

<!-- Category-wise Products -->
@php
    $icons = [
        'Rice & Grains' => '🍚', 'Oil & Ghee' => '🛢️',
        'Vegetables' => '🥬', 'Fruits' => '🍎',
        'Dairy & Eggs' => '🥛', 'Meat & Fish' => '🐟',
        'Spices' => '🧂', 'Bakery' => '🍞',
        'Beverages' => '🥤', 'Snacks' => '🍫',
        'Frozen' => '❄️', 'Household' => '🧴'
    ];
@endphp

@foreach($categories as $category)
    @if($category->products->count() > 0)
        <div class="mb-12">
            <!-- Category Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ $icons[$category->name] ?? '🛍️' }} {{ $category->name }}
                </h2>
                <a href="{{ route('category.show', $category->slug) }}" 
                   class="text-blue-600 hover:text-blue-800 font-semibold">
                    View All →
                </a>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($category->products as $product)
                    <div class="bg-white rounded shadow hover:shadow-lg transition">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-40 object-cover rounded-t">
                        @else
                            <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-t text-5xl">
                                {{ $icons[$category->name] ?? '🛍️' }}
                            </div>
                        @endif
                        <div class="p-3">
                            <h3 class="font-bold text-sm mb-1 line-clamp-2">{{ $product->name }}</h3>
                            <p class="text-blue-600 font-bold">
                                ৳{{ number_format($product->price, 2) }} / {{ $product->unit }}
                                @if($product->is_fresh)
                                    <span class="text-green-600 text-xs">🌱</span>
                                @endif
                            </p>
                            @if($product->stock <= 0)
                                <p class="text-red-600 text-xs mt-1">Out of Stock</p>
                            @endif
                            <div class="mt-2 flex gap-1">
                                <a href="{{ route('product.show', $product->slug) }}" 
                                   class="flex-1 text-center bg-gray-200 text-gray-800 py-1 rounded text-sm hover:bg-gray-300">
                                    View
                                </a>
                                @auth
                                    <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex-1">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full bg-blue-600 text-white py-1 rounded text-sm hover:bg-blue-700"
                                                {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                            + Cart
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endforeach

@if($categories->sum(fn($c) => $c->products->count()) == 0)
    <div class="bg-white p-8 rounded shadow text-center">
        <p class="text-gray-600">No products found. Please add products from the admin panel.</p>
    </div>
@endif

@endsection