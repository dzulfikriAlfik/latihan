<?php

function get_CURL($url)
{
   $curl = curl_init();
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
   $result = curl_exec($curl);
   curl_close($curl);

   return json_decode($result, true);
}

// $result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCkXmLjEr95LVtGuIm3l2dPg&key=AIzaSyD0NXRnx1_N38QTXY5jlcIXm5ge4TXbOqo');
$result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id=UCkXmLjEr95LVtGuIm3l2dPg&key=AIzaSyD0NXRnx1_N38QTXY5jlcIXm5ge4TXbOqo');

$youtubeProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName = $result['items'][0]['snippet']['title'];
$subscribers = $result['items'][0]['statistics']['subscriberCount'];

// latest video
$urlLatestVideo = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyD0NXRnx1_N38QTXY5jlcIXm5ge4TXbOqo&channelId=UCkXmLjEr95LVtGuIm3l2dPg&maxResults=1&order=date&part=snippet';

$result = get_CURL($urlLatestVideo);
$latestVideoId = $result['items'][0]['id']['videoId'];

?>

<!doctype html>
<html lang="en" id="home">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

   <style>
      section {
         min-height: 450px;
      }

      .ig-thumbnail {
         width: 100px;
         height: 100px;
         float: left;
         overflow: hidden;
      }

      .ig-thumbnail img {
         width: 100px;
      }
   </style>

   <title>Portfolio API</title>
</head>

<body class="mt-5">

   <!-- navbar -->
   <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
      <div class="container">
         <a class="navbar-brand page-scroll" href="#home">Dzulfikri</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
               <li class="nav-item active">
                  <a class="nav-link" href="#home">Home <span class="sr-only page-scroll">(current)</span></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#about" class="page-scroll">About</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#portfolio" class="page-scroll">Portfolio</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#contact" class="page-scroll">Kontak</a>
               </li>
            </ul>
         </div>
      </div>
   </nav>
   <!-- end navbar -->

   <!-- jumbotron -->
   <div class="jumbotron jumbotron-fluid">
      <div class="container text-center">
         <img src="img/profile1.png" width="25%" class="rounded-circle img-thumbnail">
         <h1 class="display-4">Dzulfikri Alkautsari</h1>
         <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatibus.</p>
      </div>
   </div>
   <!-- end jumbotron -->

   <!-- about -->
   <section class="about" id="about">
      <div class="container">
         <div class="row mb-4">
            <div class="col-md text-center">
               <h2>About</h2>
            </div>
         </div>

         <div class="row text-justify justify-content-center">
            <div class="col-md-5">
               <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit quam incidunt nulla fugit sapiente
                  assumenda dolores vitae at? Inventore distinctio consequuntur debitis reprehenderit ut aliquid
                  fugiat suscipit cupiditate atque ex quisquam ipsa nisi eaque commodi ducimus fuga dignissimos
                  odio
                  labore earum neque necessitatibus, adipisci accusantium illum numquam? Unde vitae aspernatur
                  ipsa
                  praesentium, adipisci distinctio vel harum enim laboriosam rerum veniam dolores fuga, non amet!
                  Illo
                  necessitatibus laborum architecto ipsam, excepturi corrupti quae cupiditate ipsum numquam dicta
                  molestias, praesentium dolores doloribus.</p>
            </div>
            <div class="col-md-5">
               <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit quam incidunt nulla fugit sapiente
                  assumenda dolores vitae at? Inventore distinctio consequuntur debitis reprehenderit ut aliquid
                  fugiat suscipit cupiditate atque ex quisquam ipsa nisi eaque commodi ducimus fuga dignissimos
                  odio
                  labore earum neque necessitatibus, adipisci accusantium illum numquam? Unde vitae aspernatur
                  ipsa
                  praesentium, adipisci distinctio vel harum enim laboriosam rerum veniam dolores fuga, non amet!
                  Illo
                  necessitatibus laborum architecto ipsam, excepturi corrupti quae cupiditate ipsum numquam dicta
                  molestias, praesentium dolores doloribus.</p>
            </div>
         </div>
      </div>
   </section>
   <!-- end about -->

   <!-- social media -->
   <section class="social bg-light" id="social">
      <div class="container">
         <div class="row pt-4 mb-4">
            <div class="col text-center">
               <h2>Social Media</h2>
            </div>
         </div>

         <div class="row justify-content-center">
            <!-- Youtube -->
            <div class="col-md-5">
               <div class="row">
                  <div class="col-md-4">
                     <img src="<?= $youtubeProfilePic; ?>" width="200" class="rounded-circle img-thumbnail">
                  </div>
                  <div class="col-md-8">
                     <h5><?= $channelName; ?></h5>
                     <p><?= $subscribers; ?> Subsribers.</p>
                     <div class="g-ytsubscribe" data-channelid="UCkXmLjEr95LVtGuIm3l2dPg" data-layout="default" data-count="default"></div>
                  </div>
               </div>
               <div class="row mt-3 pb-3">
                  <div class="col">
                     <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $latestVideoId; ?>?rel=0" allowfullscreen></iframe>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Instagram -->
            <div class="col-md-5">
               <div class="row">
                  <div class="col-md-4">
                     <img src="img/profile1.png" width="200" class="rounded-circle img-thumbnail">
                  </div>
                  <div class="col-md-8">
                     <h5>@dzulfikri_alfik</h5>
                     <p>300 Followers</p>
                  </div>
               </div>
               <div class="row mt-3 pb-3">
                  <div class="col">
                     <div class="ig-thumbnail">
                        <img src="img/thumbs/1.png">
                     </div>
                     <div class="ig-thumbnail">
                        <img src="img/thumbs/2.png">
                     </div>
                     <div class="ig-thumbnail">
                        <img src="img/thumbs/3.png">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- endsocial media -->

   <!-- portfolio -->
   <section class="portfolio mb-5 pb-4" id="portfolio">
      <div class="container">
         <div class="row mb-4 pt-4">
            <div class="col-md text-center">
               <h2>Portfolio</h2>
            </div>
         </div>

         <div class="row">
            <div class="col-md">
               <div class="card mb-4">
                  <img src="img/thumbs/1.png" class="card-img-top">
                  <div class="card-body">
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk
                        of
                        the card's content.</p>
                  </div>
               </div>
            </div>
            <div class="col-md">
               <div class="card mb-4">
                  <img src="img/thumbs/2.png" class="card-img-top">
                  <div class="card-body">
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk
                        of
                        the card's content.</p>
                  </div>
               </div>
            </div>
            <div class="col-md">
               <div class="card mb-4">
                  <img src="img/thumbs/3.png" class="card-img-top">
                  <div class="card-body">
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk
                        of
                        the card's content.</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md">
               <div class="card mb-4">
                  <img src="img/thumbs/4.png" class="card-img-top">
                  <div class="card-body">
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk
                        of
                        the card's content.</p>
                  </div>
               </div>
            </div>
            <div class="col-md">
               <div class="card mb-4">
                  <img src="img/thumbs/5.png" class="card-img-top">
                  <div class="card-body">
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk
                        of
                        the card's content.</p>
                  </div>
               </div>
            </div>
            <div class="col-md">
               <div class="card mb-4">
                  <img src="img/thumbs/6.png" class="card-img-top">
                  <div class="card-body">
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk
                        of
                        the card's content.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end portfolio -->

   <!-- contact -->
   <section class="contact mb-3 bg-light pt-3" id="contact">
      <div class="container">
         <div class="row text-center mb-4">
            <div class="col">
               <h2>Contact Us</h2>
            </div>
         </div>

         <div class="row justify-content-center">
            <div class="col-lg-4 mb-3 pt-3">
               <div class="card text-white bg-primary mb-3">
                  <div class="card-body">
                     <h5 class="card-title">Contact Us</h5>
                     <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos, optio!
                     </p>
                  </div>
               </div>
               <ul class="list-group">
                  <li class="list-group-item">
                     <h2>Location</h2>
                  </li>
                  <li class="list-group-item">My Office</li>
                  <li class="list-group-item">Jl. Raya Sukabumi - Cianjur</li>
                  <li class="list-group-item">West Java, Indonesia</li>
               </ul>
            </div>
            <div class="col-lg-6">
               <form>
                  <div class="form-group">
                     <label for="nama">Nama</label>
                     <input type="text" class="form-control" id="nama">
                  </div>
                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="text" class="form-control" id="email">
                  </div>
                  <div class="form-group">
                     <label for="notelp">No. Telp</label>
                     <input type="text" class="form-control" id="notelp">
                  </div>
                  <div class="form-group">
                     <label for="pesan">Pesan</label>
                     <textarea id="pesan" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
   <!-- end contact -->

   <!-- footer -->
   <footer class="bg-dark text-white">
      <div class="container">
         <div class="row text-center pt-3">
            <div class="col">
               <p>&copy; Copyright 2020.</p>
            </div>
         </div>
      </div>
   </footer>
   <!-- end footer -->

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="js/jquery-3.1.1.min.js"></script>
   <script src="js/jquery.easing.1.3.js"></script>
   <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="js/bootstrap.min.js"></script>
   <script src="js/script.js"></script>
   <script src="https://apis.google.com/js/platform.js"></script>
</body>

</html>