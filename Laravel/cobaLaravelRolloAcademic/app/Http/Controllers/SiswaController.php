<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\User;
use App\Mapel;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class SiswaController extends Controller
{
    //* . ------------------------- Index ------------------------- */
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data_siswa = Siswa::where('nama_depan', 'LIKE', '%' . $request->cari . '%')->get();
        } else {
            $data_siswa = Siswa::all();
        }
        return view('siswa.index', compact('data_siswa'));
    }
    /* . ------------------------- End Index ------------------------- */

    /* . ------------------------- create ------------------------- */
    public function create(Request $request)
    {
        // validasi
        $this->validate($request, [
            'nama_depan'    => 'required|min:5',
            'email'         => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'avatar'        => 'mimes:jpg,png'
        ]);

        // Tambah ke table User dahulu sebelum menambahkan siswa
        $user                 = new User;
        $user->role           = 'siswa';
        $user->name           = $request->nama_depan . ' ' . $request->nama_belakang;
        $user->email          = $request->email;
        $user->password       = bcrypt('rahasia');
        $user->remember_token = str_random(60);
        $user->save();

        // Tambah ke table Siswa
        $request->request->add(['user_id' => $user->id]);
        $siswa = Siswa::create($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('status', 'Data siswa berhasil ditambahkan');
    }
    /* . ------------------------- End create ------------------------- */

    /* . ------------------------- Edit ------------------------- */
    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }
    /* . ------------------------- End Edit ------------------------- */

    /* . ------------------------- update ------------------------- */
    public function update(Request $request, Siswa $siswa)
    {
        $siswa->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('status', 'Data siswa berhasil diupdate');
    }
    /* . ------------------------- End update ------------------------- */

    /* . ------------------------- delete ------------------------- */
    public function delete(Siswa $siswa)
    {
        $siswa->delete($siswa);
        return redirect('/siswa')->with('status', 'Data siswa berhasil dihapus!');
    }
    /* . ------------------------- End delete ------------------------- */

    /* . ------------------------- profile ------------------------- */
    public function profile(Siswa $siswa)
    {
        $matapel    = Mapel::all();
        // Data Chart
        $categories = [];
        $data       = [];
        foreach ($matapel as $mp) {
            if ($siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()) {
                $categories[] = $mp->nama_mapel;
                $data[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
            }
        }

        return view('siswa.profile', compact(['siswa', 'matapel', 'categories', 'data']));
    }
    /* . ------------------------- End profile ------------------------- */

    /* . ------------------------- addnilai ------------------------- */
    public function addnilai(Request $request, Siswa $siswa)
    {
        // validasi
        $this->validate($request, [
            'nilai'    => 'required|numeric',
        ]);

        if ($siswa->mapel()->where('mapel_id', $request->mapel)->exists()) {
            return redirect('/siswa/' . $siswa->id . '/profile')->with('error', 'Data Mata pelajaran sudah ada!');
        }
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);

        return redirect('/siswa/' . $siswa->id . '/profile')->with('status', 'Data Nilai berhasil di input!');
    }
    /* . ------------------------- End addnilai ------------------------- */

    /* . ------------------------- deletenilai ------------------------- */
    public function deletenilai(Siswa $siswa, Mapel $mapel)
    {
        $siswa->mapel()->detach($mapel);

        return redirect()->back()->with('status', 'Data Nilai berhasil diupdate!');
    }
    /* . ------------------------- End deletenilai ------------------------- */

    /* . ------------------------- exportExcel ------------------------- */
    public function exportExcel()
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }
    /* . ------------------------- End exportExcel ------------------------- */

    /* . ------------------------- exportPDF ------------------------- */
    public function exportPdf()
    {
        $siswa = Siswa::all();
        $pdf = PDF::loadView('export.siswapdf', compact('siswa'));
        return $pdf->download('Siswa.pdf');
    }
    /* . ------------------------- End exportPDF ------------------------- */
}
