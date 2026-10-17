<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function profitLoss()
    {
        // 1. Monthly Data for Chart & Table (Current Year)
        $currentYear = date('Y');
        
        $monthlyData = OrderItem::select(
            DB::raw('MONTH(orders.created_at) as month'),
            DB::raw('SUM(order_items.price * order_items.quantity) as revenue'),
            DB::raw('SUM(order_items.price * order_items.quantity * 0.80) as cost'),
            DB::raw('SUM(order_items.price * order_items.quantity * 0.20) as profit')
        )
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->whereIn('orders.status', ['delivered', 'shipped'])
        ->whereYear('orders.created_at', $currentYear)
        ->groupBy('month')
        ->get()
        ->keyBy('month');

        // 2. Product-wise Data (Lowest profit first)
        $productStats = OrderItem::select(
            'product_id',
            DB::raw('SUM(quantity) as total_sold'),
            DB::raw('SUM(price * quantity) as total_revenue'),
            DB::raw('SUM(price * quantity * 0.80) as total_cost'),
            DB::raw('SUM(price * quantity * 0.20) as total_profit')
        )
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->whereIn('orders.status', ['delivered', 'shipped'])
        ->groupBy('product_id')
        ->with('product')
        ->orderBy('total_profit', 'asc')
        ->get();

        // 3. Total Summaries
        $totalRevenue = $productStats->sum('total_revenue');
        $totalCost = $productStats->sum('total_cost');
        $totalProfit = $productStats->sum('total_profit');

        return view('admin.reports.profit-loss', compact(
            'monthlyData', 'currentYear', 'productStats', 
            'totalRevenue', 'totalCost', 'totalProfit'
        ));
    }
}

?>