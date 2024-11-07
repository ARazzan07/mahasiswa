@extends('layout.menu')
@section('konten')

<a href="{{ route('mahasiswa.create') }}" title="Tambah data">Tambah Data</a>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Lengkap</th>
            <th>Jenis Kelamin</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mahasiswa as $d)
        <tr>
            <td> {{ $loop->iteration }} </td>
            <td> {{ $d->nim }} </td>
            <td> {{ $d->nama_lengkap }} </td>
            <td> {{ $d->jenis_kelamin }} </td>
            <td> {{ $d->tempat_lahir }} </td>
            <td> {{ $d->tanggal_lahir }} </td>
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