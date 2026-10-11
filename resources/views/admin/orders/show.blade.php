@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Order #{{ $order->id }} Details</h1>
        <a href="{{ route('admin.orders.index') }}" class="text-blue-600">← Back to Orders</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-gray-50 p-4 rounded">
            <h2 class="font-bold mb-2">Customer Info</h2>
            <p><strong>Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded">
            <h2 class="font-bold mb-2">Delivery Info</h2>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Delivery Slot:</strong> {{ ucfirst($order->delivery_slot ?? 'N/A') }}</p>
            <p><strong>Delivery Area:</strong> {{ $order->delivery_area ?? 'N/A' }}</p>
            <p><strong>Delivery Charge:</strong> ৳{{ number_format($order->delivery_charge ?? 0, 2) }}</p>
        </div>
    </div>

    <h2 class="text-xl font-bold mb-4">Order Items</h2>
    <table class="w-full mb-6">
        <thead>
            <tr class="border-b bg-gray-50">
                <th class="text-left py-2 px-4">Product</th>
                <th class="text-left py-2 px-4">Unit</th>
                <th class="text-left py-2 px-4">Quantity</th>
                <th class="text-left py-2 px-4">Price</th>
                <th class="text-left py-2 px-4">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $item->product->name }}</td>
                    <td class="py-3 px-4">{{ $item->product->unit ?? 'piece' }}</td>
                    <td class="py-3 px-4">{{ $item->quantity }}</td>
                    <td class="py-3 px-4">৳{{ number_format($item->price, 2) }}</td>
                    <td class="py-3 px-4">৳{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="bg-gray-50 p-4 rounded text-right">
        <p><strong>Discount:</strong> -৳{{ number_format($order->discount ?? 0, 2) }}</p>
        <p><strong>Delivery Charge:</strong> ৳{{ number_format($order->delivery_charge ?? 0, 2) }}</p>
        <p class="text-2xl font-bold text-blue-600">Total: ৳{{ number_format($order->total_amount, 2) }}</p>
    </div>
</div>
@endsection