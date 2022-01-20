<?php

namespace App\Exports;

use App\Mapel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MapelExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Mapel::all();
    }

    public function map($mapel): array
    {
        return [
            $mapel->kode,
            $mapel->nama,
            $mapel->semester,
            $mapel->guru->nama,
        ];
    }

    public function headings(): array
    {
        return [
            'KODE MATA PELAJARAN',
            'NAMA MATA PELAJARAN',
            'SEMESTER',
            'GURU PENGAJAR',
        ];
    }
}
