@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">My Wishlist</h1>

@if($wishlists->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($wishlists as $wishlist)
            <div class="bg-white rounded shadow p-4">
                @if($wishlist->product->image)
                    <img src="{{ asset('storage/' . $wishlist->product->image) }}" class="w-full h-48 object-cover rounded">
                @endif
                <h3 class="text-xl font-bold mt-2">{{ $wishlist->product->name }}</h3>
                <p class="text-blue-600 font-bold">${{ number_format($wishlist->product->price, 2) }}</p>
                <div class="mt-4 flex gap-2">
                    <form method="POST" action="{{ route('cart.add', $wishlist->product->id) }}" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Add to Cart</button>
                    </form>
                    <form method="POST" action="{{ route('wishlist.remove', $wishlist->product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="bg-white p-8 rounded shadow text-center">
        <p class="text-gray-600">Your wishlist is empty.</p>
    </div>
@endif
@endsection