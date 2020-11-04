@extends('layouts.main')

@section('title', 'Form Edit Siswa')

@section('content')
<!-- OVERVIEW -->
<div class="panel panel-headline">
  <div class="panel-heading">
    <div class="row">
      <h2 class="text-center">Edit Siswa {{$siswa->nama_depan . ' ' . $siswa->nama_belakang}}</h2>
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <form action="/siswa/{{$siswa->id}}/update" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <label for="nama_depan">Nama Depan</label>
            <input type="text" name="nama_depan" class="form-control" id="nama_depan" placeholder="Masukan Nama Depan"
              value="{{$siswa->nama_depan}}">
          </div>
          <div class="form-group">
            <label for="nama_belakang">Nama Belakang</label>
            <input type="text" name="nama_belakang" class="form-control" id="nama_belakang"
              placeholder="Masukan Nama Belakang" value="{{$siswa->nama_belakang}}">
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
            <input type="text" name="agama" class="form-control" id="agama" placeholder="Agama"
              value="{{$siswa->agama}}">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="aalamat" rows="3" class="form-control">{{$siswa->alamat}}</textarea>
          </div>
          <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" name="avatar" id="avatar" class="form-control">
          </div>
          <a href="{{url()->previous()}}" class="btn btn-warning">Back</a>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END OVERVIEW -->
@endsection