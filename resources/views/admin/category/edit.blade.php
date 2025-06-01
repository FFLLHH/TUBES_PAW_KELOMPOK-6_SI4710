@extends('admin.layout')
@section('css')
<style>
    #preview{
        width: 100%;
        height: 300px;
        display: none;
        object-fit: cover;
        margin-bottom: 20px;
    }
</style>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('categoryUpdate', $category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $category->name }}" onkeyup="check()" required>
                <small class="text-muted">Nama kategori harus unik</small>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="path">Gambar Kategori</label>
                <input type="file" class="form-control @error('path') is-invalid @enderror" id="path" name="path" onchange="previewImage(event)">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                @error('path')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <img src="{{ asset('shop/products/'.$category->path) }}" alt="" id="preview" class="mb-3">
            <button type="submit" class="btn btn-primary float-end" id="submit">Perbarui</button>
        </form>
    </div>
</div>
@endsection
@section('js')
<script>
    const check = () => {
        const name = document.getElementById('name').value;
        fetch(`{{ route('categoryCheck') }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                name: name
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.messages == 'not available' && name != '{{ $category->name }}'){
                document.getElementById('name').classList.add('is-invalid');
                document.getElementById('submit').disabled = true;
            }else{
                document.getElementById('name').classList.remove('is-invalid');
                document.getElementById('submit').disabled = false;
            }
        });
    }

    const previewImage = (event) => {
        const preview = document.getElementById('preview');
        preview.style.display = 'block';
        preview.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection 