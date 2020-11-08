<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
  <title>Login Aplikasi Pengelolaan Data Siswa</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- VENDOR CSS -->
  <link rel="stylesheet" href="{{asset('admin/assets')}}/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('admin/assets')}}/vendor/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('admin/assets')}}/vendor/linearicons/style.css">
  <!-- MAIN CSS -->
  <link rel="stylesheet" href="{{asset('admin/assets')}}/css/main.css">
  <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
  <link rel="stylesheet" href="{{asset('admin/assets')}}/css/demo.css">
  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
  <!-- ICONS -->
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin/assets')}}/img/apple-icon.png">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin/assets')}}/img/favicon.png">
</head>

<body>
  <!-- WRAPPER -->
  <div id="wrapper">
    <div class="vertical-align-wrap">
      <div class="vertical-align-middle">
        <div class="auth-box">
          <div class="left">
            <div class="content">
              <div class="header">
                <div class="logo text-center"><img src="{{asset('admin/assets')}}/img/logo-dark.png"
                    alt="Klorofil Logo"></div>
                <p class="lead">Login Aplikasi Siswa</p>
              </div>

              <form class="form-auth-small" action="/postlogin" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="email" class="control-label sr-only">Email</label>
                  <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}"
                    placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="password" class="control-label sr-only">Password</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
              </form>
              <br>
              <a href="/" class="btn btn-default btn-lg btn-block">Home Page</a>
            </div>
          </div>
          <div class="right">
            <div class="overlay"></div>
            <div class="content text">
              <h1 class="heading">Aplikasi Pengelolaan Data Siswa</h1>
              <p>by Dzulfikri</p>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- END WRAPPER -->


  <!-- Javascript -->
  <script src="{{asset('admin/assets')}}/vendor/jquery/jquery.min.js"></script>
  <script src="{{asset('admin/assets')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
  {{-- Sweet Alert --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    @if(Session::has('success'))
      swal({
        title: "Sukses",
        text: "{{Session::get('success')}}",
        buttons: false,
        icon: "success",
        timer: 2000
      });
		@endif
		@if(Session::has('error'))
      swal({
        title: "Error",
        text: "{{Session::get('error')}}",
        buttons: false,
        icon: "error",
        timer: 2000
      });
		@endif
  </script>
</body>

</html>