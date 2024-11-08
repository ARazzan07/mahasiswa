<table border="1" class="table table table-bordered"  id="table">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Fakultas</th>
            <th>Prodi</th>
            <th>Kaprodi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $d)
        <tr>
            <td> {{ $loop->iteration }} </td>
            <td> {{ $d->fakultas }} </td>
            <td> {{ $d->prodi }} </td>
            <td> {{ $d->kaprodi }} </td>
        </tr>
        @endforeach
    </tbody>
</table>