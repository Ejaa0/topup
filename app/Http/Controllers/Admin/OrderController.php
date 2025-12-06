<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // Daftar semua pesanan
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Detail pesanan
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    // Update status pesanan (versi lengkap)
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,done,cancelled'
        ]);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // Update status pesanan (versi lain)
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,done'
        ]);

        $order->update(['status' => $request->status]);
        return redirect()->route('admin.orders.index')
                         ->with('success', 'Status pesanan berhasil diperbarui');
    }

    // Form tambah pesanan baru
    public function create()
    {
        $products = Product::all();
        return view('admin.orders.create', compact('products'));
    }

    // Simpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_name'  => 'required|string',
            'game_id'    => 'required|string',
            'server_id'  => 'required|string',
            'phone'      => 'required|string',
            'status'     => 'required|in:pending,done',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Buat kode unik
        $order_code = strtoupper(Str::random(8));

        Order::create([
            'order_code'  => $order_code,
            'product_id'  => $request->product_id,
            'user_name'   => $request->user_name,
            'game_id'     => $request->game_id,
            'server_id'   => $request->server_id,
            'phone'       => $request->phone,
            'status'      => $request->status,
            'quantity'    => $request->quantity,
            'total_price' => $product->price * $request->quantity,
        ]);

        return redirect()->route('admin.dashboard')
                         ->with('success','Pesanan baru berhasil ditambahkan. Kode: '.$order_code);
    }

    // Hapus pesanan
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')
                         ->with('success', 'Pesanan berhasil dihapus');
    }

}
