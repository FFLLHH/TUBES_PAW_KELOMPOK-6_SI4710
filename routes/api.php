<?php
use App\Http\Controllers\Api\OrderApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Pemesanan (Order)
Route::get('/orders', [OrderApiController::class, 'index']); // GET all orders
Route::get('/orders/{id}', [OrderApiController::class, 'show']); // GET order by id