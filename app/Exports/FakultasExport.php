<?php

namespace App\Exports;


use App\Models\Mfakultas;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Support\Facades\DB; 

class FakultasExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    private $currentRow = 2; // Baris awal data untuk gambar

    /**
     * Mengambil data fakultas
     */
    public function collection()
    {
        return Mfakultas::select('fakultas', 'prodi', 'kaprodi')->get();
    }

    /**
     * Menambahkan heading di file Excel
     */
    public function headings(): array
    {
        return ['Fakultas', 'Prodi', 'Kaprodi',];
    }

    /**
     * Memetakan data ke setiap baris
     */
    public function map($fakultas): array
    {
        return [
            $fakultas->fakultas,
            $fakultas->prodi,
            $fakultas->kaprodi,
        ];
    }

    /**
     * Menambahkan gambar ke file Excel
     */
    public function drawings()
    {
        $drawings = [];

        foreach ($this->collection() as $index => $fakultas) {
            if ($fakultas->foto && Storage::exists($fakultas->foto)) {
                $drawing = new Drawing();
                $drawing->setName('Foto');
                $drawing->setDescription('Foto Kaprodi');
                $drawing->setPath(Storage::path($fakultas->foto));
                $drawing->setHeight(60);
                $drawing->setCoordinates('D' . $this->currentRow); // Kolom D untuk gambar
                $drawings[] = $drawing;
            }

            $this->currentRow++; // Baris selanjutnya
        }

        return $drawings;
    }
}
