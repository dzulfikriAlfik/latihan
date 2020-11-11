<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Siswa;
use App\User;
use App\Mapel;
use Yajra\DataTables\Contracts\DataTable;
use DataTables;

class SiswaController extends Controller
{
    public function index()
    {
        $data_siswa = Siswa::all();
        return view('siswa.index', compact('data_siswa'));
    }

    public function create(Request $request)
    {
        // validasi
        $this->validate($request, [
            'nama_depan'    => 'required',
            'email'         => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'avatar'        => 'mimes:jpeg,jpg,png,gif'
        ]);
        // Insert ke Table User
        $user                 = new User;
        $user->role           = 'siswa';
        $user->name           = $request->nama_depan . ' ' . $request->nama_belakang;
        $user->email          = $request->email;
        $user->password       = bcrypt('rahasia');
        $user->remember_token = str_random(60);
        $user->save();
        // Insert ke Table Siswa
        $request->request->add(['user_id' => $user->id]);
        $siswa = Siswa::create($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('success', 'Berhasil Tambah Data Siswa');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $siswa->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('success', 'Berhasil Update Data Siswa');
    }

    public function delete($id)
    {
        // $siswa = Siswa::find($id);
        // $siswa->delete();
        DB::table('siswa')->where('user_id', $id)->delete();
        DB::table('users')->where('id', $id)->delete();
        return redirect('/siswa')->with('success', 'Berhasil Delete Data Siswa');
    }

    public function profile(Siswa $siswa)
    {
        $mpel  = Mapel::all();

        // Menyiapkan Chart Nilai
        $categories = [];
        $data       = [];
        foreach ($mpel as $mp) {
            if ($siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()) {
                $categories[] = $mp->nama;
                $data[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
            }
        }

        return view('siswa.profile', compact(['siswa', 'mpel', 'categories', 'data']));
    }

    public function addnilai(Request $request, Siswa $siswa)
    {
        // validasi
        $this->validate($request, [
            'nilai'    => 'required|numeric',
        ]);

        if ($siswa->mapel()->where('mapel_id', $request->mapel)->exists()) {
            return redirect('/siswa/' . $siswa->id . '/profile')->with('error', 'Data Mata Pelajaran Sudah ada');
        }

        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);
        return redirect('/siswa/' . $siswa->id . '/profile')->with('success', 'Berhasil Tambah Nilai');
    }

    public function deletenilai(Siswa $siswa, $idmapel)
    {
        $siswa->mapel()->detach($idmapel);
        return redirect()->back()->with('success', 'Berhasil Delete Data Nilai');
    }

    public function exportExcel()
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }

    public function exportPdf()
    {
        $siswa = Siswa::all();
        $pdf   = PDF::loadView('siswa.exportPdf', compact('siswa'));
        return $pdf->download('Siswa.pdf');
    }

    public function getdatasiswa()
    {
        $siswa = Siswa::select('siswa.*');
        return DataTables::eloquent($siswa)
            // $siswa merepresentasikan semua data siswa, sedangkan $s merepresentasikan satu data siswa
            ->addColumn('nama_lengkap', function ($s) {
                return '<a href="/siswa/' . $s->id . '/profile">' . $s->nama_lengkap() . '</a>';
            })
            ->addColumn('jenis_kelamin', function ($s) {
                return $s->getJenisKelamin();
            })
            ->addColumn('rataNilai', function ($s) {
                return $s->rataNilai();
            })
            ->addColumn('aksi', function ($s) {
                return '<a href="/siswa/' . $s->id . '/edit" class="btn btn-warning btn-xs">Edit</a>&nbsp;<a href="/siswa/' . $s->id . '/delete" class="btn btn-danger btn-xs tombolDelete">Delete</a>';
            })
            ->rawColumns(['nama_lengkap', 'jenis_kelamin', 'rataNilai', 'aksi'])
            ->toJson();
    }

    public function profilsaya()
    {
        $siswa = auth()->user()->siswa;
        return view('siswa.profilsaya', compact('siswa'));
    }
}
