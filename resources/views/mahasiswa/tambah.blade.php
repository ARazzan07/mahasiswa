@extends('layout.menu')
@section('konten')

<form method="POST" action="{{ route('mahasiswa.store') }}">
    @csrf

    <div class="form-group">
        <label for="nis">NIM:</label>
        <input type="text" name="nim" id="nim" class="form-control" required>
        @error('nim') <small class="form-text text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label for="nama">Nama Lengkap:</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="jk">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jk" class="form-control" required>
            <option value="">~Pilih~</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
    </div>

    <div class="form-group">
        <label for="tempat_lahir">Tempat Lahir:</label>
        <textarea name="tempat_lahir" id="tempat_lahir" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="tanggal_lahir">Fakultas</label>
        <select name="fakultas_id" id="" class="form-control" required>
            <option value="">~Pilih~</option>
            @foreach ($fakultas as $f)
            <option value="{{$f->id}}">{{$f->prodi}}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

</form>

@endsection
