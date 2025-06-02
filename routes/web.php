<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin', [HomeController::class, 'index'])->name('home');

    // Orders
    Route::controller(OrderController::class)->group(function() {
        Route::get('/admin/orders', 'index')->name('orders');
        Route::get('/admin/order/{order_code}', 'detail')->name('orderDetail');
        Route::post('/admin/order/update-status/{order_code}', 'updateStatus')->name('orderUpdateStatus');
        Route::get('/admin/order/delete/{order_code}', 'delete')->name('orderDelete');
    });

});