@extends('layouts.main')

@section('title', 'Daftar Siswa')

@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
  <i class="fa fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<!-- OVERVIEW -->
<div class="panel panel-headline">
  <div class="panel-heading">
    <div class="row">
      <div class="left">
        <h2>Daftar Siswa</h2>
      </div>
      <div class="right">
        <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#siswaModal">
          Tambah Siswa
        </a>
      </div>
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md">
        <table class="table table-bordered table-hover table-striped">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">NAMA</th>
              <th class="text-center">JENIS KELAMIN</th>
              <th class="text-center">AGAMA</th>
              <th class="text-center">ALAMAT</th>
              <th class="text-center">RATA NILAI</th>
              <th class="text-center">AKSI</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data_siswa as $siswa)
            <tr>
              <td class="text-center">{{$loop->iteration}}</td>
              <td><a href="/siswa/{{$siswa->id}}/profile">{{$siswa->nama_lengkap()}}</a></td>
              <td class="text-center">{{$siswa->jenis_kelamin}}</td>
              <td>{{$siswa->agama}}</td>
              <td>{{$siswa->alamat}}</td>
              <td class="text-center">{{$siswa->rataNilai()}}</td>
              <td class="text-center">
                <a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning btn-xs">Edit</a>
                <a href="/siswa/{{$siswa->user_id}}/delete" onclick="return confirm('Yakin?')"
                  class="btn btn-danger btn-xs">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- END OVERVIEW -->

<!-- Modal -->
<div class="modal fade" id="siswaModal" tabindex="-1" role="dialog" aria-labelledby="siswaModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="siswaModalLabel">Form Tambah Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- Form Tambah Siswa --}}
        <form action="/siswa/create" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
            <label for="nama_depan">Nama Depan</label>
            <input type="text" name="nama_depan" class="form-control" id="nama_depan" placeholder="Nama Depan"
              value="{{old('nama_depan')}}">
            @if ($errors->has('nama_depan'))
            <span class="help-block">{{$errors->first('nama_depan')}}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="nama_belakang">Nama Belakang</label>
            <input type="text" name="nama_belakang" class="form-control" id="nama_belakang" placeholder="Nama Belakang"
              value="{{old('nama_belakang')}}">
          </div>
          <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Email"
              value="{{old('email')}}">
            @if ($errors->has('email'))
            <span class="help-block">{{$errors->first('email')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('jenis_kelamin') ? 'has-error' : ''}}">
            <label for="jenis_kelamin">Pilih Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
              <option value="L" {{old('jenis_kelamin') == 'L' ? 'selected' : ''}}>Laki-laki</option>
              <option value="P" {{old('jenis_kelamin') == 'P' ? 'selected' : ''}}>Perempuan</option>
            </select>
            @if ($errors->has('jenis_kelamin'))
            <span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('agama') ? 'has-error' : ''}}">
            <label for="agama">Agama</label>
            <input type="text" name="agama" class="form-control" id="agama" placeholder="Agama"
              value="{{old('agama')}}">
            @if ($errors->has('agama'))
            <span class="help-block">{{$errors->first('agama')}}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" class="form-control">{{old('alamat')}}</textarea>
          </div>
          <div class="form-group {{$errors->has('avatar') ? 'has-error' : ''}}">
            <label for="avatar">Avatar</label>
            <input type="file" name="avatar" class="form-control" id="avatar">
            @if ($errors->has('avatar'))
            <span class="help-block">{{$errors->first('avatar')}}</span>
            @endif
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
  @if (count($errors) > 0)
  $('#siswaModal').modal('show');
  @endif
</script>
@endsection