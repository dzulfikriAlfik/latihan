@extends('layout.main')

@section('title', 'Form Ubah Data Mahasiswa')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1 class="mt-3">Form Ubah Data Mahasiswa</h1>

            <form method="POST" action="/students/{{$student->id}}">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                        placeholder="Masukan Nama" value="{{ $student->nama }}">
                    @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nrp">NRP</label>
                    <input type="text" class="form-control @error('nrp') is-invalid @enderror" name="nrp" id="nrp"
                        placeholder="Masukan NRP" value="{{ $student->nrp }}">
                    @error('nrp')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                        placeholder="Masukan Email" value="{{ $student->email }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control @error('jurusan') is-invalid @enderror" name="jurusan"
                        id="jurusan" placeholder="Masukan Jurusan" value="{{ $student->jurusan }}">
                    @error('jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Button --}}
                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </form>

        </div>
    </div>
</div>
@endsection