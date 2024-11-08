@extends('layout.menu')
@section('konten')



<a href="{{ route('mahasiswa.create') }}" class="btn btn-primary" title="Tambah Data ruangan"><i class="far fa-plus-square"></i> &nbsp;Tambah</a>
<a href="{{ route('mahasiswa.excel') }}" class="btn btn-primary" title="Export to EXCEL"><i class="far fa-plus-square"></i> &nbsp;Export to EXCEL</a>
<a href="{{ route('mahasiswa.pdf') }}" class="btn btn-primary" title="Export to PDF"><i class="far fa-plus-square"></i> &nbsp;Export to PDF</a>
<div style="overflow-x: auto; max-width: 100%; ">
<table class="table table table-bordered"  id="table"  style="width: 100%; min-width: 1500px; table-layout: auto;">
    <thead class="thead-dark">
         <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Lengkap</th>
            <th>Foto Mahasiswa</th>
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
            <td><img src="{{ Storage::url($d->foto) }}" alt="Foto mahasiswa" width="100"></td>
            <td> {{ $d->jenis_kelamin }} </td>
            <td> {{ $d->tempat_lahir }} </td>
            <td> {{ $d->tanggal_lahir }} </td>
            <td> {{ $d->fakultas->fakultas ?? '-' }} </td>
            <td> {{ $d->fakultas->prodi ?? '-' }} </td>
            <td> {{ $d->fakultas->kaprodi ?? '-' }} </td>
            <td>
            <form onsubmit="return confirm('Yakin hapus data?');" method="POST"action="{{ route('mahasiswa.destroy', $d->id) }}">
 @csrf
@method('DELETE')
<a href="{{ route('mahasiswa.edit', $d->id) }}" title="Edit Data" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
<button type="submit" class="btn btn-danger" title="Hapus Data"><i class="fas fa-trash-alt"></i></button>
@if(session('status'))
    <script>
        Swal.fire({
        title: "{{session('status')['judul']}}",
        text: "{{session('status')['pesan']}}",
        icon: "{{session('status')['icon']}}"
        });
    </script>
@endif

                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection