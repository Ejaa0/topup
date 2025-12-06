<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Products
    Route::resource('products', ProductController::class);

    // Orders CRUD
    Route::resource('orders', OrderController::class)->only([
        'index', 'show', 'update', 'create', 'store', 'destroy'
    ]);

    // --- Tambahkan route khusus updateStatus ---
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('orders.updateStatus');

});
