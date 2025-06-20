<div class="container py-4">
    <form action="{{ route('clientCheckoutSave') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror bg-transparent" value="{{ old('name') }}" required>
            @error('name') 
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Nomor Telepon</label>
            <input type="text" name="phone" id="phone" class="form-control  @error('phone') is-invalid @enderror bg-transparent" value="{{ old('phone') }}" required>
            @error('phone') 
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Nomor Gedung</label>
            <input type="text" name="address" id="address" class="form-control  @error('address') is-invalid @enderror bg-transparent" value="{{ old('address') }}" required>
            @error('address') 
              <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="note">Catatan</label>
            <textarea name="note" id="note" cols="30" class="form-control @error('note') is-invalid @enderror bg-transparent">{{ old('note') }}</textarea>
            @error('note')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary float-end">Pesan</button>
    </form>
</div>
@push('js')
    <script>
        autosize();
        function autosize(){
            var text = $('#note');

            text.each(function(){
                $(this).attr('rows',1);
                resize($(this));
                this.style.overflow = 'hidden';
                this.style.backgroundColor = 'transparent';
            });

            text.on('input', function(){
                resize($(this));
            });
            
            function resize ($text) {
                $text.css('height', 'auto');
                $text.css('height', $text[0].scrollHeight+'px');
            }
        }

    </script>
@endpush