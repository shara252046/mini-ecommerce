<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', auth()->id())->get();
        return view('wishlist.index', compact('wishlists'));
    }

    public function add($id)
    {
        Wishlist::firstOrCreate(['user_id' => auth()->id(), 'product_id' => $id]);
        return redirect()->back()->with('success', 'Added to wishlist!');
    }

    public function destroy($id)
    {
        Wishlist::where('user_id', auth()->id())->where('product_id', $id)->delete();
        return redirect()->back()->with('success', 'Removed from wishlist!');
    }
}

?>