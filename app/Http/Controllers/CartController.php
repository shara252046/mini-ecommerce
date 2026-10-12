<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        // Stock check
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Product is out of stock!');
        }

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::findOrFail($id);
        $cart->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function destroy($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}

?>