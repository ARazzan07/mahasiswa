<table border="1" class="table table table-bordered"  id="table">
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
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $d)
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
        </tr>
        @endforeach
    </tbody>
</table>
