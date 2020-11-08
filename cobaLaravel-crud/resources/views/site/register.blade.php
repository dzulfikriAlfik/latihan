@extends('layouts.frontend')

@section('title', 'Register Page')

@section('content')
<section class="banner-area relative about-banner" id="home">
  <div class="overlay overlay-bg"></div>
  <div class="container">
    <div class="row d-flex align-items-center justify-content-center">
      <div class="about-content col-lg-12">
        <h1 class="text-white">
          Pendaftaran
        </h1>
        <p class="text-white link-nav"><a href="/">Home </a> <span class="lnr lnr-arrow-right"></span> <a
            href="/register"> Pendaftaran</a></p>
      </div>
    </div>
  </div>
</section>

<section class="search-course-area relative" style="background: unset">
  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-5 col-md-5 search-course-left">
        <h1 class="">
          Pendaftaran Online <br>
          Bergabung Bersama Kami!
        </h1>
        <p>
          Lulusan Kami adalah yang Terbaik, dengan dibekali akhlak yang luhur serta ilmu dan wawasan yang luas. In Syaa
          Allah siswa akan kami didik sehingga menjadi pribadi yang berbudi pekerti tinggi dan berjiwa besar
        </p>
      </div>
      <div class="col-lg-7 col-md-7 search-course-right section-gap">
        {!! Form::open(['url' => '/postregister', 'class' => 'form-wrap']) !!}
        <h4 class="pb-20 text-center mb-30">Formulir Pendaftaran</h4>

        {!! Form::text('nama_depan', '', ['class' => 'form-control', 'placeholder' => 'Masukan Nama Depan']) !!}
        {!! Form::text('nama_belakang', '', ['class' => 'form-control', 'placeholder' => 'Masukan Nama Belakang']) !!}
        {!! Form::text('agama', '', ['class' => 'form-control', 'placeholder' => 'Masukan Agama']) !!}
        {!! Form::textarea('alamat', '', ['class' => 'form-control', 'placeholder' => 'Masukan Alamat', 'rows' => '3'])
        !!}
        <div class="form-select" id="service-select">
          {!! Form::select('jenis_kelamin', ['' => 'Pilih Jenis Kelamin', 'L' => 'Laki-laki', 'P' => 'Perempuan'], 'L')
          !!}
        </div>
        {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Masukan Email']) !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Masukan Password']) !!}

        <input class="primary-btn text-uppercase" type="submit" value="kirim" style="text-align: center">
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
@endsection