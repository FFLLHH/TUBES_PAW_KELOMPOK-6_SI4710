<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ShippingController;

// Root redirect to login
Route::redirect('/', '/login');

// Pelanggan
Route::controller(ClientController::class)->group(function(){
    Route::get('/home', 'products')->name('clientHome');
    Route::get('/products', 'products')->name('clientProducts');
    Route::get('/products-search', 'searchProduct')->name('clientProductSearch');
    Route::get('/category', 'category')->name('clientCategory');
    Route::get('/category/{category}', 'categoryProducts')->name('clientCategoryProducts');
    Route::get('/product/{product}', 'productDetail')->name('clientProductDetail');
    Route::get('/carts', 'carts')->name('clientCarts');
    Route::post('/add-to-cart', 'addToCart')->name('clientAddToCart');
    Route::post('/update-cart', 'updateCart')->name('clientUpdateCart');
    Route::post('/delete-cart', 'deleteCart')->name('clientDeleteCart');
    Route::get('/checkout', 'checkout')->name('clientCheckout');
    Route::post('/checkout-save', 'checkoutSave')->name('clientCheckoutSave');
    Route::get('/success/{order_code}', 'successOrder')->name('clientOrderCode');
    Route::get('/check-order', 'checkOrder')->name('clientCheckOrder');
    Route::post('/check-order-status', 'checkOrderStatus')->name('clientCheckOrderStatus');
    Route::get('/about', 'about')->name('clientAbout');
});

Route::controller(CartController::class)->group(function(){
    Route::get('/carts', 'carts')->name('clientCarts');
    Route::post('/add-to-cart', 'addToCart')->name('clientAddToCart');
    Route::post('/update-cart', 'updateCart')->name('clientUpdateCart');
    Route::post('/delete-cart', 'deleteCart')->name('clientDeleteCart');
});

Auth::routes(['logout' => false]); // Disable default logout route
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout'); // Add custom logout route

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::resource('shippings', ShippingController::class);
    Route::get('/admin', [HomeController::class, 'index'])->name('home');
    
    // Shop
    Route::controller(ShopController::class)->group(function() {
        Route::post('/shop/create', 'create')->name('shopCreate');
        Route::get('/shop', 'detail')->name('shopDetail');
        Route::post('/shop/update', 'update')->name('shopUpdate');
        Route::post('/shop/update-password', 'updatePassword')->name('shopUpdatePassword');
    });

    // Category
    Route::controller(CategoryController::class)->group(function() {
        Route::get('/admin/category', 'index')->name('category');
        Route::get('/admin/category/create', 'create')->name('categoryCreate');
        Route::post('/admin/category/check', 'check')->name('categoryCheck');
        Route::post('/admin/category/save', 'save')->name('categorySave');
        Route::get('/admin/category/delete/{id}/{path}', 'delete')->name('categoryDelete');
        Route::get('/admin/category/edit/{id}', 'edit')->name('categoryEdit');
        Route::post('/admin/category/update/{id}', 'update')->name('categoryUpdate');
    });

    // Product
    Route::controller(ProductController::class)->group(function() {
        Route::get('/admin/products', 'index')->name('products');
        Route::get('/admin/product/create', 'create')->name('productCreate');
        Route::post('/admin/product/check', 'check')->name('productCheck');
        Route::post('/admin/product/save', 'save')->name('producSave');
        Route::post('/admin/product/images/', 'getImages')->name('productGetImages');
        Route::get('/admin/product/images/{product}', 'addImages')->name('productAddImages');
        Route::post('/admin/product/images/save', 'addImagesSave')->name('productAddImagesSave');
        Route::post('/admin/product/images/delete', 'deleteImages')->name('productDeleteImages');
        Route::get('/admin/product/edit/{product}', 'edit')->name('productEdit');
        Route::post('/admin/product/edit/{product}/{id}/save', 'editSave')->name('productEditSave');
        Route::get('/admin/product/delete/{id}', 'delete')->name('productDelete');
    });

    // Orders
    Route::controller(OrderController::class)->group(function() {
        Route::get('/admin/orders', 'index')->name('orders');
        Route::get('/admin/order/{order_code}', 'detail')->name('orderDetail');
        Route::post('/admin/order/update-status/{order_code}', 'updateStatus')->name('orderUpdateStatus');
        Route::get('/admin/order/delete/{order_code}', 'delete')->name('orderDelete');
    });

    // User Management Routes
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('userCreate');
    Route::post('/users/store', [UserController::class, 'store'])->name('userStore');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('userEdit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('userUpdate');
    Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('userDelete');

    // Shipping CRUD
    Route::controller(ShippingController::class)->group(function() {
        Route::get('/admin/shippings', 'index')->name('shippings.index');
        Route::get('/admin/shippings/create', 'create')->name('shippings.create');
        Route::post('/admin/shippings/store', 'store')->name('shippings.store');
        Route::get('/admin/shippings/{shipping}', 'show')->name('shippings.show');
        Route::get('/admin/shippings/{shipping}/edit', 'edit')->name('shippings.edit');
        Route::post('/admin/shippings/{shipping}/update', 'update')->name('shippings.update');
        Route::get('/admin/shippings/{shipping}/delete', 'destroy')->name('shippings.destroy');
    });
});
