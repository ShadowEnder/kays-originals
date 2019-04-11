<!doctype html>

<?php

session_start();

if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {

    $_SESSION['id'] = $_COOKIE['id'];

}

if (array_key_exists("id", $_SESSION)) {

  include("../account/connection.php");

  $session_query = "SELECT * FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
  $session_result = mysqli_query($link, $session_query) OR die ( mysqli_error());
  $session_row = mysqli_fetch_assoc($session_result);

  if ($session_row['permissions'] !== 'admin') {

    $account = "Account";

  } else {

    $account = "Dashboard";

  }

} else {

    $account = "Sign Up / Log In";

}

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon"
      type="image/png"
      href="../images/logo/logo.png">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="../css/album.css" rel="stylesheet">

    <title>Artists</title>

  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="../index.php">Kay's Originals</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="artists.php">Artists <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="events.php">Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact Us</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            <a class="nav-link" href="../account/login.php"><?php echo $account; ?></a>
            <!-- <a class="nav-link" href="sign-in.html">Sign In</a> -->
          </form>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="container">
      <div><a href="../index.php"><img src="../images/logo/kays-originals.png" style="display: block; margin: 0 auto; height: 50%; width: 21.3%; margin-top: -12px; margin-bottom: -50px;"></a></div>
      <section class="jumbotron text-center">
          <div class="container">
              <h1>Artists</h1> <!-- class="jumbotron-heading" -->
              <p class="lead text-muted">Whose work has been displayed at Kay's Originals</p>
          </div>
      </section>

            <div class="album py-5 bg-light">
              <div class="container">

                <div class="row">

                  <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                      <img class="card-img-top" src="../images/da-vinci/leonardo-da-vinci.jpg" alt="Leonardo da Vinci" >
                      <div class="card-body">
                        <p class="card-text">Leonardo da Vinci</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="../html/artists/leonardo-da-vinci.php"><button type="button" class="btn btn-sm btn-outline-secondary">View Artwork</button></a>
                            <!-- <a href="#"><button type="button" class="btn btn-sm btn-outline-secondary">Gallery</button></a> -->
                          </div>
                          <small class="text-muted">3 Artworks</small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                      <img class="card-img-top" src="../images/michelangelo/michelangelo.jpg" alt="michelangelo">
                      <div class="card-body">
                        <p class="card-text">Michelangelo</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="../html/artists/michelangelo.php"><button type="button" class="btn btn-sm btn-outline-secondary">View Artwork</button></a>
                            <!-- <a href="#"><button type="button" class="btn btn-sm btn-outline-secondary">Gallery</button></a> -->
                          </div>
                          <small class="text-muted">2 Artworks</small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                      <img class="card-img-top" src="../images/titian/tizian.jpg" alt="Card image cap">
                      <div class="card-body">
                        <p class="card-text">Titian</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="../html/artists/titian.php"><button type="button" class="btn btn-sm btn-outline-secondary">View Artwork</button></a>
                            <!-- <a href="#"><button type="button" class="btn btn-sm btn-outline-secondary">Gallery</button></a> -->
                          </div>
                          <small class="text-muted">3 Artworks</small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                      <img class="card-img-top" src="../images/sandro-botticelli/sandro-botticelli.jpg" alt="Card image cap">
                      <div class="card-body">
                        <p class="card-text">Sandro Botticelli</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="../html/artists/sandro-botticelli.php"><button type="button" class="btn btn-sm btn-outline-secondary">View Artwork</button></a>
                            <!-- <a href="#"><button type="button" class="btn btn-sm btn-outline-secondary">Gallery</button></a> -->
                          </div>
                          <small class="text-muted">3 Artwork</small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                      <img class="card-img-top" src="../images/giorgio-vasari/giorgio-vasari.jpg" alt="Card image cap">
                      <div class="card-body">
                        <p class="card-text">Giorgio Vasari</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="artists/vasari.php"><button type="button" class="btn btn-sm btn-outline-secondary">View Artwork</button></a>
                          </div>
                          <small class="text-muted">3 Artworks</small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                      <img class="card-img-top" src="../images/raphael/raphael.jpg" alt="Card image cap">
                      <div class="card-body">
                        <p class="card-text">Raphael</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="artists/raphael.php"><button type="button" class="btn btn-sm btn-outline-secondary">View Artwork</button></a>
                          </div>
                          <small class="text-muted">3 Artworks</small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                      <img class="card-img-top" src="../images/avatar-dhg.png" alt="Card image cap" >
                      <div class="card-body">
                        <p class="card-text">Dave Gamache</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="artists/dave-gamache.php"><button type="button" class="btn btn-sm btn-outline-secondary">View Artwork</button></a>
                            <!-- <a href="#"><button type="button" class="btn btn-sm btn-outline-secondary">Gallery</button></a> -->
                          </div>
                          <small class="text-muted">16 Artworks</small>
                        </div>
                      </div>
                    </div>
                  </div>

<!--
                  <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                      <img class="card-img-top" src="http://via.placeholder.com/100x225" alt="Card image cap">
                      <div class="card-body">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="artist-template.html"><button type="button" class="btn btn-sm btn-outline-secondary">View Artwork</button></a>
                          </div>
                          <small class="text-muted">9 Artworks</small>
                        </div>
                      </div>
                    </div>
                  </div>
-->
<!--
                  <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                      <img class="card-img-top" src="http://via.placeholder.com/100x225" alt="Card image cap">
                      <div class="card-body">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <a href="artist-template.html"><button type="button" class="btn btn-sm btn-outline-secondary">View Artwork</button></a>
                          </div>
                          <small class="text-muted">9 Artworks</small>
                        </div>
                      </div>
                    </div>
                  </div>
-->
                </div>
              </div>
            </div>

    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">3664 Elk Creek Rd. Brightwaters, NY 11718</span>
        <span class="text-muted">-</span>
        <span class="text-muted">555-555-5555</span>
        <span class="text-muted">-</span>
        <span class="text-muted"><a target="_blank" href="mailto:kay@kaysoriginals.com">Kay@KaysOriginals.com</a></span>
        <span class="text-muted">-</span>
        <span class="text-muted"><b>Thu-Fri:</b>  1:00 pm - 4:00 pm  |  <b>Sat-Sun:</b>  12:00 pm - 3:00 pm</span>
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2017-2018 Kay's Originals <!-- &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a> --></p>
      </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
