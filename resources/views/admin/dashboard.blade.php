@extends('layouts.app')

@section('content')

<!-- Top Header Area -->
<div class="flex justify-between items-center mb-6">
    <div>
        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Overview</p>
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
    </div>
    <div class="flex gap-2">
        <button class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50">+ New View</button>
        <a href="{{ route('admin.products.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700">+ Create Product</a>
    </div>
</div>

<!-- Stats Cards Row -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    
    <!-- Total Users -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex justify-between items-start mb-4">
            <div class="bg-gray-100 p-2 rounded-lg text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div class="flex items-end gap-1 h-8">
                <div class="w-1.5 bg-green-300 h-4 rounded-t"></div>
                <div class="w-1.5 bg-green-400 h-6 rounded-t"></div>
                <div class="w-1.5 bg-green-500 h-8 rounded-t"></div>
                <div class="w-1.5 bg-green-600 h-5 rounded-t"></div>
            </div>
        </div>
        <p class="text-sm text-gray-500 font-medium">TOTAL USERS</p>
        <div class="flex items-baseline gap-2 mt-1">
            <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\User::count() }}</h3>
            <span class="text-sm font-semibold text-green-600">+12%</span>
        </div>
        <p class="text-xs text-gray-400 mt-1">342 new this week</p>
    </div>

    <!-- Total Products -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex justify-between items-start mb-4">
            <div class="bg-blue-50 p-2 rounded-lg text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div class="flex items-end gap-1 h-8">
                <div class="w-1.5 bg-blue-300 h-6 rounded-t"></div>
                <div class="w-1.5 bg-blue-400 h-4 rounded-t"></div>
                <div class="w-1.5 bg-blue-500 h-8 rounded-t"></div>
                <div class="w-1.5 bg-blue-600 h-5 rounded-t"></div>
            </div>
        </div>
        <p class="text-sm text-gray-500 font-medium">TOTAL PRODUCTS</p>
        <div class="flex items-baseline gap-2 mt-1">
            <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\Product::count() }}</h3>
            <span class="text-sm font-semibold text-green-600">+8%</span>
        </div>
        <p class="text-xs text-gray-400 mt-1">5 out of stock</p>
    </div>

    <!-- Total Orders -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex justify-between items-start mb-4">
            <div class="bg-purple-50 p-2 rounded-lg text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div class="flex items-end gap-1 h-8">
                <div class="w-1.5 bg-purple-300 h-5 rounded-t"></div>
                <div class="w-1.5 bg-purple-400 h-7 rounded-t"></div>
                <div class="w-1.5 bg-purple-500 h-4 rounded-t"></div>
                <div class="w-1.5 bg-purple-600 h-8 rounded-t"></div>
            </div>
        </div>
        <p class="text-sm text-gray-500 font-medium">TOTAL ORDERS</p>
        <div class="flex items-baseline gap-2 mt-1">
            <h3 class="text-2xl font-bold text-gray-900">{{ \App\Models\Order::count() }}</h3>
            <span class="text-sm font-semibold text-green-600">+5%</span>
        </div>
        <p class="text-xs text-gray-400 mt-1">78 shipped today</p>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex justify-between items-start mb-2">
            <div class="bg-orange-50 p-2 rounded-lg text-orange-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-sm font-semibold text-green-600">+18%</span>
        </div>
        <p class="text-sm text-gray-500 font-medium">REVENUE</p>
        <h3 class="text-2xl font-bold text-gray-900 mt-1">৳{{ number_format(\App\Models\Order::sum('total_amount'), 2) }}</h3>
        <!-- Progress bar -->
        <div class="w-full bg-gray-100 rounded-full h-1.5 mt-4">
            <div class="bg-green-500 h-1.5 rounded-full" style="width: 65%"></div>
        </div>
        <p class="text-xs text-gray-400 mt-1">৳3,218 today</p>
    </div>

    <!-- Pending Orders -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex justify-between items-start mb-2">
            <div class="bg-red-50 p-2 rounded-lg text-red-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-sm font-semibold text-green-600">+5%</span>
        </div>
        <p class="text-sm text-gray-500 font-medium">PENDING ORDERS</p>
        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ \App\Models\Order::where('status', 'pending')->count() }}</h3>
        <!-- Progress bar -->
        <div class="w-full bg-gray-100 rounded-full h-1.5 mt-4">
            <div class="bg-red-500 h-1.5 rounded-full" style="width: 45%"></div>
        </div>
        <p class="text-xs text-gray-400 mt-1">Needs attention</p>
    </div>

    <!-- Total Categories -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex justify-between items-start mb-2">
            <div class="bg-pink-50 p-2 rounded-lg text-pink-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            </div>
            <span class="text-sm font-semibold text-green-600">+22%</span>
        </div>
        <p class="text-sm text-gray-500 font-medium">CATEGORIES</p>
        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ \App\Models\Category::count() }}</h3>
        <!-- Progress bar -->
        <div class="w-full bg-gray-100 rounded-full h-1.5 mt-4">
            <div class="bg-pink-500 h-1.5 rounded-full" style="width: 85%"></div>
        </div>
        <p class="text-xs text-gray-400 mt-1">6,854 unique views</p>
    </div>

</div>

<!-- Bottom Section: Chart & Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Network Activities (Chart) -->
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Sales Overview</h2>
                <p class="text-sm text-gray-500">Total sales this week</p>
            </div>
            <div class="flex bg-gray-100 p-1 rounded-lg text-sm">
                <button class="px-3 py-1 bg-white shadow-sm rounded-md font-medium text-gray-800">7 days</button>
                <button class="px-3 py-1 text-gray-500 hover:text-gray-800">30 days</button>
                <button class="px-3 py-1 text-gray-500 hover:text-gray-800">90 days</button>
            </div>
        </div>
        
        <!-- Chart Canvas -->
        <div class="relative h-64 w-full">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-gray-900">Recent Activity</h2>
            <button class="text-gray-400 hover:text-gray-600">...</button>
        </div>

        <div class="space-y-6">
            @php
                $recentOrders = \App\Models\Order::with('user')->latest()->take(3)->get();
            @endphp

            @forelse($recentOrders as $order)
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm flex-shrink-0">
                        {{ substr($order->user->name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm text-gray-800"><strong>{{ $order->user->name ?? 'Unknown' }}</strong> placed a new order for ৳{{ number_format($order->total_amount, 2) }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $order->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">No recent activity.</p>
            @endforelse

            <!-- Static Dummy Activity for UI -->
            <div class="flex gap-4">
                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-sm flex-shrink-0">M</div>
                <div>
                    <p class="text-sm text-gray-800"><strong>Michael R.</strong> registered a new account</p>
                    <p class="text-xs text-gray-500 mt-1">16 min ago</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="w-8 h-8 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-sm flex-shrink-0">P</div>
                <div>
                    <p class="text-sm text-gray-800"><strong>Payment processed</strong> - Invoice #4621</p>
                    <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<!-- Chart.js Script for the Sales Overview Graph -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        // Gradient for the line chart
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)'); // Green with opacity
        gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [
                    {
                        label: 'Revenue',
                        data: [1200, 1900, 1500, 2500, 2200, 3000, 3500],
                        borderColor: '#10B981', // Green
                        backgroundColor: gradient,
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#10B981',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                    },
                    {
                        label: 'Orders',
                        data: [800, 1200, 1000, 1800, 1500, 2000, 2400],
                        borderColor: '#3B82F6', // Blue
                        borderWidth: 2,
                        borderDash: [5, 5], // Dotted line
                        tension: 0.4,
                        pointRadius: 0,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Hides the legend to keep it clean
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        titleFont: { size: 13 },
                        bodyFont: { size: 13 },
                        padding: 10,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#F3F4F6', // Very light gray grid lines
                            drawBorder: false,
                        },
                        ticks: {
                            color: '#9CA3AF',
                            font: { size: 12 }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            color: '#9CA3AF',
                            font: { size: 12 }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        });
    });
</script>
@endpush