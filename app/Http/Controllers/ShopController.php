<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(9);
        $categories = Category::all();
        return view('shop.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with('reviews.user')->where('slug', $slug)->firstOrFail();
        return view('shop.show', compact('product'));
    }

    public function search(Request $request)
    {
        $query = Product::query();
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $products = $query->paginate(9);
        $categories = Category::all();
        return view('shop.index', compact('products', 'categories'));
    }
}

?>