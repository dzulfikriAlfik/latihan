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
              {{$siswa->mapel->count()}} <span>Pelajaran</span>
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
      <h4 class="heading">Daftar Mata Pelajaran</h4>
      <!-- TABBED CONTENT -->
      <div class="tab-content">
        <div class="panel">
          <div class="panel-heading">
            <a href="#" class="btn btn-primary btn-xs">Tambah Pelajaran</a>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>KODE</th>
                  <th>MATA PELAJARAN</th>
                  <th>SEMESTER</th>
                  <th>NILAI</th>
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
                @if ($siswa->mapel->count() > 0)
                @foreach ($siswa->mapel as $mapel)
                <tr>
                  <td>{{$mapel->kode}}</td>
                  <td>{{$mapel->nama}}</td>
                  <td>{{$mapel->semester}}</td>
                  <td>
                    <a href="#" class="nilai" data-type="text" data-pk="{{$mapel->id}}"
                      data-url="/api/siswa/{{$siswa->id}}/editnilai" data-title="Masukan Nilai">{{$mapel->pivot->nilai}}
                    </a>
                  </td>
                  <td>
                    <a href="/siswa/{{$siswa->id}}/{{$mapel->id}}/deletenilai" onclick="return confirm('Yakin?')"
                      class="btn btn-danger btn-xs">delete</a>
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="4" class="text-center">~ Tidak ada data ~</td>
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