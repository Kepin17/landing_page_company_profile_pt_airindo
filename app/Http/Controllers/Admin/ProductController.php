<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'category'          => 'nullable|string|in:' . implode(',', \App\Models\Product::CATEGORIES),
            'short_description' => 'nullable|string|max:300',
            'description'       => 'required|string',
            'specifications'    => 'nullable|array',
            'specifications.*.label' => 'required_with:specifications|string|max:100',
            'specifications.*.value' => 'required_with:specifications|string|max:255',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'shopee_link'       => 'nullable|url|max:500',
            'tokopedia_link'    => 'nullable|url|max:500',
        ]);

        // Filter out empty spec rows
        if (!empty($validated['specifications'])) {
            $validated['specifications'] = array_values(
                array_filter($validated['specifications'], fn($s) => !empty($s['label']) && !empty($s['value']))
            );
            if (empty($validated['specifications'])) {
                $validated['specifications'] = null;
            }
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(Product $product)
    {
        return redirect()->route('admin.products.edit', $product);
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'category'          => 'nullable|string|in:' . implode(',', \App\Models\Product::CATEGORIES),
            'short_description' => 'nullable|string|max:300',
            'description'       => 'required|string',
            'specifications'    => 'nullable|array',
            'specifications.*.label' => 'required_with:specifications|string|max:100',
            'specifications.*.value' => 'required_with:specifications|string|max:255',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'shopee_link'       => 'nullable|url|max:500',
            'tokopedia_link'    => 'nullable|url|max:500',
        ]);

        // Filter out empty spec rows
        if (!empty($validated['specifications'])) {
            $validated['specifications'] = array_values(
                array_filter($validated['specifications'], fn($s) => !empty($s['label']) && !empty($s['value']))
            );
            if (empty($validated['specifications'])) {
                $validated['specifications'] = null;
            }
        }

        $validated['is_active'] = $request->boolean('is_active', false);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    public function toggle(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Status produk berhasil diubah!');
    }
}
