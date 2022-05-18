<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //* . ------------------------- cara pertama ------------------------- */
        // $student          = new Student;
        // $student->nama    = $request->nama;
        // $student->nrp     = $request->nrp;
        // $student->email   = $request->email;
        // $student->jurusan = $request->jurusan;

        // $student->save();
        // return redirect('/students');

        /* . ------------------------- cara kedua ------------------------- */
        // Student::create([
        //     'nama'    => $request->nama,
        //     'nrp'     => $request->nrp,
        //     'email'   => $request->email,
        //     'jurusan' => $request->jurusan,
        // ]);
        // return redirect('/students');

        /* . ------------------------- cara ketiga ------------------------- */

        $request->validate([
            'nama'    => 'required',
            'nrp'     => 'required|unique:students|max:9',
            'email'   => 'required|unique:students',
            'jurusan' => 'required',
        ]);

        Student::create($request->all());
        return redirect('/students')->with('status', 'Data Mahasiswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        // validation rules
        $request->validate([
            'nama'    => 'required',
            'nrp'     => 'required',
            'email'   => 'required',
            'jurusan' => 'required',
        ]);

        // save update proccess
        Student::where('id', $student->id)
            ->update([
                'nama'    => $request->nama,
                'nrp'     => $request->nrp,
                'email'   => $request->email,
                'jurusan' => $request->jurusan
            ]);
        return redirect('/students')->with('status', 'Data Mahasiswa Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        Student::destroy($student->id);
        return redirect('/students')->with('status', 'Data Mahasiswa Berhasil Dihapus!');
    }
}
