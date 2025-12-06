<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| Redirect Homepage → Pembeli
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/pembeli');
});

/*
|--------------------------------------------------------------------------
| Halaman Pembeli / Katalog
|--------------------------------------------------------------------------
*/
Route::get('/pembeli', [ProductController::class, 'index'])->name('home');

// Katalog produk
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Form order berdasarkan produk
Route::get('/order/{product}', [OrderController::class, 'create'])->name('orders.create');

// Simpan order
Route::post('/order/{product}', [OrderController::class, 'store'])->name('orders.store');

// Riwayat order
Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');

// Lihat status order
Route::get('/order/status/{order}', [OrderController::class, 'status'])->name('orders.status');

// Upload bukti pembayaran
Route::post('/orders/{order}/upload-proof', [OrderController::class, 'uploadPaymentProof'])
    ->name('orders.upload-proof');



//    Halaman Admin (delete order saja)

Route::delete('/admin/orders/{order}', [AdminOrderController::class, 'destroy'])
    ->name('admin.orders.destroy');
