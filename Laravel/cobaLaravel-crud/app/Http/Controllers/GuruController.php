<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;
use App\Exports\GuruExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class GuruController extends Controller
{
    public function index()
    {
        $data_guru = Guru::all();
        return view('guru.index', compact('data_guru'));
    }

    public function create(Request $request)
    {
        // validasi
        $this->validate($request, [
            'nama'   => 'required',
            'telpon' => 'required|numeric',
            'alamat' => 'required',
        ]);
        // Insert ke Table Guru
        Guru::create($request->all());
        return redirect('/guru')->with('success', 'Berhasil Tambah Data Guru');
    }

    public function profile(Guru $guru)
    {
        return view('guru.profile', compact('guru'));
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        // validasi
        $this->validate($request, [
            'nama'   => 'required',
            'telpon' => 'required|numeric',
            'alamat' => 'required',
        ]);
        $guru->update($request->all());
        return redirect('/guru')->with('success', 'Berhasil Update Data Guru');
    }

    public function delete(Guru $guru)
    {
        $guru->delete();
        return redirect('/guru')->with('success', 'Berhasil Delete Data Guru');
    }

    public function exportExcel()
    {
        return Excel::download(new GuruExport, 'Guru.xlsx');
    }

    public function exportPdf()
    {
        $guru = Guru::all();
        $pdf  = PDF::loadView('guru.exportPdf', compact('guru'));
        return $pdf->download('Guru.pdf');
    }
}
