@extends('layouts.main')

@section('title', 'Profile Siswa')

@section('header')
<style>
  .profile {
    width: 100px;
    height: 100px
  }
</style>
@endsection

@section('content')

<div class="panel panel-profile" style="height: 600px">
  <div class="clearfix">
    <!-- LEFT COLUMN -->
    <div class="profile-left">
      <!-- PROFILE HEADER -->
      <div class="profile-header">
        <div class="overlay"></div>
        <div class="profile-main">
          <img src="{{$siswa->getAvatar()}}" class="img-circle profile" alt="Avatar">
          <h3 class="name">{{$siswa->nama_depan . ' ' . $siswa->nama_belakang}}</h3>
        </div>
        <div class="profile-stat">
          <div class="row">
            <div class="col-md-4 stat-item">
              45 <span>Projects</span>
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
            <li>Nama Lengkap <span>{{$siswa->nama_depan . ' ' . $siswa->nama_belakang}}</span></li>
            <li>Jenis Kelamin <span>{{$siswa->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki'}}</span></li>
            <li>Agama <span>{{$siswa->agama}}</span></li>
            <li>Alamat <span>{{$siswa->alamat}}</span></li>
          </ul>
        </div>
        <div class="text-center">
          <a href="/siswa/{{$siswa->id}}/edit" class="btn btn-primary">Edit Profile</a>
          <a href="{{url()->previous()}}" class="btn btn-warning">Back</a>
        </div>
      </div>
      <!-- END PROFILE DETAIL -->
    </div>
    <!-- END LEFT COLUMN -->
    <!-- RIGHT COLUMN -->
    <div class="profile-right">
      <h4 class="heading">Samuel's Awards</h4>
      <!-- TABBED CONTENT -->
      <div class="custom-tabs-line tabs-line-bottom left-aligned">
        <ul class="nav" role="tablist">
          <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Recent Activity</a></li>
        </ul>
      </div>
      <div class="tab-content">

      </div>
      <!-- END TABBED CONTENT -->
    </div>
    <!-- END RIGHT COLUMN -->
  </div>
</div>

@endsection