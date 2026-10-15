@extends('layouts.app')

@section('content')



@if($wishlists->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($wishlists as $wishlist)
            @php $product = $wishlist->product; @endphp
            <div class="bg-white rounded-lg shadow-sm hover:shadow-lg transition overflow-hidden border border-gray-100">
                <div class="relative">
                    @if($product->image)
                        <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset($product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-40 object-cover"
                             onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                    @else
                        <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-5xl">🛍️</div>
                    @endif

                    @if($product->is_fresh)
                        <span class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full font-bold">🌱 Fresh</span>
                    @endif

                    @if($product->stock <= 0)
                        <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full font-bold">Out</span>
                    @endif

                    <!-- Remove from wishlist -->
                    <form method="POST" action="{{ route('wishlist.remove', $product->id) }}" class="absolute top-3 right-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-white text-red-600 rounded-full w-8 h-8 flex items-center justify-center shadow hover:bg-red-50 font-bold"
                                title="Remove from wishlist">
                            ✕
                        </button>
                    </form>
                </div>

                <div class="p-3 text-center">
                    <h3 class="font-bold text-sm mb-1 line-clamp-2 h-10">{{ $product->name }}</h3>
                    @if($product->subCategory)
                        <p class="text-xs text-gray-500 mb-1">{{ $product->subCategory->name }}</p>
                    @endif
                    <p class="text-green-700 font-bold text-lg">
                        ৳{{ number_format($product->price, 0) }}
                        <span class="text-xs text-gray-500 font-normal">/ {{ $product->unit }}</span>
                    </p>

                    <div class="mt-2 flex gap-1">
                        <a href="{{ route('product.show', $product->slug) }}"
                           class="flex-1 text-center bg-gray-100 text-gray-700 py-1.5 rounded text-xs hover:bg-gray-200 font-semibold">
                            View
                        </a>
                        @auth
                            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex-1">
                                @csrf
                                <button type="submit"
                                        class="w-full bg-green-600 text-white py-1.5 rounded text-xs hover:bg-green-700 font-semibold"
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
@else
    <!-- Empty Wishlist -->
    <div class="bg-white p-12 rounded-lg shadow text-center">
       
        <p class="text-2xl font-bold text-gray-800 mb-2">Your wishlist is empty</p>
        <p class="text-gray-600 mb-8">You haven't added any products to your wishlist yet.</p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
            <a href="{{ route('home') }}"
               class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 inline-flex items-center gap-2 font-bold shadow-lg transition">
                 Go to Home Page
            </a>
            <a href="{{ route('search') }}"
               class="bg-gray-100 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-200 inline-flex items-center gap-2 font-bold transition">
                🛍️ Browse Products
            </a>
        </div>
    </div>
@endif

@endsection