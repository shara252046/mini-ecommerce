@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Manage Orders</h1>

<div class="bg-white rounded shadow">
    <table class="w-full">
        <thead>
            <tr class="border-b bg-gray-50">
                <th class="text-left py-3 px-4">Order ID</th>
                <th class="text-left py-3 px-4">Customer</th>
                <th class="text-left py-3 px-4">Total</th>
                <th class="text-left py-3 px-4">Status</th>
                <th class="text-left py-3 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr class="border-b">
                    <td class="py-3 px-4">#{{ $order->id }}</td>
                    <td class="py-3 px-4">{{ $order->user->name }}</td>
                    <td class="py-3 px-4">${{ number_format($order->total_amount, 2) }}</td>
                    <td class="py-3 px-4">
                        <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" class="flex gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="border rounded px-2 py-1">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped