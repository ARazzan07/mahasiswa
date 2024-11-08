<!-- resources/views/pdf/mahasiswa.blade.php -->
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <table>
        <thead>
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
                <th>Foto Kaprodi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $index => $mhs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>
                    @if($mhs->foto)
                        <img src="{{ public_path('storage/' . str_replace('public/', '', $mhs->foto)) }}" width="60" height="60" alt="Foto">
                    @else
                        Tidak ada foto
                    @endif
                </td>
                <td>{{ $mhs->jenis_kelamin }}</td>
                <td>{{ $mhs->tempat_lahir }}</td>
                <td>{{ $mhs->tanggal_lahir }}</td>
                <td>{{ $mhs->fakultas->fakultas ?? 'N/A' }}</td>
                <td>{{ $mhs->fakultas->prodi ?? 'N/A' }}</td>
                <td>{{ $mhs->fakultas->kaprodi ?? 'N/A' }}</td>
                <td>
                    @if($mhs->fakultas && $mhs->fakultas->foto)
                        <img src="{{ public_path('storage/' . str_replace('public/', '', $mhs->fakultas->foto)) }}" width="60" height="60" alt="Foto Kaprodi">
                    @else
                        Foto tidak tersedia
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
