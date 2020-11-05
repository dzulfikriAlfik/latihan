@extends('layouts.main')

@section('title', 'Profile Siswa')

@section('header')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
  rel="stylesheet" />
<style>
  .profile {
    width: 100px;
    height: 100px
  }

  .tinggi {
    height: 450px
  }
</style>
@endsection

@section('content')

<div class="panel panel-profile tinggi">
  <div class="clearfix">
    <!-- LEFT COLUMN -->
    <div class="profile-left">
      <!-- PROFILE HEADER -->
      <div class="profile-header">
        <div class="overlay"></div>
        <div class="profile-main">
          <img src="{{asset('images/no-images.png')}}" class="img-circle profile" alt="Avatar">
          <h3 class="name">{{$guru->nama}}</h3>
        </div>
        <div class="profile-stat">
          <div class="row">
            <div class="col-md-4 stat-item">
              {{$guru->mapel->count()}} <span>Pelajaran</span>
            </div>
            <div class="col-md-4 stat-item">
              15 <span>Awards</span>
            </div>
            <div class="col-md-4 stat-item">
              2174 <span>Points</span>
            </div>
          </div>
        </div>
      </div>
      <!-- END PROFILE HEADER -->
      <!-- PROFILE DETAIL -->
      <div class="profile-detail">
        <div class="profile-info">
          <h4 class="heading">Profile Singkat</h4>
          <ul class="list-unstyled list-justify">
            <li>Nama Lengkap <span>{{$guru->nama}}</span></li>
            <li>Telpon <span>{{$guru->telpon}}</span></li>
            <li>Alamat <span>{{$guru->alamat}}</span></li>
          </ul>
        </div>
      </div>
      <!-- END PROFILE DETAIL -->
    </div>
    <!-- END LEFT COLUMN -->
    <!-- RIGHT COLUMN -->
    <div class="profile-right">
      <h4 class="heading">Daftar Mata Pelajaran yang diajar {{$guru->nama}}</h4>

      @if (session('success'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span></button>
        <i class="fa fa-check-circle"></i> {{ session('success') }}
      </div>
      @endif

      @if (session('error'))
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span></button>
        <i class="fa fa-close"></i> {{ session('error') }}
      </div>
      @endif

      <!-- TABBED CONTENT -->
      <div class="tab-content">
        <div class="panel">
          <div class="panel-heading">
            <a href="{{url()->previous()}}" class="btn btn-warning btn-xs">Back</a>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>KODE</th>
                  <th>MATA PELAJARAN</th>
                  <th>SEMESTER</th>
                </tr>
              </thead>
              <tbody>
                @if ($guru->mapel->count() > 0)
                @foreach ($guru->mapel as $mapel)
                <tr>
                  <td>{{$mapel->kode}}</td>
                  <td>{{$mapel->nama}}</td>
                  <td>{{$mapel->semester}}</td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="5" class="text-center">~ Tidak ada data ~</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- END TABBED CONTENT -->
    </div>
    <!-- END RIGHT COLUMN -->
  </div>
</div>
@endsection