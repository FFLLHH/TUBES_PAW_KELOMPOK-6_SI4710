<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderApiController extends Controller
{
    // API: GET all orders (JSON)
    public function index()
    {
        return response()->json(Order::all());
    }

    // API: GET order by id (JSON)
    public function show($id)
    {
        $order = Order::find($id);
        if ($order) {
            return response()->json($order);
        }
        return response()->json(['message' => 'Order not found'], 404);
    }
}
