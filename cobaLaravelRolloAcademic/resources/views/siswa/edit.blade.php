@extends('layout.main')

@section('title', 'Edit Data Siswa')

@section('content')
<div class="row">
  <div class="col">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Edit Data Siswa</h3>
        <div class="right">
          <a href="/siswa" class="btn btn-warning">
            Kembali
          </a>
        </div>
      </div>
      <div class="panel-body">
        <form method="POST" action="/siswa/{{$siswa->id}}/update" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <label for="nama_depan">Nama Depan</label>
            <input type="text" name="nama_depan" class="form-control" id="nama_depan" placeholder="Nama Depan"
              value="{{$siswa->nama_depan}}">
          </div>
          <div class="form-group">
            <label for="nama_belakang">Nama Belakang</label>
            <input type="text" name="nama_belakang" class="form-control" id="nama_belakang" placeholder="Nama Belakang"
              value="{{$siswa->nama_belakang}}">
          </div>
          <div class="form-group">
            <label for="jenis_kelamin">Pilih Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
              <option value="Laki-laki" {{ ( $siswa->jenis_kelamin == 'Laki-laki') ? 'selected' : '' }}>
                Laki-laki</option>
              <option value="Perempuan" {{ ( $siswa->jenis_kelamin == 'Perempuan') ? 'selected' : '' }}>
                Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="agama">Agama</label>
            <input type="text" name="agama" class="form-control" id="agama" placeholder="Agama"
              value="{{$siswa->agama}}">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" class="form-control">{{$siswa->alamat}}</textarea>
          </div>
          <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" name="avatar" id="avatar" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary">Update Data</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('content1')
<div class="container mb-5">
  <div class="row">
    <div class="col">
      <h1 class="my-4">Form Edit Data Siswa</h1>
      <form method="POST" action="/siswa/{{$siswa->id}}/update">
        {{csrf_field()}}
        <div class="form-group">
          <label for="nama_depan">Nama Depan</label>
          <input type="text" name="nama_depan" class="form-control" id="nama_depan" placeholder="Nama Depan"
            value="{{$siswa->nama_depan}}">
        </div>
        <div class="form-group">
          <label for="nama_belakang">Nama Belakang</label>
          <input type="text" name="nama_belakang" class="form-control" id="nama_belakang" placeholder="Nama Belakang"
            value="{{$siswa->nama_belakang}}">
        </div>
        <div class="form-group">
          <label for="jenis_kelamin">Pilih Jenis Kelamin</label>
          <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
            <option value="Laki-laki" {{ ( $siswa->jenis_kelamin == 'Laki-laki') ? 'selected' : '' }}>
              Laki-laki</option>
            <option value="Perempuan" {{ ( $siswa->jenis_kelamin == 'Perempuan') ? 'selected' : '' }}>
              Perempuan</option>
          </select>
        </div>
        <div class="form-group">
          <label for="agama">Agama</label>
          <input type="text" name="agama" class="form-control" id="agama" placeholder="Agama" value="{{$siswa->agama}}">
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea name="alamat" id="alamat" rows="3" class="form-control">{{$siswa->alamat}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
        <a href="/siswa" class="btn btn-warning">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection