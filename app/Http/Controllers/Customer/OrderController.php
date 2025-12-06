<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create(Product $product)
    {
        return view('customer.orders.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'user_name' => 'required|string',
            'game_id'   => 'required|string',
            'server_id' => 'required|string',
            'phone'     => 'required|string',
            'quantity'  => 'required|integer|min:1',
            'payment_method' => 'required|string',
        ]);

        $total_price = $product->price * $request->quantity;
        $order_code  = strtoupper(Str::random(8));

        $order = Order::create([
            'order_code'      => $order_code,
            'product_id'      => $product->id,
            'user_name'       => $request->user_name,
            'game_id'         => $request->game_id,
            'server_id'       => $request->server_id,
            'phone'           => $request->phone,
            'quantity'        => $request->quantity,
            'total_price'     => $total_price,
            'payment_method'  => $request->payment_method,
            'status'          => 'pending',
        ]);

        return redirect()->route('orders.status', $order)
                         ->with('success', 'Order berhasil dibuat! Kode pesanan: '.$order_code);
    }

    public function status(Order $order)
    {
        return view('customer.orders.status', compact('order'));
    }

    // Upload bukti pembayaran → hanya simpan, status tidak berubah
    public function uploadPaymentProof(Request $request, Order $order)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        $fileName = time() . '_' . preg_replace('/\s+/', '_', $request->payment_proof->getClientOriginalName());
        $request->payment_proof->storeAs('payments', $fileName, 'public');

        // Update tanpa mengubah status!
        $order->update([
            'payment_proof' => $fileName,
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');
    }

    public function history(Request $request)
    {
        $orders = collect();

        if ($request->filled('order_code')) {
            $orders = Order::where('order_code', $request->order_code)->latest()->get();
        }

        return view('customer.orders.history', compact('orders'));
    }
}
