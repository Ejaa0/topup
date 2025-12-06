<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('customer.products.index', compact('products'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp|max:2048',
    ]);

    $data = $request->only(['name','description','price']);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products','public');
    }

    Product::create($data);

    return redirect()->route('admin.dashboard')->with('success','Produk berhasil ditambahkan');
}

public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,webp|max:2048',
    ]);

    $data = $request->only(['name','description','price']);

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }
        $data['image'] = $request->file('image')->store('products','public');
    }

    $product->update($data);

    return redirect()->route('admin.dashboard')->with('success','Produk berhasil diperbarui');
}

}
