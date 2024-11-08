@extends('layout.menu')
@section('konten')

<a href="{{ route('fakultas.create') }}" class="btn btn-primary" title="Tambah Data Fakultas"><i class="far fa-plus-square"></i> &nbsp;Tambah</a>
<a href="{{ route('fakultas.excel') }}" class="btn btn-primary" title="Export to EXCEL"><i class="far fa-plus-square"></i> &nbsp;Export to EXCEL</a>
<a href="{{ route('fakultas.pdf') }}" class="btn btn-primary" title="Export to PDF"><i class="far fa-plus-square"></i> &nbsp;Export to PDF</a>
<div style="overflow-x: auto; max-width: 100%; ">
<table class="table table table-bordered"  id="table"  style="width: 100%; min-width: 1500px; table-layout: auto;">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Fakultas</th>
            <th>Prodi</th>
            <th>Kaprodi</th>
            <th>Foto Kaprodi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($fakultas as $d)
        <tr>
            <td> {{ $loop->iteration }} </td>
            <td> {{ $d->fakultas }} </td>
            <td> {{ $d->prodi }} </td>
            <td> {{ $d->kaprodi }} </td>
            <td>
            <img src="{{ Storage::url($d->foto) }}" alt="Foto Fakultas" width="100">
            </td>

            <td>
            <form onsubmit="return confirm('Yakin hapus data?');" method="POST"action="{{ route('fakultas.destroy', $d->id) }}">
 @csrf
@method('DELETE')
<a href="{{ route('fakultas.edit', $d->id) }}" title="Edit Data" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
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