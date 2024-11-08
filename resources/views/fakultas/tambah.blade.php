@extends('layout.menu')
@section('konten')

<form method="POST" action="{{ route('fakultas.store') }}"  enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="">Fakultas</label>
        <input type="text" name="fakultas" id="" class="form-control" required>
        @error('fakultas')
            {{ $message }} 
            @enderror
    </div>

    <div class="form-group">
        <label for="">Prodi</label>
        <input type="text" name="prodi" id="" class="form-control" required>
        @error('prodi')
            {{ $message }} 
            @enderror
    </div>

    <div class="form-group">
        <label for="tempat_lahir">Kaprodi</label>
        <input type="text" name="kaprodi" id="" class="form-control" required>
        @error('kaprodi')
            {{ $message }} 
            @enderror
    </div>

    <div class="form-group">
        <label for="nama">Foto Kaprodi:</label>
        <input type="file" name="foto" id="foto" class="form-control" required>
        @error('foto')
            {{ $message }} 
            @enderror
    </div>

 
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('fakultas.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

</form>

@endsection
