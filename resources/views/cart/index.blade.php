@extends('layouts.app')

@section('content')

<!-- Page Header with Home Link -->

@if($cartItems->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- ========== CART ITEMS (Left) ========== -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <table class="w-full">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="text-left py-3 px-2">Product</th>
                        <th class="text-left py-3 px-2">Price</th>
                        <th class="text-left py-3 px-2">Quantity</th>
                        <th class="text-left py-3 px-2">Subtotal</th>
                        <th class="py-3 px-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-4 px-2">
                                <p class="font-bold">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-600">per {{ $item->product->unit }}</p>
                                @if($item->product->is_fresh)
                                    <span class="text-green-600 text-xs">🌱 Fresh</span>
                                @endif
                            </td>
                            <td class="py-4 px-2">৳{{ number_format($item->product->price, 2) }}</td>
                            <td class="py-4 px-2">
                                <form method="POST" action="{{ route('cart.update', $item->id) }}" class="flex gap-2 items-center">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                                           min="1" max="{{ $item->product->stock }}"
                                           class="w-16 border rounded px-2 py-1 text-center">
                                    <button type="submit" class="text-blue-600 text-sm hover:underline">Update</button>
                                </form>
                            </td>
                            <td class="py-4 px-2 font-bold text-blue-600">
                                ৳{{ number_format($item->product->price * $item->quantity, 2) }}
                            </td>
                            <td class="py-4 px-2">
                                <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-bold" title="Remove">✕</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex justify-between items-center border-t pt-4">
                <a href="{{ route('home') }}" class="text-green-600 hover:underline font-semibold">
                    ← Continue Shopping
                </a>
                <p class="text-2xl font-bold">Subtotal: ৳{{ number_format($total, 2) }}</p>
            </div>
        </div>

        <!-- ========== CHECKOUT SIDEBAR (Right) ========== -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">📋 Checkout</h2>
            <form method="POST" action="{{ route('checkout') }}">
                @csrf

                <!-- Coupon Code -->
                <div class="mb-4">
                    <label class="block mb-2 font-bold text-sm">Coupon Code</label>
                    <input type="text" name="coupon_code" placeholder="e.g. GROCERY10"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:border-green-500">
                    <p class="text-xs text-gray-500 mt-1">Try: GROCERY10, SAVE100, FREEDEL</p>
                </div>

                <!-- Delivery Slot -->
                <div class="mb-4">
                    <label class="block mb-2 font-bold text-sm">Delivery Slot</label>
                    <select name="delivery_slot" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-green-500" required>
                        <option value="morning">🌅 Morning (8 AM - 12 PM)</option>
                        <option value="afternoon">☀️ Afternoon (12 PM - 4 PM)</option>
                        <option value="evening">🌆 Evening (4 PM - 8 PM)</option>
                    </select>
                </div>

                <!-- Delivery Area -->
                <div class="mb-4">
                    <label class="block mb-2 font-bold text-sm">Delivery Area</label>
                    <select name="delivery_area" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-green-500" required>
                        <option value="Dhaka">Dhaka (৳60)</option>
                        <option value="Chittagong">Chittagong (৳100)</option>
                        <option value="Sylhet">Sylhet (৳100)</option>
                        <option value="Other">Other (৳150)</option>
                    </select>
                </div>

                <!-- Order Summary -->
                <div class="bg-gray-50 p-3 rounded mb-4">
                    <div class="flex justify-between text-sm mb-1">
                        <span>Subtotal:</span>
                        <span class="font-bold">৳{{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>Delivery:</span>
                        <span class="font-bold">৳60 - ৳150</span>
                    </div>
                    <div class="flex justify-between text-sm border-t pt-2 mt-2">
                        <span class="font-bold">Total:</span>
                        <span class="font-bold text-green-600">Calculated at checkout</span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 font-bold transition">
                    ✅ Place Order
                </button>
            </form>
        </div>
    </div>

@else
    <!-- ========== EMPTY CART ========== -->
    <div class="bg-white p-12 rounded-lg shadow text-center">
        
        <p class="text-2xl font-bold text-gray-800 mb-2">Your cart is empty</p>
        <p class="text-gray-600 mb-8">Looks like you haven't added any products yet.</p>

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