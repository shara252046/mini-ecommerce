@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Manage Orders</h1>
    <a href="{{ route('admin.dashboard') }}" class="text-blue-600">← Back to Dashboard</a>
</div>

<div class="bg-white rounded shadow">
    <table class="w-full">
        <thead>
            <tr class="border-b bg-gray-50">
                <th class="text-left py-3 px-4">Order ID</th>
                <th class="text-left py-3 px-4">Customer</th>
                <th class="text-left py-3 px-4">Total</th>
                <th class="text-left py-3 px-4">Delivery</th>
                <th class="text-left py-3 px-4">Status</th>
                <th class="text-left py-3 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr class="border-b">
                    <td class="py-3 px-4">#{{ $order->id }}</td>
                    <td class="py-3 px-4">{{ $order->user->name }}</td>
                    <td class="py-3 px-4">৳{{ number_format($order->total_amount, 2) }}</td>
                    <td class="py-3 px-4">
                        <span class="text-sm">
                            {{ ucfirst($order->delivery_slot ?? 'N/A') }}<br>
                            <span class="text-gray-500">{{ $order->delivery_area ?? 'N/A' }}</span>
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" class="flex gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="border rounded px-2 py-1">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Out for Delivery</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm">Update</button>
                        </form>
                    </td>
                    <td class="py-3 px-4">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:underline">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-600">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $orders->links() }}</div>
@endsection