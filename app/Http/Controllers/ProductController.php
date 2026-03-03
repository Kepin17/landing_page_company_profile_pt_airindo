<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search   = trim($request->input('search', ''));
        $category = $request->input('category', '');

        $products = Product::active()
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%");
                });
            })
            ->when($category !== '', fn($q) => $q->where('category', $category))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = \App\Models\Product::CATEGORIES;

        return view('products.index', compact('products', 'search', 'category', 'categories'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->active()
            ->firstOrFail();

        // 3 related products excluding current
        $related = Product::active()
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(3)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}
