<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        $products = $query->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'description' => 'required',
            'is_fresh' => 'nullable|boolean',
            'expiry_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_url' => 'nullable|url',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_fresh'] = $request->has('is_fresh') ? 1 : 0;

        // File Upload - Save to public/products
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('products'), $filename);
            $data['image'] = 'products/' . $filename;
        }
        // Image URL
        elseif ($request->filled('image_url')) {
            $data['image'] = $request->image_url;
        } else {
            unset($data['image']);
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Product created!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'description' => 'required',
            'is_fresh' => 'nullable|boolean',
            'expiry_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_url' => 'nullable|url',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_fresh'] = $request->has('is_fresh') ? 1 : 0;

        // File Upload - Save to public/products
        if ($request->hasFile('image')) {
            // Delete old image if exists (not URL)
            if ($product->image && !str_starts_with($product->image, 'http') && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('products'), $filename);
            $data['image'] = 'products/' . $filename;
        }
        // Image URL
        elseif ($request->filled('image_url')) {
            $data['image'] = $request->image_url;
        } else {
            unset($data['image']);
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        if ($product->image && !str_starts_with($product->image, 'http') && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted!');
    }
}