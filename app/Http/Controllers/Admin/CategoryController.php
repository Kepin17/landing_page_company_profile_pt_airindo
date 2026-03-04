<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::roots()->with(['children' => fn($q) => $q->orderBy('sort_order')])->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $order = Category::where('parent_id', $request->parent_id ?? null)->max('sort_order') + 1;

        Category::create([
            'name'       => trim($request->name),
            'parent_id'  => $request->parent_id ?: null,
            'sort_order' => $order,
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $category->update(['name' => trim($request->name)]);

        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        // Children are cascade-deleted by the DB foreign key
        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }

    public function reorder(Request $request)
    {
        $request->validate(['items' => 'required|array']);

        foreach ($request->items as $order => $id) {
            Category::where('id', $id)->update(['sort_order' => $order]);
        }

        return response()->json(['ok' => true]);
    }
}
