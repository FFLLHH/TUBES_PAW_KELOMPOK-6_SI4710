@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Daftar Pengiriman</h2>
    <a href="{{ route('shippings.create') }}" class="btn btn-primary mb-3">Tambah Pengiriman</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Order</th>
                <th>Alamat Pengiriman</th>
                <th>Status Pengiriman</th>
                <th>Tanggal Pengiriman</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shippings as $shipping)
            <tr>
                <td>{{ $shipping->id }}</td>
                <td>{{ $shipping->order_code }}</td>
                <td>{{ $shipping->shipping_address }}</td>
                <td>{{ $shipping->shipping_status }}</td>
                <td>{{ $shipping->shipping_date }}</td>
                <td>
                    <a href="{{ route('shippings.show', $shipping->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('shippings.edit', $shipping->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('shippings.destroy', $shipping->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
