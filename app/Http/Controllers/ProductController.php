<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        // Retrieve search and price range filters from the request
        $query = $request->input('query');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        // Filter and fetch products based on the query and price range
        $products = Product::when($query, function ($q) use ($query) {
                return $q->where('name', 'like', "%{$query}%")
                         ->orWhere('description', 'like', "%{$query}%");
            })
            ->when($minPrice, function ($q) use ($minPrice) {
                return $q->where('price', '>=', $minPrice);
            })
            ->when($maxPrice, function ($q) use ($maxPrice) {
                return $q->where('price', '<=', $maxPrice);
            })
            ->paginate(20); // Paginate products, showing 20 per page

        // Pass the products to the view
        return view('products.list', compact('products'));
    }

    // Other methods like create, store, edit, etc.
}
