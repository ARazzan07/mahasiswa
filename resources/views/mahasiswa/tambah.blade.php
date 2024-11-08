@extends('layout.menu')
@section('konten')

<form method="POST" action="{{ route('mahasiswa.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="nis">NIM:</label>
        <input type="text" name="nim" id="nim" class="form-control" required>
        @error('nim')
            {{ $message }} 
            @enderror
    </div>

    <div class="form-group">
        <label for="nama">Nama Lengkap:</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
        @error('nama')
            {{ $message }} 
            @enderror
    </div>

    <div class="form-group">
        <label for="nama">Foto Mahasiswa:</label>
        <input type="file" name="foto" id="foto" class="form-control" required>
        @error('foto')
            {{ $message }} 
            @enderror
    </div>

    <div class="form-group">
        <label for="jk">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jk" class="form-control" required>
            <option value="">~Pilih~</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        @error('jenis_kelamin')
            {{ $message }} 
            @enderror
    </div>

    <div class="form-group">
        <label for="tempat_lahir">Tempat Lahir:</label>
        <textarea name="tempat_lahir" id="tempat_lahir" class="form-control" rows="3"></textarea>
        @error('tempat_lahir')
            {{ $message }} 
            @enderror
    </div>

    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
        @error('tanggal_lahir')
            {{ $message }} 
            @enderror
    </div>

    <div class="form-group">
        <label for="tanggal_lahir">Fakultas</label>
        <select name="fakultas_id" id="" class="form-control" required>
            <option value="">~Pilih~</option>
            @foreach ($fakultas as $f)
            <option value="{{$f->id}}">{{$f->prodi}}</option>
            @endforeach
        </select>
        @error('fakultas_id')
            {{ $message }} 
            @enderror
    </div>

    <div class="form-group">
        <label for="nama">Lat:</label>
        <input type="double" name="lat" id="nama" class="form-control" required>
        @error('lat')
            {{ $message }} 
            @enderror
    </div>

    <div class="form-group">
        <label for="nama">Long:</label>
        <input type="double" name="long" id="nama" class="form-control" required>
        @error('long')
            {{ $message }} 
            @enderror
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

</form>

@endsection
