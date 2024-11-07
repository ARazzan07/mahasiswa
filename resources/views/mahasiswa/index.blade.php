@extends('layout.menu')
@section('konten')



<a href="{{ route('mahasiswa.create') }}" class="btn btn-primary" title="Tambah Data ruangan"><i class="far fa-plus-square"></i> &nbsp;Tambah</a>
<a href="{{ route('excel') }}" class="btn btn-primary" title="Tambah Data ruangan"><i class="far fa-plus-square"></i> &nbsp;Export to EXCEL</a>
<a href="{{ route('pdf') }}" class="btn btn-primary" title="Tambah Data ruangan"><i class="far fa-plus-square"></i> &nbsp;Export to PDF</a>
<table class="table table table-bordered"  id="table">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Fakultas</th>
            <th>Prodi</th>
            <th>Kaprodi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mahasiswa as $d)
        <tr>
            <td> {{ $loop->iteration }} </td>
            <td> {{ $d->nim }} </td>
            <td> {{ $d->nama }} </td>
            <td> {{ $d->jenis_kelamin }} </td>
            <td> {{ $d->tempat_lahir }} </td>
            <td> {{ $d->tanggal_lahir }} </td>
            <td> {{ $d->fakultas }} </td>
            <td> {{ $d->prodi }} </td>
            <td> {{ $d->kaprodi }} </td>
            <td>
                <form onsubmit="return confirm('Yakin hapus data?');" method="POST" action="{{ route('mahasiswa.destroy', $d->id) }}">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('mahasiswa.edit', $d->id) }}">Edit</a>
                    <button type="submit">Hapus</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection