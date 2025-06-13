@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Detail Pengiriman</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Kode Order: {{ $shipping->order_code }}</h5>
            <p class="card-text"><strong>Alamat Pengiriman:</strong> {{ $shipping->shipping_address }}</p>
            <p class="card-text"><strong>Status Pengiriman:</strong> {{ $shipping->shipping_status }}</p>
            <p class="card-text"><strong>Tanggal Pengiriman:</strong> {{ $shipping->shipping_date }}</p>
            <a href="{{ route('shippings.edit', $shipping->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('shippings.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection