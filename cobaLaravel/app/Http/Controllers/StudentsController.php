<?php

namespace App\Http\Controllers;

use App\Models\Student;
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
        /*Cara Pertama
        -----------------------------------------
        $student          = new Student;
        $student->nama    = $request->nama;
        $student->nrp     = $request->nrp;
        $student->email   = $request->email;
        $student->jurusan = $request->jurusan;
        $student->save();
        -----------------------------------------
        */

        /* Cara Kedua
        -----------------------------------------
        Student::create([
            'nama'    => $request->nama,
            'nrp'     => $request->nrp,
            'email'   => $request->email,
            'jurusan' => $request->jurusan
        ]);
        ------------------------------------------
        */

        // Cara ketiga optional setelah menambahkan protected fillable di models
        $request->validate([
            'nama'    => 'required',
            'nrp'     => 'required|size:9',
            'email'   => 'required|email:rfc,dns',
            'jurusan' => 'required',
        ]);

        Student::create($request->all());

        return redirect('/students')->with('status', 'Data Mahasiswa Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('students.detail', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        Student::destroy($student->id);

        return redirect('/students')->with('status', 'Data Mahasiswa Berhasil dihapus');
    }
}
