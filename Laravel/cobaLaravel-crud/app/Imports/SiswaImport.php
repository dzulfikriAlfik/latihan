<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Siswa;

class SiswaImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 2) {
                Siswa::create([
                    'user_id'       => 100,
                    'nama_depan'    => $row[0],
                    'nama_belakang' => $row[1],
                    'jenis_kelamin' => $row[2],
                    'agama'         => $row[3],
                    'alamat'        => $row[4],
                    'rataNilai'     => $row[5],
                ]);
            }
        }
        return redirect('/siswa')->with('success', 'Data Berhasil Diimport');
    }
}
