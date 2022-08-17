@extends('layouts.main')

@section('title', 'Form Edit Guru')

@section('content')
<!-- OVERVIEW -->
<div class="panel panel-headline">
  <div class="panel-heading">
    <div class="row">
      <h2 class="text-center">Edit Guru {{$guru->nama}}</h2>
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <form action="/guru/{{$guru->id}}/update" method="POST">
          {{csrf_field()}}
          <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
            <label for="nama">Nama Guru</label>
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama Guru"
              value="{{$guru->nama}}">
            @if ($errors->has('nama'))
            <span class="help-block">{{$errors->first('nama')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('telpon') ? 'has-error' : ''}}">
            <label for="telpon">No. Telpon</label>
            <input type="text" name="telpon" class="form-control" id="telpon" placeholder="Masukan No. Telpon"
              value="{{$guru->telpon}}">
            @if ($errors->has('telpon'))
            <span class="help-block">{{$errors->first('telpon')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="aalamat" rows="3" class="form-control">{{$guru->alamat}}</textarea>
            @if ($errors->has('alamat'))
            <span class="help-block">{{$errors->first('alamat')}}</span>
            @endif
          </div>
          <a href="/guru" class="btn btn-warning">Back</a>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END OVERVIEW -->
@endsection