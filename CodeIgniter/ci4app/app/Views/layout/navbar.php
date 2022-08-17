<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Dzulfikri</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link <?=$title == 'Home' ? 'active' : '';?>" href="/">Home</a>
                <a class="nav-link <?=$title == 'About Me' ? 'active' : '';?>" href="/pages/about">About</a>
                <a class="nav-link <?=$title == 'Contact' ? 'active' : '';?>" href="/pages/contact">Contact</a>
                <a class="nav-link <?=$title == 'Daftar Komik' || $title == 'Detail Komik' || $title == 'Form Tambah Data Komik' || $title == 'Form Ubah Data Komik' ? 'active' : '';?>" href="/komik">Komik</a>
                <a class="nav-link <?=$title == 'Daftar orang' ? 'active' : '';?>" href="/orang">Orang</a>
            </div>
            <?php if (logged_in()): ?>
            <a class="nav-link" href="/logout">Logout</a>
            <?php else: ?>
            <a class="nav-link" href="/login">Login</a>
            <?php endif;?>
        </div>
    </div>
</nav>