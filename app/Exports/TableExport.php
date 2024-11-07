<?php

namespace App\Exports;

use App\Models\YourModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TableExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas = DB::table('mahasiswa')
        ->leftJoin('fakultas', 'mahasiswa.fakultas_id', '=', 'fakultas.id')
        ->select(
            'mahasiswa.id',
            'mahasiswa.nim',
            'mahasiswa.nama',
            'mahasiswa.jenis_kelamin',
            'mahasiswa.tempat_lahir',
            'mahasiswa.tanggal_lahir',
            'fakultas.fakultas',
            'fakultas.prodi',
            'fakultas.kaprodi'
        )
        ->get();
        return $datas;
    }

    public function headings(): array
    {
        return [
            'No',
            'NIM',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Fakultas',
            'Prodi',
            'Kaprodi',
        ];
    }
}
