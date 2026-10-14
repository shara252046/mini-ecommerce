@extends('layouts.app')

@section('content')

<!-- Welcome Section -->
<div class="mb-8 bg-white rounded-lg shadow-sm border-l-4 border-green-600 p-6">
    <div class="flex justify-between items-center flex-wrap gap-4">
        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">My Account</p>
            <h1 class="text-2xl font-bold text-gray-900 mt-1">
                Welcome, {{ auth()->user()->name }}
            </h1>
            <p class="text-gray-600 mt-1 text-sm">
                Manage your orders, wishlist, and account settings.
            </p>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-500 uppercase tracking-wide">Today's Date</p>
            <p class="text-lg font-semibold text-gray-800">{{ now()->format('l, d M Y') }}</p>
        </div>
    </div>
</div>

<!-- Customer Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm opacity-90">My Orders</p>
                <p class="text-3xl font-bold">{{ \App\Models\Order::where('user_id', auth()->id())->count() }}</p>
            </div>
            <div class="text-5xl opacity-50">📦</div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-pink-500 to-pink-600 text-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm opacity-90">My Wishlist</p>
                <p class="text-3xl font-bold">{{ \App\Models\Wishlist::where('user_id', auth()->id())->count() }}</p>
            </div>
            <div class="text-5xl opacity-50">❤️</div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm opacity-90">My Cart Items</p>
                <p class="text-3xl font-bold">{{ \App\Models\Cart::where('user_id', auth()->id())->count() }}</p>
            </div>
            <div class="text-5xl opacity-50">🛒</div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-xl font-bold mb-4">⚡ Quick Actions</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('home') }}" class="bg-green-600 text-white text-center py-4 rounded-lg hover:bg-green-700 transition">
            <div class="text-3xl mb-1">🛍️</div>
            <div class="font-bold">Start Shopping</div>
        </a>
        <a href="{{ route('cart.index') }}" class="bg-blue-600 text-white text-center py-4 rounded-lg hover:bg-blue-700 transition">
            <div class="text-3xl mb-1">🛒</div>
            <div class="font-bold">View Cart</div>
        </a>
        <a href="{{ route('wishlist.index') }}" class="bg-pink-600 text-white text-center py-4 rounded-lg hover:bg-pink-700 transition">
            <div class="text-3xl mb-1">❤️</div>
            <div class="font-bold">My Wishlist</div>
        </a>
        <a href="{{ route('orders.index') }}" class="bg-orange-600 text-white text-center py-4 rounded-lg hover:bg-orange-700 transition">
            <div class="text-3xl mb-1">📦</div>
            <div class="font-bold">My Orders</div>
        </a>
    </div>
</div>

<!-- Recent Orders -->
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">📦 My Recent Orders</h2>
        <a href="{{ route('orders.index') }}" class="text-blue-600 text-sm hover:underline">View All →</a>
    </div>
    @php 
        $myOrders = \App\Models\Order::where('user_id', auth()->id())->latest()->take(5)->get(); 
    @endphp
    @if($myOrders->count() > 0)
        <div class="space-y-2">
            @foreach($myOrders as $order)
                <div class="flex justify-between items-center py-2 border-b">
                    <div>
                        <p class="font-semibold">Order #{{ $order->id }}</p>
                        <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-blue-600">৳{{ number_format($order->total_amount, 2) }}</p>
                        <span class="text-xs px-2 py-1 rounded-full 
                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                            @elseif($order->status == 'delivered') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-center py-4">You have no orders yet. <a href="{{ route('home') }}" class="text-green-600 hover:underline">Start shopping →</a></p>
    @endif
</div>

@endsection