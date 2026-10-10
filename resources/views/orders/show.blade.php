@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Order #{{ $order->id }} Details</h1>
    
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <p class="text-gray-600">Order Date:</p>
            <p class="font-bold">{{ $order->created_at->format('d M Y, h:i A') }}</p>
        </div>
        <div>
            <p class="text-gray-600">Status:</p>
            <p class="font-bold">{{ ucfirst($order->status) }}</p>
        </div>
        <div>
            <p class="text-gray-600">Total Amount:</p>
            <p class="font-bold text-blue-600">${{ number_format($order->total_amount, 2) }}</p>
        </div>
        <div>
            <p class="text-gray-600">Discount:</p>
            <p class="font-bold text-red-600">-${{ number_format($order->discount, 2) }}</p>
        </div>
    </div>

    <h2 class="text-xl font-bold mb-4">Items</h2>
    <table class="w-full">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">Product</th>
                <th class="text-left py-2">Quantity</th>
                <th class="text-left py-2">Price</th>
                <th class="text-left py-2">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr class="border-b">
                    <td class="py-4">{{ $item->product->name }}</td>
                    <td class="py-4">{{ $item->quantity }}</td>
                    <td class="py-4">${{ number_format($item->price, 2) }}</td>
                    <td class="py-4">${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection