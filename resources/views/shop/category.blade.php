@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<div class="mb-4 text-sm">
    <a href="{{ route('home') }}" class="text-blue-600">Home</a>
    <span class="text-gray-500"> / </span>
    <span class="text-gray-700">{{ $category->name }}</span>
</div>

<!-- Category Header -->
<div class="bg-gradient-to-r from-green-500 to-blue-600 text-white rounded-lg shadow-lg p-6 mb-6">
    <h1 class="text-3xl font-bold">
        @php
            $icons = [
                'Rice & Grains', 'Oil & Ghee',
                'Vegetables', 'Fruits',
                'Dairy & Eggs', 'Meat & Fish',
                'Spices', 'Bakery',
                'Beverages', 'Snacks',
                'Frozen', 'Household'
            ];
        @endphp
        {{ $category->name }}
    </h1>
    <p class="mt-2">{{ $products->total() }} products available</p>
</div>



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
                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded-t text-5xl">
                        {{$category->name}}
                    </div>
                @endif
                <div class="p-3">
                    <h3 class="font-bold text-sm mb-1">{{ $product->name }}</h3>
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

    <div class="mt-6">{{ $products->links() }}</div>
@else
    <div class="bg-white p-8 rounded shadow text-center">
        <p class="text-gray-600">No products in this category yet.</p>
        <a href="{{ route('home') }}" class="text-blue-600 mt-4 inline-block">← Back to Home</a>
    </div>
@endif

@endsection