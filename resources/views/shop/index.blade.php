@extends('layouts.app')

@section('content')

<!-- Hero Banner -->
<div class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-green-900 rounded-2xl shadow-2xl p-10 mb-6 overflow-hidden">
    <!-- Glowing Effects -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-green-500 opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-500 opacity-20 rounded-full blur-3xl"></div>

    <div class="relative z-10 flex justify-between items-center flex-wrap gap-6">
        <div class="max-w-2xl">
            <p class="text-gray-200 text-sm mb-1 tracking-wide uppercase font-sm">
                Fastest delivery in Dhaka
            </p>
            
            <h1 class="text-2xl md:text-3xl font-bold text-white mb-3 leading-tight tracking-tight">
                Fresh Groceries,
                <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-yellow-300">
                    Delivered in 60 Min
                </span>
            </h1>
            
            <p class="text-gray-300 text-sm mb-5 leading-relaxed max-w-lg">
                Order fresh vegetables, fruits, meat, and daily essentials.
            </p>
            
            <div class="flex flex-wrap gap-3">
                <a href="#shop-now" 
                   class="bg-green-500 text-white px-5 py-2 rounded-lg font-semibold text-sm hover:bg-green-600 transition shadow-lg shadow-green-500/50 flex items-center gap-2">
                    🛒 Start Shopping
                </a>
                <a href="{{ route('help') }}" 
                   class="border-2 border-gray-600 text-white px-6 py-3 rounded-lg font-semibold text-sm hover:bg-gray-800 transition flex items-center gap-2">
                    📞 Contact Us
                </a>
            </div>
        </div>
        
    
    </div>
</div>

<!-- ========== PROMO BANNER ========== -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-8">

    <!-- Main Promo Banner -->
    <div class="lg:col-span-2 relative bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-lg p-8 overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-20 -mt-20"></div>
        <div class="relative z-10">
            <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-xs font-bold">🔥 HOT DEAL</span>
            <h2 class="text-4xl font-bold text-white mt-3 mb-2">
                TURBO <span class="text-yellow-300">10.10</span>
            </h2>
            <p class="text-white text-lg mb-1">UP TO</p>
            <p class="text-6xl font-black text-yellow-300 mb-4">50% OFF</p>
            <a href="#shop-now" class="inline-block bg-white text-blue-600 px-6 py-3 rounded-lg font-bold hover:bg-gray-100 transition">
                Shop Now →
            </a>
        </div>
        <div class="absolute bottom-4 right-4 text-9xl opacity-30">🛍️</div>
    </div>

    <!-- Side Promos -->
    <div class="grid grid-rows-2 gap-4">
        <div class="relative bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-lg p-5 overflow-hidden">
            <div class="relative z-10">
                <p class="text-white/90 text-xs">FREE DELIVERY</p>
                <p class="text-2xl font-bold text-white">৳500+</p>
                <p class="text-white/80 text-xs mt-1">On your first order</p>
            </div>
            <div class="absolute bottom-2 right-2 text-6xl opacity-40">🚚</div>
        </div>
        <div class="relative bg-gradient-to-br from-orange-500 to-red-500 rounded-xl shadow-lg p-5 overflow-hidden">
            <div class="relative z-10">
                <p class="text-white/90 text-xs">USE CODE</p>
                <p class="text-2xl font-bold text-white">GROCERY10</p>
                <p class="text-white/80 text-xs mt-1">10% off on all items</p>
            </div>
            <div class="absolute bottom-2 right-2 text-6xl opacity-40">🎁</div>
        </div>
    </div>
</div>

<!-- ========== FEATURED SUBCATEGORIES ========== -->
<div class="bg-white rounded-xl shadow p-6 mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800">🔥 Popular Sub-Categories</h2>
        <a href="{{ route('search') }}" class="text-green-600 hover:underline text-sm font-semibold">View All →</a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">

        @php
            $featuredSubs = [
                ['name' => 'Eggs', 'img' => 'https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?w=300'],
                ['name' => 'Tea', 'img' => 'https://images.unsplash.com/photo-1597318181409-cf64d0b5d8a2?w=300'],
                ['name' => 'Soft Drinks', 'img' => 'https://images.unsplash.com/photo-1581636625402-29b2a704ef13?w=300'],
                ['name' => 'Frozen', 'img' => 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=300'],
                ['name' => 'Coffee', 'img' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?w=300'],
                ['name' => 'Snacks', 'img' => 'https://images.unsplash.com/photo-1566478989037-eec170784d0b?w=300'],
            ];
        @endphp

        @foreach($featuredSubs as $sub)
            <a href="{{ route('search', ['search' => $sub['name']]) }}" class="group text-center">
                <div class="relative overflow-hidden rounded-xl shadow hover:shadow-xl transition">
                    <img src="{{ $sub['img'] }}" 
                         alt="{{ $sub['name'] }}" 
                         class="w-full h-32 object-cover group-hover:scale-110 transition duration-300">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-2">
                        <p class="text-white text-sm font-bold">{{ $sub['name'] }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>

@php
    $icons = [
        'Rice & Grains', 'Oil & Ghee',
        'Vegetables', 'Fruits',
        'Dairy & Eggs', 'Meat & Fish',
        'Spices', 'Bakery',
        'Beverages', 'Snacks',
        'Frozen', 'Household'
    ];
    $mainCategories = \App\Models\Category::whereNull('parent_id')->with('subCategories')->get();
@endphp

<!-- ============================================ -->
<!-- CATEGORY-WISE PRODUCTS (LuLu Style Slider)  -->
<!-- ============================================ -->
@foreach($mainCategories as $category)
    @if($category->products->count() > 0)
        <div class="bg-white rounded-xl shadow p-6 mb-8">
            
            <!-- Category Header -->
            <div class="flex justify-between items-center mb-5">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                        <span class="text-3xl">{{ $icons[$category->name] ?? '🛍️' }}</span>
                        <span>{{ $category->name }}</span>
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $category->products->count() }} products available
                    </p>
                </div>
                <a href="{{ route('category.show', $category->slug) }}" 
                   class="text-green-600 hover:text-green-800 hover:underline text-sm font-semibold flex items-center gap-1">
                    View All <span>→</span>
                </a>
            </div>

            <!-- LuLu Style Layout: Big Image Left + Slider Right -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">

                <!-- Left: Big Category Image -->
                <div class="lg:col-span-1 relative bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl overflow-hidden min-h-[320px] flex items-center justify-center">
                    @php
                        $categoryFirstProduct = $category->products->first();
                        $categoryImage = $categoryFirstProduct && $categoryFirstProduct->image 
                            ? (str_starts_with($categoryFirstProduct->image, 'http') ? $categoryFirstProduct->image : asset($categoryFirstProduct->image))
                            : null;
                    @endphp
                    
                    @if($categoryImage)
                        <img src="{{ $categoryImage }}" 
                             alt="{{ $category->name }}" 
                             class="w-full h-full object-cover absolute inset-0 opacity-40">
                    @endif
                    
                    <div class="relative z-10 text-center p-4">
                        <div class="text-6xl mb-3">{{ $icons[$category->name] ?? '🛍️' }}</div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $category->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $category->products->count() }}+ Items</p>
                        <a href="{{ route('category.show', $category->slug) }}" 
                           class="inline-block mt-3 bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-green-700 transition">
                            Shop Now →
                        </a>
                    </div>
                </div>

                <!-- Right: Product Slider -->
                <div class="lg:col-span-4 relative">
                    
                    <!-- Left Arrow -->
                    <button onclick="slideLeft('slider-{{ $category->id }}')" 
                            class="absolute left-0 top-1/2 -translate-y-1/2 z-20 bg-white shadow-lg rounded-full w-10 h-10 flex items-center justify-center hover:bg-green-500 hover:text-white transition -ml-3"
                            title="Previous">
                        ◀
                    </button>

                    <!-- Slider Container -->
                    <div id="slider-{{ $category->id }}" 
                         class="flex gap-4 overflow-x-auto scroll-smooth pb-2"
                         style="scrollbar-width: none; -ms-overflow-style: none;">
                        <style>
                            #slider-{{ $category->id }}::-webkit-scrollbar {
                                display: none;
                            }
                        </style>

                        @foreach($category->products as $product)
                            <div class="flex-shrink-0 w-[calc(25%-12px)] min-w-[200px]">
                                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition overflow-hidden border border-gray-100 group relative h-full">
                                    
                                    <!-- Discount Badge -->
                                    @if($product->stock < 50)
                                        <span class="absolute top-3 left-3 bg-green-500 text-white text-xs px-2 py-1 rounded-md font-bold z-10">
                                            -{{ rand(5, 30) }}%
                                        </span>
                                    @endif

                                    <!-- Wishlist Icon -->
                                    @auth
                                        <form method="POST" action="{{ route('wishlist.add', $product->id) }}" class="absolute top-3 right-3 z-10">
                                            @csrf
                                            <button type="submit" 
                                                    class="w-8 h-8 bg-white rounded-full shadow flex items-center justify-center hover:bg-pink-50 text-gray-400 hover:text-pink-500">
                                                ♡
                                            </button>
                                        </form>
                                    @endauth

                                    <!-- Product Image -->
                                    <div class="relative bg-gray-50 h-40 flex items-center justify-center overflow-hidden">
                                        @if($product->image)
                                            <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset($product->image) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                                 onerror="this.src='https://via.placeholder.com/300x300?text=No+Image'">
                                        @else
                                            <div class="text-5xl">{{ $icons[$category->name] ?? '🛍️' }}</div>
                                        @endif
                                        
                                        <!-- + Add Button -->
                                        @auth
                                            <form method="POST" action="{{ route('cart.add', $product->id) }}" 
                                                  class="absolute bottom-3 right-3">
                                                @csrf
                                                <button type="submit" 
                                                        class="w-10 h-10 bg-green-500 text-white rounded-lg flex items-center justify-center shadow-lg hover:bg-green-600 transition font-bold text-xl"
                                                        {{ $product->stock <= 0 ? 'disabled' : '' }}
                                                        title="Add to cart">
                                                    +
                                                </button>
                                            </form>
                                        @endauth
                                    </div>

                                    <!-- Product Info -->
                                    <div class="p-3">
                                        <p class="text-xs text-gray-500 mb-1 font-semibold uppercase">
                                            {{ $category->name }}
                                        </p>
                                        
                                        <h3 class="font-semibold text-sm text-gray-800 mb-2 line-clamp-2 h-10">
                                            {{ $product->name }}
                                        </h3>

                                        <div class="flex items-center gap-2">
                                            <span class="text-lg font-bold text-gray-900">
                                                ৳{{ number_format($product->price, 0) }}
                                            </span>
                                            <span class="text-xs text-gray-500 line-through">
                                                ৳{{ number_format($product->price * 1.2, 0) }}
                                            </span>
                                        </div>
                                        
                                        <p class="text-xs text-gray-500 mt-1">per {{ $product->unit }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Right Arrow -->
                    <button onclick="slideRight('slider-{{ $category->id }}')" 
                            class="absolute right-0 top-1/2 -translate-y-1/2 z-20 bg-white shadow-lg rounded-full w-10 h-10 flex items-center justify-center hover:bg-green-500 hover:text-white transition -mr-3"
                            title="Next">
                        ▶
                    </button>

                </div>
            </div>

            <!-- Sub-Category Chips -->
            @if($category->subCategories->count() > 0)
                <div class="flex flex-wrap gap-2 mt-5 pt-5 border-t">
                    <span class="text-xs text-gray-500 font-semibold py-1">Related:</span>
                    @foreach($category->subCategories->take(6) as $sub)
                        <a href="{{ route('category.show', $sub->slug) }}" 
                           class="bg-gray-100 hover:bg-green-600 hover:text-white px-3 py-1 rounded-full text-xs font-semibold transition">
                            {{ $sub->name }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
@endforeach

@if($mainCategories->sum(fn($c) => $c->products->count()) == 0)
    <div class="bg-white p-8 rounded shadow text-center">
        <p class="text-gray-600">No products found. Please add products from the admin panel.</p>
    </div>
@endif

<!-- ============================================ -->
<!-- SLIDER JAVASCRIPT                            -->
<!-- ============================================ -->
<script>
    function slideLeft(sliderId) {
        const slider = document.getElementById(sliderId);
        if (slider) {
            slider.scrollBy({
                left: -300,
                behavior: 'smooth'
            });
        }
    }

    function slideRight(sliderId) {
        const slider = document.getElementById(sliderId);
        if (slider) {
            slider.scrollBy({
                left: 300,
                behavior: 'smooth'
            });
        }
    }
</script>

@endsection