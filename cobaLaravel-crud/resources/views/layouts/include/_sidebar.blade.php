<div id="sidebar-nav" class="sidebar">
  <div class="sidebar-scroll">
    <nav>
      <ul class="nav">
        <li>
          <a href="/dashboard" class="{{ request()->segment(1) == 'dashboard' ? 'active' : '' }}"><i
              class="lnr lnr-home"></i> <span>Dashboard</span>
          </a>
        </li>

        @if(auth()->user()->role == 'superadmin')
        <li>
          <a href="/siswa" class="{{ request()->segment(1) == 'siswa' ? 'active' : '' }}"><i class="lnr lnr-users"></i>
            <span>Siswa</span>
          </a>
          <a href="/guru" class="{{ request()->segment(1) == 'guru' ? 'active' : '' }}"><i class="lnr lnr-user"></i>
            <span>Guru</span>
          </a>
          <a href="/mapel" class="{{ request()->segment(1) == 'mapel' ? 'active' : '' }}"><i class="lnr lnr-book"></i>
            <span>Mata Pelajaran</span>
          </a>
          <a href="/posts" class="{{ request()->segment(1) == 'posts' ? 'active' : '' }}"><i class="lnr lnr-pencil"></i>
            <span>Post</span>
          </a>
        </li>
        @endif
      </ul>
    </nav>
  </div>
</div>