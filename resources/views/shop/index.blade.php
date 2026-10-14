@extends('layouts.app')

@section('content')

<!-- Hero Banner -->
<div class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-green-900 rounded-2xl shadow-2xl p-10 mb-6 overflow-hidden">
    <!-- Glowing Effects -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-green-500 opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-500 opacity-20 rounded-full blur-3xl"></div>

    <div class="relative z-10 flex justify-between items-center flex-wrap gap-6">
        <div class="max-w-2xl">
            <p class="text-gray-400 text-sm mb-2 tracking-wide uppercase font-medium">
                Fastest delivery in Dhaka
            </p>
            
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-3 leading-tight tracking-tight">
                Fresh Groceries,
                <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-yellow-300">
                    Delivered in 60 Min
                </span>
            </h1>
            
            <p class="text-gray-300 text-base mb-6 leading-relaxed max-w-lg">
                Order fresh vegetables, fruits, meat, and daily essentials.
            </p>
            
            <div class="flex flex-wrap gap-3">
                <a href="#shop-now" 
                   class="bg-green-500 text-white px-6 py-3 rounded-lg font-semibold text-sm hover:bg-green-600 transition shadow-lg shadow-green-500/50 flex items-center gap-2">
                    🛒 Start Shopping
                </a>
                <a href="{{ route('help') }}" 
                   class="border-2 border-gray-600 text-white px-6 py-3 rounded-lg font-semibold text-sm hover:bg-gray-800 transition flex items-center gap-2">
                    📞 Contact Us
                </a>
            </div>
        </div>
        
        <div class="text-8xl md:text-9xl leading-none opacity-90 select-none hidden md:block">🛒</div>
    </div>
</div>



<!-- Category-wise Products -->
@php
    $icons = [
        'Rice & Grains','Oil & Ghee',
        'Vegetables', 'Fruits',
        'Dairy & Eggs', 'Meat & Fish',
        'Spices', 'Bakery',
        'Beverages', 'Snacks',
        'Frozen', 'Household'
    ];
@endphp

@foreach($categories as $category)
    @if($category->products->count() > 0)
        <div class="mb-12">
            <!-- Category Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ $category->name }}
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
                            <img src="{{ asset($product->image) }}"
                                 alt="{{ $product->name }}" 
                                 class="w-full h-40 object-cover rounded-t">
                        @else
                            <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-t text-5xl">
                                {{$category->name}}
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