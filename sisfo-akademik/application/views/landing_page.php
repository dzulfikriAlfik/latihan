<nav class="navbar navbar-dark bg-primary text-white">
   <div class="container-fluid">
      <a class="navbar-brand"><strong><?= $identitas->judul_website; ?></strong></a>
      <span class="small"><?= $identitas->alamat . ' - ' . $identitas->email . ' - ' . $identitas->telp; ?></span>
      <form class="form-inline">
         <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
         <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
         <button class="btn btn-primary my-2 my-sm-0 ml-2" type="submit">Login</button>
      </form>
   </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
   <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
               <a class="nav-link" href="#">Beranda <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link ml-3" href="#">Tentang Kampus</a>
            </li>
            <li class="nav-item">
               <a class="nav-link ml-3" href="#">Informasi</a>
            </li>
            <li class="nav-item">
               <a class="nav-link ml-3" href="#">Fasilitas</a>
            </li>
            <li class="nav-item">
               <a class="nav-link ml-3" href="#">Gallery</a>
            </li>
            <li class="nav-item">
               <a class="nav-link ml-3" href="#">Kontak</a>
            </li>
         </ul>
      </div>
   </div>
</nav>

<!-- CAROUSEL -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
   <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
   </ol>
   <div class="carousel-inner">
      <div class="carousel-item active">
         <img src="<?= base_url('assets/img/slider1.jpg'); ?>" class="d-block w-100">
      </div>
      <div class="carousel-item">
         <img src="<?= base_url('assets/img/slider2.jpg'); ?>" class="d-block w-100">
      </div>
      <div class="carousel-item">
         <img src="<?= base_url('assets/img/slider3.jpg'); ?>" class="d-block w-100">
      </div>
   </div>
   <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
   </a>
   <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
   </a>
</div>
<!-- END CAROUSEL -->