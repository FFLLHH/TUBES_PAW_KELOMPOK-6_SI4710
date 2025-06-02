@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('shippings.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="order_code" class="form-label">Kode Order</label>
                    <select class="form-control @error('order_code') is-invalid @enderror" id="order_code" name="order_code" required>
                        <option value="">-- Pilih Order --</option>
                        @foreach($orders as $order)
                            <option value="{{ $order->order_code }}" {{ (isset($selectedOrder) && $selectedOrder == $order->order_code) ? 'selected' : '' }}>
                                {{ $order->order_code }} - {{ $order->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('order_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="building_number" class="form-label">Nomor Gedung</label>
                    <input type="text" class="form-control @error('building_number') is-invalid @enderror" id="building_number" name="building_number" required>
                    @error('building_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="shipping_status" class="form-label">Status Pengiriman</label>
                    <select class="form-control @error('shipping_status') is-invalid @enderror" id="shipping_status" name="shipping_status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                    </select>
                    @error('shipping_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="shipping_date" class="form-label">Tanggal Pengiriman</label>
                    <input type="date" class="form-control @error('shipping_date') is-invalid @enderror" id="shipping_date" name="shipping_date">
                    @error('shipping_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="courier_id" class="form-label">Kurir</label>
                    <select class="form-control @error('courier_id') is-invalid @enderror" id="courier_id" name="courier_id" required>
                        <option value="">-- Pilih Kurir --</option>
                        @foreach($kurirs as $kurir)
                            <option value="{{ $kurir->id }}">{{ $kurir->name }}</option>
                        @endforeach
                    </select>
                    @error('courier_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('shippings.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
