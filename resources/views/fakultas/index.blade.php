@extends('layout.menu')
@section('konten')

<a href="{{ route('fakultas.create') }}" title="Tambah data">Tambah Data</a>
<table class="table table table-bordered"  id="table">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Fakultas</th>
            <th>Prodi</th>
            <th>Kaprodi</th>
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
                <form onsubmit="return confirm('Yakin hapus data?');" method="POST" action="{{ route('fakultas.destroy', $d->id) }}">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('fakultas.edit', $d->id) }}">Edit</a>
                    <button type="submit">Hapus</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection