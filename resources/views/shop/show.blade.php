@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full rounded">
            @else
                <div class="w-full h-96 bg-gray-300 flex items-center justify-center rounded">No Image</div>
            @endif
        </div>
        <div>
            <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
            <p class="text-gray-600 mb-4">Category: {{ $product->category->name }}</p>
           <p class="text-blue-600 font-bold text-lg">
    ৳{{ number_format($product->price, 2) }} / {{ $product->unit }}
    @if($product->is_fresh)
        <span class="text-green-600 text-sm">🌱 Fresh</span>
    @endif
</p>
            <p class="text-gray-700 mb-4">{{ $product->description }}</p>
            <p class="text-sm mb-4 {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                {{ $product->stock > 0 ? 'In Stock: ' . $product->stock : 'Out of Stock' }}
            </p>
            @auth
                <div class="flex gap-4">
                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                        @csrf
                        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">Add to Cart</button>
                    </form>
                    <form method="POST" action="{{ route('wishlist.add', $product->id) }}">
                        @csrf
                        <button type="submit" class="bg-pink-500 text-white px-6 py-3 rounded hover:bg-pink-600">Add to Wishlist</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>

    <!-- Reviews -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-4">Reviews ({{ $product->reviews->count() }})</h2>
        @auth
            <form method="POST" action="{{ route('review.store', $product->id) }}" class="bg-gray-50 p-4 rounded mb-6">
                @csrf
                <div class="mb-4">
                    <label class="block mb-2">Rating</label>
                    <select name="rating" class="border rounded px-3 py-2 w-full">
                        <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                        <option value="4">⭐⭐⭐⭐ (4)</option>
                        <option value="3">⭐⭐⭐ (3)</option>
                        <option value="2">⭐⭐ (2)</option>
                        <option value="1">⭐ (1)</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">Comment</label>
                    <textarea name="comment" rows="3" class="border rounded px-3 py-2 w-full"></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit Review</button>
            </form>
        @endauth

        @forelse($product->reviews as $review)
            <div class="border-b py-4">
                <div class="flex justify-between">
                    <p class="font-bold">{{ $review->user->name }}</p>
                    <p class="text-yellow-500">{{ str_repeat('⭐', $review->rating) }}</p>
                </div>
                <p class="text-gray-700 mt-2">{{ $review->comment }}</p>
            </div>
        @empty
            <p class="text-gray-600">No reviews yet. Be the first to review!</p>
        @endforelse
    </div>
</div>
@endsection