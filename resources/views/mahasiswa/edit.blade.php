@extends('layout.menu')
@section('konten')

<form method="POST" action="{{ route('mahasiswa.update', $mahasiswa->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nis">NIM:</label>
        <input type="text" name="nim" id="nim" class="form-control" readonly value="{{ old('nim', $mahasiswa->nim) }}">
        @error('nim') <small class="form-text text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label for="nama_lengkap">Nama Lengkap:</label>
        <input type="text" name="nama" id="nama" class="form-control" required value="{{ old('nama', $mahasiswa->nama) }}">
    </div>

    <div class="form-group">
        <label for="foto">Foto Mahasiswa</label>
        
        <!-- Tampilkan gambar lama jika ada -->
        @if($mahasiswa->foto)
            <img src="{{ Storage::url($mahasiswa->foto) }}" alt="Foto Mahasiswa" width="150" class="mb-3">
        @endif

        <input type="file" name="foto" id="foto" class="form-control">
        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti foto</small>
        @error('foto')
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
            <option value="">~Pilih~</option>
            <option value="Laki-laki" {{ $mahasiswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ $mahasiswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <div class="form-group">
        <label for="tempat_lahir">Tempat Lahir:</label>
        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir) }}">
    </div>

    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir) }}">
    </div>

    <div class="form-group">
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
            <option value="">~Pilih~</option>
            <option value="Laki-laki" {{ $mahasiswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ $mahasiswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <div class="form-group">
        <label for="tanggal_lahir">Fakultas</label>
        <select name="fakultas_id" id="" class="form-control" required>
            <option value="">~Pilih~</option>
            @foreach ($fakultas as $f)
            <option value="{{$f->id}}" {{$mahasiswa->fakultas_id == $f->id ? 'selected' : ''}}>{{$f->prodi}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="nama">Lat:</label>
        <input type="double" name="lat" id="nama" class="form-control" required value="{{ old('lat', $mahasiswa->lat) }}">
        @error('lat')
            {{ $message }} 
            @enderror
    </div>

    <div class="form-group">
        <label for="nama">Long:</label>
        <input type="double" name="long" id="nama" class="form-control" required value="{{ old('long', $mahasiswa->long) }}">
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
