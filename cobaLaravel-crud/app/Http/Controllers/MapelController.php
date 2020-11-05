<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Exports\MapelExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Mapel;
use App\Guru;

class MapelController extends Controller
{
    public function index()
    {
        $data_mapel = Mapel::all();
        $data_guru  = Guru::all();
        return view('mapel.index', compact(['data_mapel', 'data_guru']));
    }

    public function create(Request $request)
    {
        // validasi
        $this->validate($request, [
            'kode'    => 'required|unique:mapel',
            'nama'    => 'required|unique:mapel',
            'guru_id' => 'required',
        ]);
        Mapel::create($request->all());
        return redirect('/mapel')->with('success', 'Berhasil Tambah Data Mapel');
    }

    public function edit($id)
    {
        $mapel     = Mapel::find($id);
        $data_guru = Guru::all();
        return view('mapel.edit', compact(['mapel', 'data_guru']));
    }

    public function update(Request $request, $id)
    {
        // validasi
        $this->validate($request, [
            'kode' => [
                'required',
                Rule::unique('mapel')->ignore($id, 'id')
            ],
            'nama' => [
                'required',
                Rule::unique('mapel')->ignore($id, 'id')
            ],
            'guru_id' => 'required',
        ]);

        $mapel = Mapel::find($id);
        $mapel->update($request->all());
        return redirect('/mapel')->with('success', 'Berhasil Update Data Mapel');
    }

    public function delete($id)
    {
        $mapel = Mapel::find($id);
        $mapel->delete();
        return redirect('/mapel')->with('success', 'Berhasil Delete Data Mapel');
    }

    public function exportExcel()
    {
        return Excel::download(new MapelExport, 'Mapel.xlsx');
    }

    public function exportPdf()
    {
        $mapel = Mapel::all();
        $pdf   = PDF::loadView('mapel.exportPdf', compact('mapel'));
        return $pdf->download('Mapel.pdf');
    }
}
