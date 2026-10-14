@extends('layouts.app')

@section('content')

<!-- Search Header -->
<div class="mb-6">
    <h1 class="text-3xl font-bold mb-2">🔍 Search Results</h1>
    <p class="text-gray-600">
        @if(request('search') || request('category') || request('min_price') || request('max_price'))
            {{ $products->total() }} products found for your search
        @else
            Enter search terms to find products
        @endif
    </p>
</div>

<!-- Search Form -->
<form method="GET" action="{{ route('search') }}" class="bg-white p-4 rounded shadow mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-3">
        <!-- Search Input -->
        <input type="text" name="search" placeholder="🔍 Search products..." 
               value="{{ request('search') }}" 
               class="md:col-span-2 border rounded px-3 py-2 focus:outline-none focus:border-green-500">
        
        <!-- Category Filter -->
        <select name="category" class="border rounded px-3 py-2 focus:outline-none focus:border-green-500">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        
        <!-- Price Range -->
        <div class="flex gap-2">
            <input type="number" name="min_price" placeholder="Min ৳" 
                   value="{{ request('min_price') }}" 
                   class="w-1/2 border rounded px-3 py-2 focus:outline-none focus:border-green-500">
            <input type="number" name="max_price" placeholder="Max ৳" 
                   value="{{ request('max_price') }}" 
                   class="w-1/2 border rounded px-3 py-2 focus:outline-none focus:border-green-500">
        </div>
    </div>

    <div class="flex gap-2 flex-wrap">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            🔍 Search
        </button>
        @if(request('search') || request('category') || request('min_price') || request('max_price'))
            <a href="{{ route('search') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">
                🔄 Reset Filters
            </a>
        @endif
    </div>
</form>

<!-- Active Filters -->
@if(request('search') || request('category') || request('min_price') || request('max_price'))
    <div class="bg-blue-50 border border-blue-200 rounded p-3 mb-6">
        <p class="text-sm font-semibold text-blue-800 mb-2">Active Filters:</p>
        <div class="flex flex-wrap gap-2">
            @if(request('search'))
                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm">
                    🔍 Search: "{{ request('search') }}"
                </span>
            @endif
            @if(request('category') && $cat = $categories->find(request('category')))
                <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">
                    📂 Category: {{ $cat->name }}
                </span>
            @endif
            @if(request('min_price') || request('max_price'))
                <span class="bg-purple-600 text-white px-3 py-1 rounded-full text-sm">
                    💰 Price: ৳{{ request('min_price', 0) }} - ৳{{ request('max_price', '∞') }}
                </span>
            @endif
        </div>
    </div>
@endif

<!-- Products Grid -->
@if($products->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($products as $product)
            <div class="bg-white rounded shadow hover:shadow-lg transition">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-40 object-cover rounded-t">
                @else
                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-t text-5xl">🛍️</div>
                @endif
                <div class="p-3">
                    <h3 class="font-bold text-sm mb-1 line-clamp-2">{{ $product->name }}</h3>
                    <a href="{{ route('category.show', $product->category->slug) }}" 
                       class="text-xs text-gray-600 hover:text-green-600">
                        📂 {{ $product->category->name }}
                    </a>
                    <p class="text-blue-600 font-bold mt-1">
                        ৳{{ number_format($product->price, 2) }} / {{ $product->unit }}
                        @if($product->is_fresh)
                            <span class="text-green-600 text-xs">🌱</span>
                        @endif
                    </p>
                    @if($product->stock <= 0)
                        <p class="text-red-600 text-xs mt-1">❌ Out of Stock</p>
                    @else
                        <p class="text-green-600 text-xs mt-1">✅ Stock: {{ $product->stock }}</p>
                    @endif
                    <div class="mt-2 flex gap-1">
                        <a href="{{ route('product.show', $product->slug) }}" 
                           class="flex-1 text-center bg-gray-200 py-1 rounded text-sm hover:bg-gray-300">
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
    <div class="mt-6">{{ $products->links() }}</div>
@else
    <!-- No Results Found -->
    <div class="bg-white p-8 rounded shadow text-center">
        <p class="text-6xl mb-4">🔍</p>
        <p class="text-gray-800 text-2xl font-bold mb-2">No products matched your search</p>
        <p class="text-gray-600 text-sm mb-4">
            @if(request('search'))
                We couldn't find any products for <strong>"{{ request('search') }}"</strong>.<br>
                Please check the spelling or try a different keyword.
            @else
                No products found. Please try changing the filters.
            @endif
        </p>

        <!-- Suggestions -->
        <div class="bg-blue-50 p-4 rounded mb-6 inline-block text-left max-w-md">
            <p class="font-bold text-blue-800 mb-3">💡 Suggestions:</p>
            <ul class="text-sm text-blue-700 space-y-1">
                <li>✅ Check the spelling (e.g., <code class="bg-white px-1">vegetables</code>, <code class="bg-white px-1">rice</code>)</li>
                <li>✅ Try a shorter keyword (e.g., <code class="bg-white px-1">oil</code>, <code class="bg-white px-1">fish</code>)</li>
                <li>✅ Select a category from the dropdown</li>
                <li>✅ Use the price range filter</li>
            </ul>

            <p class="font-bold text-blue-800 mt-4 mb-2">📝 Popular Searches:</p>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('search', ['search' => 'rice']) }}" class="bg-white text-blue-700 px-3 py-1 rounded-full text-xs hover:bg-blue-100">rice</a>
                <a href="{{ route('search', ['search' => 'oil']) }}" class="bg-white text-blue-700 px-3 py-1 rounded-full text-xs hover:bg-blue-100">oil</a>
                <a href="{{ route('search', ['search' => 'vegetables']) }}" class="bg-white text-blue-700 px-3 py-1 rounded-full text-xs hover:bg-blue-100">vegetables</a>
                <a href="{{ route('search', ['search' => 'fish']) }}" class="bg-white text-blue-700 px-3 py-1 rounded-full text-xs hover:bg-blue-100">fish</a>
                <a href="{{ route('search', ['search' => 'chocolate']) }}" class="bg-white text-blue-700 px-3 py-1 rounded-full text-xs hover:bg-blue-100">chocolate</a>
                <a href="{{ route('search', ['search' => 'milk']) }}" class="bg-white text-blue-700 px-3 py-1 rounded-full text-xs hover:bg-blue-100">milk</a>
            </div>
        </div>

        <div class="flex gap-2 justify-center flex-wrap">
            <a href="{{ route('search') }}" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700">
                🔄 Clear Filters
            </a>
            <a href="{{ route('home') }}" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                ← Back to Home
            </a>
        </div>
    </div>
@endif

@endsection