<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product')->where('user_id', auth()->id())->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        if ($cartItems->isEmpty()) return redirect()->back()->with('error', 'Cart is empty');

        DB::beginTransaction();
        try {
            $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            $discount = 0;
            
            if ($request->coupon_code) {
                $coupon = Coupon::where('code', $request->coupon_code)->where('expiry_date', '>=', now())->first();
                if ($coupon) {
                    $discount = $coupon->type === 'fixed' ? $coupon->value : ($total * $coupon->value / 100);
                }
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total - $discount,
                'coupon_code' => $request->coupon_code,
                'discount' => $discount,
                'status' => 'pending'
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
                $item->product->decrement('stock', $item->quantity);
            }

            Cart::where('user_id', auth()->id())->delete();
            DB::commit();

            return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}


?>