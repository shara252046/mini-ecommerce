<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function index()
    {
        $categories = Category::with(['products' => function ($query) {
            $query->latest()->take(8); 
        }])->get();

        return view('shop.index', compact('categories'));
    }

    
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->latest()
            ->paginate(12);
        $categories = Category::all();

        return view('shop.category', compact('category', 'products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with('reviews.user')->where('slug', $slug)->firstOrFail();
        return view('shop.show', compact('product'));
    }


   public function search(Request $request)
{
    $query = Product::query();

    // Filter by category (dropdown) - exact match
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // Filter by price range
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    $products = $query->get();

    // Search with fuzzy matching
    if ($request->filled('search')) {
        $searchTerm = strtolower(trim($request->search));
        
        $products = $products->filter(function ($product) use ($searchTerm) {
            // 1. Exact match in name
            if (stripos($product->name, $searchTerm) !== false) {
                return true;
            }
            
            // 2. Exact match in description
            if (stripos($product->description, $searchTerm) !== false) {
                return true;
            }
            
            // 3. Match in category name
            if (stripos($product->category->name, $searchTerm) !== false) {
                return true;
            }
            
            // 4. Fuzzy match - name similarity
            $name = strtolower($product->name);
            similar_text($name, $searchTerm, $percent1);
            if ($percent1 >= 50) return true;
            
            // 5. Fuzzy match - category similarity
            $catName = strtolower($product->category->name);
            similar_text($catName, $searchTerm, $percent2);
            if ($percent2 >= 60) return true;
            
            // 6. Levenshtein distance (small variations)
            $nameWords = explode(' ', $name);
            foreach ($nameWords as $word) {
                $lev = levenshtein($word, $searchTerm);
                $maxLen = max(strlen($word), strlen($searchTerm));
                if ($maxLen > 0 && ($lev / $maxLen) <= 0.4) { // 40% tolerance
                    return true;
                }
            }
            
            // 7. Levenshtein for category name
            $catWords = explode(' ', $catName);
            foreach ($catWords as $word) {
                $lev = levenshtein($word, $searchTerm);
                $maxLen = max(strlen($word), strlen($searchTerm));
                if ($maxLen > 0 && ($lev / $maxLen) <= 0.4) {
                    return true;
                }
            }
            
            return false;
        });
        
        // Re-paginate after filtering
        $products = new \Illuminate\Pagination\LengthAwarePaginator(
            $products->forPage(request('page', 1), 12),
            $products->count(),
            12,
            request('page', 1),
            ['path' => request()->url(), 'query' => request()->query()]
        );
    } else {
        // If no search, just paginate
        $products = $query->latest()->paginate(12);
    }

    $categories = Category::all();

    return view('shop.search', compact('products', 'categories'));
}
}

?>