<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua produk dan pesanan untuk dashboard
        $products = Product::all();
        $orders = Order::latest()->get();

        return view('admin.dashboard', compact('products', 'orders'));
    }
}
