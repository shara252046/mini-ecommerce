@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">My Orders</h1>

@if($orders->count() > 0)
    <div class="space-y-4">
        @foreach($orders as $order)
            <div class="bg-white rounded shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <p class="font-bold">Order #{{ $order->id }}</p>
                        <p class="text-gray-600 text-sm">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-blue-600">${{ number_format($order->total_amount, 2) }}</p>
                        <span class="px-3 py-1 rounded text-sm 
                            @if($order->status == 'pending') bg-yellow-200 text-yellow-800
                            @elseif($order->status == 'processing') bg-blue-200 text-blue-800
                            @elseif($order->status == 'shipped') bg-purple-200 text-purple-800
                            @elseif($order->status == 'delivered') bg-green-200 text-green-800
                            @else bg-red-200 text-red-800 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
                <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600">View Details →</a>
            </div>
        @endforeach
    </div>
@else
    <div class="bg-white p-8 rounded shadow text-center">
        <p class="text-gray-600">You have no orders yet.</p>
        <a href="{{ route('home') }}" class="text-blue-600 mt-4 inline-block">Start Shopping</a>
    </div>
@endif
@endsection