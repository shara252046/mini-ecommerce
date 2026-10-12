@extends('layouts.app')

@section('content')

<div class="mb-8 bg-white rounded-lg shadow-sm border-l-4 border-green-600 p-6">
    <div class="flex justify-between items-center flex-wrap gap-4">
        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Dashboard</p>
            <h1 class="text-2xl font-bold text-gray-900 mt-1">
                Welcome, {{ auth()->user()->name }}
            </h1>
            <p class="text-gray-600 mt-1 text-sm">
                Here's your shop's performance summary for today.
            </p>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-500 uppercase tracking-wide">Today's Date</p>
            <p class="text-lg font-semibold text-gray-800">{{ now()->format('l, d M Y') }}</p>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm opacity-90">Total Products</p>
                <p class="text-3xl font-bold">{{ \App\Models\Product::count() }}</p>
            </div>
            <div class="text-5xl opacity-50">🛍️</div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm opacity-90">Total Categories</p>
                <p class="text-3xl font-bold">{{ \App\Models\Category::count() }}</p>
            </div>
            <div class="text-5xl opacity-50">📂</div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm opacity-90">Total Orders</p>
                <p class="text-3xl font-bold">{{ \App\Models\Order::count() }}</p>
            </div>
            <div class="text-5xl opacity-50">📦</div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm opacity-90">Total Users</p>
                <p class="text-3xl font-bold">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="text-5xl opacity-50">👥</div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-xl font-bold mb-4">⚡ Quick Actions</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.products.create') }}" 
           class="bg-blue-600 text-white text-center py-4 rounded-lg hover:bg-blue-700 transition">
            <div class="text-3xl mb-1">➕</div>
            <div class="font-bold">Add Product</div>
        </a>
        <a href="{{ route('admin.categories.create') }}" 
           class="bg-green-600 text-white text-center py-4 rounded-lg hover:bg-green-700 transition">
            <div class="text-3xl mb-1">📁</div>
            <div class="font-bold">Add Category</div>
        </a>
        <a href="{{ route('admin.products.index') }}" 
           class="bg-purple-600 text-white text-center py-4 rounded-lg hover:bg-purple-700 transition">
            <div class="text-3xl mb-1">📋</div>
            <div class="font-bold">Manage Products</div>
        </a>
        <a href="{{ route('admin.orders.index') }}" 
           class="bg-orange-600 text-white text-center py-4 rounded-lg hover:bg-orange-700 transition">
            <div class="text-3xl mb-1">🛒</div>
            <div class="font-bold">Manage Orders</div>
        </a>
    </div>
</div>

<!-- Recent Orders & Low Stock -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">📦 Recent Orders</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-blue-600 text-sm hover:underline">View All →</a>
        </div>
        @php $recentOrders = \App\Models\Order::with('user')->latest()->take(5)->get(); @endphp
        @if($recentOrders->count() > 0)
            <div class="space-y-2">
                @foreach($recentOrders as $order)
                    <div class="flex justify-between items-center py-2 border-b">
                        <div>
                            <p class="font-semibold">#{{ $order->id }} - {{ $order->user->name }}</p>
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
            <p class="text-gray-500 text-center py-4">No orders yet.</p>
        @endif
    </div>

    <!-- Low Stock Alert -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">⚠️ Low Stock Alert</h2>
            <a href="{{ route('admin.products.index') }}" class="text-blue-600 text-sm hover:underline">View All →</a>
        </div>
        @php $lowStock = \App\Models\Product::where('stock', '<', 50)->orderBy('stock')->take(5)->get(); @endphp
        @if($lowStock->count() > 0)
            <div class="space-y-2">
                @foreach($lowStock as $product)
                    <div class="flex justify-between items-center py-2 border-b">
                        <div>
                            <p class="font-semibold">{{ $product->name }}</p>
                            <p class="text-xs text-gray-500">{{ $product->category->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-red-600">{{ $product->stock }} {{ $product->unit }}</p>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-xs text-blue-600 hover:underline">Update →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">All products well stocked! ✅</p>
        @endif
    </div>
</div>

<!-- Shop Overview -->
<div class="bg-white rounded-lg shadow p-6 mt-6">
    <h2 class="text-xl font-bold mb-4">🏪 Shop Overview</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="text-center p-4 bg-gray-50 rounded">
            <p class="text-2xl font-bold text-green-600">৳{{ number_format(\App\Models\Order::sum('total_amount'), 2) }}</p>
            <p class="text-sm text-gray-600 mt-1">Total Revenue</p>
        </div>
        <div class="text-center p-4 bg-gray-50 rounded">
            <p class="text-2xl font-bold text-blue-600">{{ \App\Models\Order::where('status', 'pending')->count() }}</p>
            <p class="text-sm text-gray-600 mt-1">Pending Orders</p>
        </div>
        <div class="text-center p-4 bg-gray-50 rounded">
            <p class="text-2xl font-bold text-purple-600">{{ \App\Models\Order::where('status', 'delivered')->count() }}</p>
            <p class="text-sm text-gray-600 mt-1">Delivered</p>
        </div>
        <div class="text-center p-4 bg-gray-50 rounded">
            <p class="text-2xl font-bold text-orange-600">{{ \App\Models\Product::where('is_fresh', 1)->count() }}</p>
            <p class="text-sm text-gray-600 mt-1">Fresh Products</p>
        </div>
    </div>
</div>

@endsection