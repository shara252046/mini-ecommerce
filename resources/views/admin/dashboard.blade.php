@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold text-gray-600">Total Products</h3>
        <p class="text-4xl font-bold text-blue-600">{{ $totalProducts }}</p>
    </div>
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold text-gray-600">Total Orders</h3>
        <p class="text-4xl font-bold text-green-600">{{ $totalOrders }}</p>
    </div>
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-bold text-gray-600">Total Users</h3>
        <p class="text-4xl font-bold text-purple-600">{{ $totalUsers }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <a href="{{ route('admin.products.index') }}" class="bg-blue-600 text-white p-6 rounded shadow text-center hover:bg-blue-700">
        <h3 class="text-xl font-bold">Manage Products</h3>
    </a>
    <a href="{{ route('admin.categories.index') }}" class="bg-green-600 text-white p-6 rounded shadow text-center hover:bg-green-700">
        <h3 class="text-xl font-bold">Manage Categories</h3>
    </a>
    <a href="{{ route('admin.orders.index') }}" class="bg-yellow-600 text-white p-6 rounded shadow text-center hover:bg-yellow-700">
        <h3 class="text-xl font-bold">Manage Orders</h3>
    </a>
</div>
@endsection