@extends('admin.layout')
@section('button')
  <a href="{{ route('categoryCreate') }}" class="btn btn-outline-primary">Tambah Kategori</a>
@endsection
@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        @foreach ($category as $item)
          <div class="col-md-4 col-6">
            <div class="card shadow">
              <div class="d-flex" style="position:absolute;z-index:9;right:0;">
                <a href="{{ route('categoryEdit', $item->id) }}" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>
                <a href="javascript:void(0)" onclick="alertconfirm('{{route('categoryDelete', ['id' => $item->id, 'path' => $item->path] )}}')"  class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
              </div>
              <div class="card-content">
                <img src='{{ asset("shop/products/$item->path") }}' alt="" class="card-img-top img-fluid" style="height:200px;">
                <div class="card-body">
                  <h5 class="card-title">{!! str_replace('-', ' ', ucwords($item->name)) !!}</h5>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
@section('js')
<script>
const alertconfirm = (url) => {
    Swal.fire({
        title: 'Yakin ingin menghapus kategori ini?',
        text: "Kategori yang dihapus tidak dapat dipulihkan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace(url);
        }
    })
  }
</script>
@endsection