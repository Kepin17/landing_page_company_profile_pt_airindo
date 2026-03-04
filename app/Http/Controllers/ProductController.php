<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search   = trim($request->input('search', ''));
        $category = $request->input('category', '');

        // Build a list of category names to filter by:
        // If the selected category is a parent, include all its children too.
        $filterNames = [];
        if ($category !== '') {
            $filterNames[] = $category;
            $parentMatch = Category::where('name', $category)->whereNull('parent_id')->first();
            if ($parentMatch) {
                $childNames = $parentMatch->children()->pluck('name')->toArray();
                $filterNames = array_merge($filterNames, $childNames);
            }
        }

        $products = Product::active()
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%");
                });
            })
            ->when($filterNames !== [], fn($q) => $q->whereIn('category', $filterNames))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Pass the full tree so the view can render grouped tabs and detect active parent
        $categoriesTree = Category::tree();

        // Determine which parent tab should be highlighted
        $activeParent = '';
        if ($category !== '') {
            foreach ($categoriesTree as $parent) {
                if ($parent->name === $category) {
                    $activeParent = $parent->name;
                    break;
                }
                foreach ($parent->children as $child) {
                    if ($child->name === $category) {
                        $activeParent = $parent->name;
                        break 2;
                    }
                }
            }
        }

        return view('products.index', compact('products', 'search', 'category', 'categoriesTree', 'activeParent'));
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
