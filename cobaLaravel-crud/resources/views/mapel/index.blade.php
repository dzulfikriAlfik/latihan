@extends('layouts.main')

@section('title', 'Daftar Mata Pelajaran')

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
        <h2>Daftar Mata Pelajaran</h2>
      </div>
      <div class="right">
        <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#mapelModal">
          Tambah Mapel
        </a>
        <a href="/mapel/exportExcel" class="btn btn-success btn-sm float-right">
          Export Excel
        </a>
        <a href="/mapel/exportPdf" target="_blank" class="btn btn-default btn-sm float-right">
          Export PDF
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
              <th class="text-center">KODE</th>
              <th class="text-center">NAMA MATAPELAJARAN</th>
              <th class="text-center">SEMESTER</th>
              <th class="text-center">GURU PENGAJAR</th>
              <th class="text-center">AKSI</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data_mapel as $mapel)
            <tr>
              <td class="text-center">{{$loop->iteration}}</td>
              <td class="text-center">{{$mapel->kode}}</td>
              <td>{{$mapel->nama}}</td>
              <td>{{$mapel->semester}}</td>
              <td>{{$mapel->guru->nama}}</td>
              <td class="text-center">
                <a href="/mapel/{{$mapel->id}}/edit" class="btn btn-warning btn-xs">Edit</a>
                <a href="/mapel/{{$mapel->id}}/delete" onclick="return confirm('Yakin?')"
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
<div class="modal fade" id="mapelModal" tabindex="-1" role="dialog" aria-labelledby="mapelModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mapelModalLabel">Form Tambah Mata Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- Form Tambah Mapel --}}
        <form action="/mapel/create" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group {{$errors->has('kode') ? 'has-error' : ''}}">
            <label for="kode">Kode Mata Pelajaran</label>
            <input type="text" name="kode" class="form-control" id="kode" placeholder="Masukan Kode Mata Pelajaran"
              value="{{old('kode')}}">
            @if ($errors->has('kode'))
            <span class="help-block">{{$errors->first('kode')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
            <label for="nama">Nama Mata Pelajaran</label>
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama Mata Pelajaran"
              value="{{old('nama')}}">
            @if ($errors->has('nama'))
            <span class="help-block">{{$errors->first('nama')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('semester') ? 'has-error' : ''}}">
            <label for="semester">Pilih Semester</label>
            <select class="form-control" name="semester" id="semester">
              <option value="Ganjil" {{old('semester') == 'Ganjil' ? 'selected' : ''}}>Ganjil</option>
              <option value="Genap" {{old('semester') == 'Genap' ? 'selected' : ''}}>Genap</option>
            </select>
            @if ($errors->has('semester'))
            <span class="help-block">{{$errors->first('semester')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('guru_id') ? 'has-error' : ''}}">
            <label for="guru_id">Pilih Guru Pengajar</label>
            <select class="form-control" name="guru_id" id="guru_id">
              <option value="">-- Pilih Guru Pengajar --</option>
              @foreach($data_guru as $guru)
              <option value="{{$guru->id}}">{{$guru->nama}}</option>
              @endforeach
            </select>
            @if ($errors->has('guru_id'))
            <span class="help-block">{{$errors->first('guru_id')}}</span>
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
  $('#mapelModal').modal('show');
  @endif
</script>
@endsection