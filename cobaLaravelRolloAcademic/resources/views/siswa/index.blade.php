@extends('layout.main')

@section('title', 'Daftar Siswa')

@section('content')
{{-- Alert --}}
@if (session('status'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
  <i class="fa fa-check-circle"></i> {{ session('status') }}
</div>
@endif
{{-- EndAlert --}}
<div class="row">
  <div class="col-md-12">
    <!-- BASIC TABLE -->
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Daftar Siswa</h3>
        <div class="right">
          <a class="btn btn-primary page-title" type="button" data-toggle="modal" data-target="#dataSiswa">
            Tambah Data
          </a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Agama</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data_siswa as $siswa)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $siswa->nama_depan. ' ' . $siswa->nama_belakang }}</td>
              <td>{{ $siswa->jenis_kelamin }}</td>
              <td>{{ $siswa->agama }}</td>
              <td>{{ $siswa->alamat }}</td>
              <td class="text-center">
                <a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning btn-sm">edit</a>
                <a href="/siswa/{{$siswa->id}}/delete" onclick="return confirm('Yakin?')"
                  class="btn btn-danger btn-sm">delete</a>
              </td>
            </tr>
            @endforeach
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- Modal Tambah Data Siswa --}}
<div class="modal fade float-right" id="dataSiswa" tabindex="-1" role="dialog" aria-labelledby="dataSiswaLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dataSiswaLabel">Form Tambah Data Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/siswa/create">
          {{csrf_field()}}
          <div class="form-group">
            <label for="nama_depan">Nama Depan</label>
            <input type="text" name="nama_depan" class="form-control" id="nama_depan" placeholder="Nama Depan">
          </div>
          <div class="form-group">
            <label for="nama_belakang">Nama Belakang</label>
            <input type="text" name="nama_belakang" class="form-control" id="nama_belakang" placeholder="Nama Belakang">
          </div>
          <div class="form-group">
            <label for="jenis_kelamin">Pilih Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="agama">Agama</label>
            <input type="text" name="agama" class="form-control" id="agama" placeholder="Agama">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection