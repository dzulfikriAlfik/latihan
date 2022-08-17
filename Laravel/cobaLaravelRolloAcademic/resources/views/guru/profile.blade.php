@extends('layout.main')

@section('title', 'Profile Siswa')

@section('header')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
  rel="stylesheet" />
@endsection

@section('content')
<div class=" panel panel-profile">
  <div class="clearfix">
    <!-- LEFT COLUMN -->
    <div class="profile-left">
      <!-- PROFILE HEADER -->
      <div class="profile-header">
        <div class="overlay"></div>
        <div class="profile-main">
          <img src="" class="img-circle" alt="Avatar" style="width: 100px">
          <h3 class="name">{{$guru->nama_guru}}</h3>
          <span class="online-status status-available">Available</span>
        </div>
      </div>
      <!-- END PROFILE HEADER -->
    </div>
    <!-- END LEFT COLUMN -->
    <!-- RIGHT COLUMN -->
    <div class="profile-right">
      <a href="{{ url()->previous() }}" class="btn btn-warning">Kembali</a>
      {{-- Alert --}}
      @if (session('status'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span></button>
        <i class="fa fa-check-circle mt-3"></i> {{ session('status') }}
      </div>
      @endif
      {{-- Alert --}}
      @if (session('error'))
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span></button>
        <i class="fa fa-check-circle mt-3"></i> {{ session('error') }}
      </div>
      @endif
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Mata Pelajaran yg diajar {{$guru->nama_guru}}</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Kode</th>
                <th>Mata Pelajaran</th>
                <th>Semseter</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($guru->mapel as $mapel)
              <tr>
                <td>{{$mapel->kode}}</td>
                <td>{{$mapel->nama_mapel}}</td>
                <td>{{$mapel->semester}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- END TABBED CONTENT -->
    </div>
    <!-- END RIGHT COLUMN -->
  </div>
</div>
@stop