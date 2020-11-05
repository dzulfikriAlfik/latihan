@extends('layouts.main')

@section('title', 'Form Edit Pelajaran')

@section('content')
<!-- OVERVIEW -->
<div class="panel panel-headline">
  <div class="panel-heading">
    <div class="row">
      <h2 class="text-center">Edit Mata Pelajaran {{$mapel->nama}}</h2>
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <form action="/mapel/{{$mapel->id}}/update" method="POST">
          {{csrf_field()}}
          <div class="form-group {{$errors->has('kode') ? 'has-error' : ''}}">
            <label for="kode">Kode Mata Pelajaran</label>
            <input type="text" name="kode" class="form-control" id="kode" placeholder="Masukan Kode Mata Pelajaran"
              value="{{$mapel->kode}}">
            @if ($errors->has('kode'))
            <span class="help-block">{{$errors->first('kode')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
            <label for="nama">Nama Mata Pelajaran</label>
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama Mata Pelajaran"
              value="{{$mapel->nama}}">
            @if ($errors->has('nama'))
            <span class="help-block">{{$errors->first('nama')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('semester') ? 'has-error' : ''}}">
            <label for="semester">Pilih Semester</label>
            <select class="form-control" name="semester" id="semester">
              <option value="Ganjil" {{$mapel->semester == 'Ganjil' ? 'selected' : ''}}>Ganjil</option>
              <option value="Genap" {{$mapel->semester == 'Genap' ? 'selected' : ''}}>Genap</option>
            </select>
            @if ($errors->has('semester'))
            <span class="help-block">{{$errors->first('semester')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('guru_id') ? 'has-error' : ''}}">
            <label for="guru_id">Pilih Guru Pengajar</label>
            <select class="form-control" name="guru_id" id="guru_id">
              <option value="{{$mapel->guru_id}}">{{$mapel->guru->nama}}</option>
              @foreach($data_guru as $guru)
              <option value="{{$guru->id}}">{{$guru->nama}}</option>
              @endforeach
            </select>
            @if ($errors->has('guru_id'))
            <span class="help-block">{{$errors->first('guru_id')}}</span>
            @endif
          </div>
          <a href="/mapel" class="btn btn-warning">Back</a>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END OVERVIEW -->
@endsection