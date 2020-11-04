@extends('layouts.main')

@section('title', 'Form Edit Siswa')

@section('content')
<div class="row">
  <h1>Edit Siswa {{$siswa->nama_depan . ' ' . $siswa->nama_belakang}}</h1>
</div>

<form action="/siswa/{{$siswa->id}}/update" method="POST">
  {{csrf_field()}}
  <div class="form-group">
    <label for="nama_depan">Nama Depan</label>
    <input type="text" name="nama_depan" class="form-control" id="nama_depan" placeholder="Masukan Nama Depan"
      value="{{$siswa->nama_depan}}">
  </div>
  <div class="form-group">
    <label for="nama_belakang">Nama Belakang</label>
    <input type="text" name="nama_belakang" class="form-control" id="nama_belakang" placeholder="Masukan Nama Belakang"
      value="{{$siswa->nama_belakang}}">
  </div>
  <div class="form-group">
    <label for="jenis_kelamin">Jenis Kelamin</label>
    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
      <option value="L" {{$siswa->jenis_kelamin == 'L' ? 'selected' : ''}}>Laki-laki</option>
      <option value="P" {{$siswa->jenis_kelamin == 'P' ? 'selected' : ''}}>Perempuan</option>
    </select>
  </div>
  <div class="form-group">
    <label for="agama">Agama</label>
    <input type="text" name="agama" class="form-control" id="agama" placeholder="Agama" value="{{$siswa->agama}}">
  </div>
  <div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea name="alamat" id="aalamat" rows="3" class="form-control">{{$siswa->alamat}}</textarea>
  </div>
  <a href="{{url()->previous()}}" class="btn btn-warning">Back</a>
  <button type="submit" class="btn btn-primary">Save changes</button>
</form>
@endsection