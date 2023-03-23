<nav class="navbar navbar-default navbar-fixed-top">
  <div class="brand">
    <a href="index.html"><img src="{{asset('admin/assets')}}/img/logo-dark.png" alt="Klorofil Logo"
        class="img-responsive logo"></a>
  </div>
  <div class="container-fluid">
    <div class="navbar-btn">
      <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
    </div>
    <form class="navbar-form navbar-left">
      <div class="input-group">
        <input type="text" value="" class="form-control" placeholder="Search dashboard...">
        <span class="input-group-btn"><button type="submit" class="btn btn-primary">Go</button></span>
      </div>
    </form>
    <div id="navbar-menu">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="
            @if (auth()->user()->role == 'siswa')
            {{ auth()->user()->siswa->getAvatar() }}
            @else
            /images/no-images.png
            @endif
            " class="img-circle" alt="Avatar">
            <span>{{auth()->user()->name}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i>
          </a>
          <ul class="dropdown-menu">
            @if (auth()->user()->role == 'siswa')
            <li><a href="/" target="_blank"><i class="lnr lnr-exit"></i> <span>Home Page</span></a></li>
            <li><a href="/profilsaya"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
            <li><a href="/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
            @else
            <li><a href="/" target="_blank"><i class="lnr lnr-exit"></i> <span>Home Page</span></a></li>
            <li><a href="/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
            @endif
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>