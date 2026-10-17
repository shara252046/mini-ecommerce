@extends('layouts.app')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">📊 Monthly Profit & Loss</h1>
        <p class="text-sm text-gray-500">Year {{ $currentYear }} Overview</p>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="bg-gray-200 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-300">← Back</a>
</div>

<!-- ================= SUMMARY CARDS ================= -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 border-l-4 border-l-blue-500">
        <h3 class="text-sm font-bold text-gray-500 uppercase">Total Revenue</h3>
        <p class="text-3xl font-bold text-gray-900 mt-2">৳{{ number_format($totalRevenue, 2) }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 border-l-4 border-l-orange-500">
        <h3 class="text-sm font-bold text-gray-500 uppercase">Est. Total Cost</h3>
        <p class="text-3xl font-bold text-gray-900 mt-2">৳{{ number_format($totalCost, 2) }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 border-l-4 {{ $totalProfit >= 0 ? 'border-l-green-500' : 'border-l-red-500' }}">
        <h3 class="text-sm font-bold text-gray-500 uppercase">Total Profit</h3>
        <p class="text-3xl font-bold {{ $totalProfit >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
            {{ $totalProfit >= 0 ? '+' : '' }}৳{{ number_format($totalProfit, 2) }}
        </p>
    </div>
</div>

<!-- ================= CHART & MONTHLY TABLE ================= -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
    <h2 class="text-lg font-bold text-gray-900 mb-4">Monthly Trend</h2>
    
    <!-- Chart -->
    <div class="h-1 w-full mb-8">
        <canvas id="profitChart"></canvas>
    </div>

    <!-- Monthly Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <th class="p-3 border">Month</th>
                    <th class="p-3 border text-right">Revenue (৳)</th>
                    <th class="p-3 border text-right">Cost (৳)</th>
                    <th class="p-3 border text-right">Profit/Loss (৳)</th>
                </tr>
            </thead>
            <tbody>
                @for($m = 1; $m <= 12; $m++)
                    @php
                        $data = $monthlyData[$m] ?? null;
                        $rev = $data ? $data->revenue : 0;
                        $cost = $data ? $data->cost : 0;
                        $prof = $data ? $data->profit : 0;
                    @endphp
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 font-semibold">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</td>
                        <td class="p-3 text-right">৳{{ number_format($rev, 2) }}</td>
                        <td class="p-3 text-right text-gray-500">৳{{ number_format($cost, 2) }}</td>
                        <td class="p-3 text-right font-bold {{ $prof > 0 ? 'text-green-600' : ($prof < 0 ? 'text-red-600' : 'text-gray-400') }}">
                            {{ $prof > 0 ? '+' : '' }}{{ number_format($prof, 2) }}
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>

<!-- ================= PRODUCT-WISE LOSS ================= -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200 bg-red-50">
        <h2 class="text-lg font-bold text-red-800 flex items-center gap-2">
            ⚠️ Product-wise Profit/Loss Analysis
        </h2>
        <p class="text-sm text-red-600">Products with the lowest profit or loss are shown at the top.</p>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-xs text-gray-500 uppercase">
                    <th class="p-4 font-semibold">Product Name</th>
                    <th class="p-4 font-semibold text-center">Sold Qty</th>
                    <th class="p-4 font-semibold text-right">Revenue</th>
                    <th class="p-4 font-semibold text-right">Est. Cost</th>
                    <th class="p-4 font-semibold text-right">Profit</th>
                    <th class="p-4 font-semibold text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($productStats as $stat)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4 text-sm font-medium text-gray-900">
                            {{ $stat->product->name ?? 'Deleted Product' }}
                        </td>
                        <td class="p-4 text-sm text-center text-gray-600">{{ $stat->total_sold }}</td>
                        <td class="p-4 text-sm text-right font-semibold">৳{{ number_format($stat->total_revenue, 2) }}</td>
                        <td class="p-4 text-sm text-right text-gray-500">৳{{ number_format($stat->total_cost, 2) }}</td>
                        <td class="p-4 text-sm text-right font-bold {{ $stat->total_profit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $stat->total_profit >= 0 ? '+' : '' }}{{ number_format($stat->total_profit, 2) }}
                        </td>
                        <td class="p-4 text-center">
                            @if($stat->total_profit >= 0)
                                <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full">✅ Profit</span>
                            @else
                                <span class="bg-red-100 text-red-700 text-xs font-bold px-2 py-1 rounded-full">❌ Loss</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('profitChart').getContext('2d');
        
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        
        // from laravel to js
        const revenueData = @json(array_values(array_map(fn($m) => $monthlyData[$m]->revenue ?? 0, range(1, 12))));
        const costData = @json(array_values(array_map(fn($m) => $monthlyData[$m]->cost ?? 0, range(1, 12))));
        const profitData = @json(array_values(array_map(fn($m) => $monthlyData[$m]->profit ?? 0, range(1, 12))));

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Revenue',
                        data: revenueData,
                        borderColor: '#3B82F6', // Blue
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                    },
                    {
                        label: 'Cost',
                        data: costData,
                        borderColor: '#F97316', // Orange
                        borderWidth: 2,
                        borderDash: [5, 5],
                        tension: 0.4,
                    },
                    {
                        label: 'Profit',
                        data: profitData,
                        borderColor: '#10B981', // Green
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#10B981',
                        pointRadius: 4,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ৳' + context.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) { return '৳' + value; }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush