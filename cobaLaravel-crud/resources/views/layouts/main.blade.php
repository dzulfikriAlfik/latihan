<!doctype html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- VENDOR CSS -->
  <link rel="stylesheet" href="{{asset('admin/assets')}}/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('admin/assets')}}/vendor/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('admin/assets')}}/vendor/linearicons/style.css">
  <link rel="stylesheet" href="{{asset('admin/assets')}}/vendor/chartist/css/chartist-custom.css">
  <!-- MAIN CSS -->
  <link rel="stylesheet" href="{{asset('admin/assets')}}/css/main.css">
  <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
  <link rel="stylesheet" href="{{asset('admin/assets')}}/css/demo.css">
  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
  {{-- DataTables --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <!-- ICONS -->
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin/assets')}}/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin/assets')}}/img/favicon.png">
  @yield('header')
</head>

<body>
  <!-- WRAPPER -->
  <div id="wrapper">
    <!-- NAVBAR -->
    @include('layouts.include._navbar')
    <!-- END NAVBAR -->
    <!-- LEFT SIDEBAR -->
    @include('layouts.include._sidebar')
    <!-- END LEFT SIDEBAR -->

    <!-- MAIN -->
    <div class="main">
      <!-- MAIN CONTENT -->
      <div class="main-content">
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
    </div>
    <!-- END MAIN -->

    <div class="clearfix"></div>
    <footer>
      <div class="container-fluid">
        <p class="copyright">Aplikasi Pengelolaan Data Siswa <i class="fa fa-love"></i><a href="#">By : Dzulfikri</a>
        </p>
      </div>
    </footer>
  </div>
  <!-- END WRAPPER -->
  <!-- Javascript -->
  <script src="{{asset('admin/assets')}}/vendor/jquery/jquery.min.js"></script>
  <script src="{{asset('admin/assets')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{asset('admin/assets')}}/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="{{asset('admin/assets')}}/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
  <script src="{{asset('admin/assets')}}/vendor/chartist/js/chartist.min.js"></script>
  <script src="{{asset('admin/assets')}}/scripts/klorofil-common.js"></script>
  {{-- Sweet Alert --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  {{-- DataTables --}}
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js">
  </script>
  <script src="{{ asset('frontend/ckeditor/ckeditor.js') }}"></script>
  @yield('footer')
  <script>
    @if(Session::has('success'))
        swal({
          title  : "{{Session::get('success')}}",
          text   : "Aplikasi Pengelolaan Data Siswa",
          buttons: false,
          icon   : "success",
          timer  : 2000
        });
		@endif
		@if(Session::has('error'))
        swal({
          title  : "Error",
          text   : "{{Session::get('error')}}",
          buttons: false,
          icon   : "error",
          timer  : 2000
        });
		@endif
  </script>
</body>

</html>