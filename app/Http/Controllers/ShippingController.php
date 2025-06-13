<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index()
    {
        $shippings = Shipping::all();
        $title = 'Daftar Pengiriman';
        return view('admin.shippings.index', compact('shippings', 'title'));
    }

    public function create(Request $request)
    {
        $title = 'Tambah Pengiriman';
        $orders = Order::where('status', '<', 4)->get();
        $kurirs = User::where('role', 'kurir')->get();
        $selectedOrder = $request->order_code;
        return view('admin.shippings.create', compact('title', 'orders', 'kurirs', 'selectedOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_code' => 'required',
            'building_number' => 'required',
            'shipping_status' => 'required',
            'shipping_date' => 'nullable|date',
            'courier_id' => 'required',
        ]);
        Shipping::create([
            'order_code' => $request->order_code,
            'building_number' => $request->building_number,
            'shipping_status' => $request->shipping_status,
            'shipping_date' => $request->shipping_date,
            'courier_id' => $request->courier_id,
        ]);
        return redirect()->route('shippings.index')->with('success', 'Shipping created successfully.');
    }

    public function show(Shipping $shipping)
    {
        $title = 'Detail Pengiriman';
        $kurir = User::find($shipping->courier_id);
        return view('admin.shippings.show', compact('shipping', 'title', 'kurir'));
    }

    public function edit(Shipping $shipping)
    {
        $title = 'Edit Pengiriman';
        $orders = Order::where('status', '<', 4)->get();
        $kurirs = User::where('role', 'kurir')->get();
        return view('admin.shippings.edit', compact('shipping', 'title', 'orders', 'kurirs'));
    }

    public function update(Request $request, Shipping $shipping)
    {
        $request->validate([
            'order_code' => 'required',
            'building_number' => 'required',
            'shipping_date' => 'nullable|date',
            'courier_id' => 'required',
        ]);
        $shipping->update([
            'order_code' => $request->order_code,
            'building_number' => $request->building_number,
            'shipping_date' => $request->shipping_date,
            'courier_id' => $request->courier_id,
        ]);
        return redirect()->route('shippings.index')->with('success', 'Shipping updated successfully.');
    }

    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        return redirect()->route('shippings.index')->with('success', 'Shipping deleted successfully.');
    }
}
