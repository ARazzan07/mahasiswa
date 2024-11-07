@extends('layout.menu')
@section('konten')

<form method="POST" action="{{route('fakultas.update', $fakultas->id)}}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="">Fakultas</label>
        <input type="text" name="fakultas" id="" class="form-control" required value="{{ old('fakultas', $fakultas->fakultas) }}">
        @error('nim') <small class="form-text text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label for="">Prodi</label>
        <input type="text" name="prodi" id="" class="form-control" required value="{{ old('prodi', $fakultas->prodi) }}">
    </div>

    <div class="form-group">
        <label for="tempat_lahir">Kaprodi</label>
        <input type="text" name="kaprodi" id="" class="form-control" required value="{{ old('kaprodi', $fakultas->kaprodi) }}">
    </div>

 
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('fakultas.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

</form>

@endsection
