<?php

namespace App\Exports;
use App\Models\Mfakultas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class FakultasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas = DB::table('fakultas')
        ->select(
            'fakultas.fakultas',
            'fakultas.prodi',
            'fakultas.kaprodi',
        )
        ->get();
        return $datas;
    }

    public function headings(): array
    {
        return [
            'Fakultas',
            'Prodi',
            'Kaprodi',
        ];
    }
}
