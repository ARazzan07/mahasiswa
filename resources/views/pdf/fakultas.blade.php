<!-- resources/views/pdf/fakultas.blade.php -->
<html>
<head>
    <style>
        /* CSS tambahan jika diperlukan */
    </style>
</head>
<body>
    <h1>Data Fakultas</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Fakultas</th>
                <th>Prodi</th>
                <th>Kaprodi</th>
                <th>Foto Kaprodi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->fakultas }}</td>
                <td>{{ $data->prodi }}</td>
                <td>{{ $data->kaprodi }}</td>
                <td>
                    @if($data->foto)
                        <img src="{{ public_path('storage/' . str_replace('public/', '', $data->foto)) }}" width="100" alt="Foto Kaprodi">
                    @else
                        Tidak ada foto
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
