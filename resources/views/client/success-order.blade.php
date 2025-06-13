<x-template.layout title="{{ $title }}" >
  <x-organisms.navbar :path="$shop->path"/>
    <div class="container py-y d-flex flex-column align-items-center gap-3">
      <img src="{{ asset('client/img/success-order.png') }}" class="border rounded rounded-3" style="width:40%;height:auto;">
      <div class="text-center">
        <h4>Terima kasih atas pesanan Anda</h4>
        <p>Kode Pesanan : <u><b class="text-danger">{{ $order_code }}</b></u></p>
        <p>Anda dapat melacak pesanan Anda di <a href="{{ route('clientCheckOrder') }}"><u>Cek Pesanan</u></a>, harap simpan dan jangan lupa kode ini untuk mengecek status pesanan.</p>
      </div>
      <a href="{{ route('clientCheckOrder') }}" class="btn btn-primary">Cek Pesanan Sekarang</a>
    </div>
  <x-organisms.footer :shop="$shop"/>
</x-template.layout>