<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts    = Product::count();
        $activeProducts   = Product::where('is_active', true)->count();
        $inactiveProducts = Product::where('is_active', false)->count();
        $latestProducts   = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'inactiveProducts',
            'latestProducts'
        ));
    }
}
