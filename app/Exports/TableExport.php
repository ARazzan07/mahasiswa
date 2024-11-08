<?php

namespace App\Exports;

use App\Models\Mmahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Support\Facades\Storage;

class TableExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    private $rowNumber = 2; // Row to start adding images after header

    public function collection()
    {
        // Get data from mahasiswa table, including foto column
        return Mmahasiswa::leftJoin('fakultas', 'mahasiswa.fakultas_id', '=', 'fakultas.id')
            ->select(
                'mahasiswa.id',
                'mahasiswa.nim',
                'mahasiswa.nama',
                'mahasiswa.foto', // Make sure foto is selected
                'mahasiswa.jenis_kelamin',
                'mahasiswa.tempat_lahir',
                'mahasiswa.tanggal_lahir',
                'fakultas.fakultas',
                'fakultas.prodi',
                'fakultas.kaprodi'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NIM',
            'Nama Lengkap',
            'Foto Mahasiswa',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Fakultas',
            'Prodi',
            'Kaprodi'
        ];
    }

    public function map($mahasiswa): array
    {
        return [
            $mahasiswa->id,
            $mahasiswa->nim,
            $mahasiswa->nama,
            '', // Empty cell for photo (will be populated by WithDrawings)
            $mahasiswa->jenis_kelamin,
            $mahasiswa->tempat_lahir,
            $mahasiswa->tanggal_lahir,
            $mahasiswa->fakultas,
            $mahasiswa->prodi,
            $mahasiswa->kaprodi
        ];
    }

    public function drawings(): array
    {
        $drawings = [];
        foreach ($this->collection() as $index => $mahasiswa) {
            // Check if the mahasiswa has a photo
            if ($mahasiswa->foto && Storage::exists('public/' . $mahasiswa->foto)) {
                $drawing = new Drawing();
                $drawing->setName('Foto Mahasiswa');
                $drawing->setDescription('Foto Mahasiswa');
                $drawing->setPath(public_path('storage/' . $mahasiswa->foto)); // Path to the photo
                $drawing->setHeight(60); // Resize image height
                $drawing->setCoordinates('D' . ($index + $this->rowNumber)); // Set cell for the image
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }
}
