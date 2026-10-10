@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Shopping Cart</h1>

@if($cartItems->count() > 0)
    <div class="bg-white rounded shadow p-6">
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Product</th>
                    <th class="text-left py-2">Price</th>
                    <th class="text-left py-2">Quantity</th>
                    <th class="text-left py-2">Subtotal</th>
                    <th class="text-left py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr class="border-b">
                        <td class="py-4">{{ $item->product->name }}</td>
                        <td class="py-4">${{ number_format($item->product->price, 2) }}</td>
                        <td class="py-4">
                            <form method="POST" action="{{ route('cart.update', $item->id) }}" class="flex gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 border rounded px-2 py-1">
                                <button type="submit" class="text-blue-600">Update</button>
                            </form>
                        </td>
                        <td class="py-4">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        <td class="py-4">
                            <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 flex justify-between items-center">
            <p class="text-2xl font-bold">Total: ${{ number_format($total, 2) }}</p>
            <form method="POST" action="{{ route('checkout') }}">
                @csrf
                <input type="text" name="coupon_code" placeholder="Coupon Code" class="border rounded px-3 py-2 mr-2">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Checkout</button>
            </form>
        </div>
    </div>
@else
    <div class="bg-white p-8 rounded shadow text-center">
        <p class="text-gray-600">Your cart is empty.</p>
        <a href="{{ route('home') }}" class="text-blue-600 mt-4 inline-block">Continue Shopping</a>
    </div>
@endif
@endsection