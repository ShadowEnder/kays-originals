<!doctype html>

<?php

session_start();

if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {

    $_SESSION['id'] = $_COOKIE['id'];

}

if (array_key_exists("id", $_SESSION)) {

  include("../../account/connection.php");

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
      href="../../images/logo/logo.png">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="../../css/individual-event.css" rel="stylesheet">

    <title>Me, Myself and Eye: Owen Howard</title>

  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="../../index.php">Kay's Originals</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="../../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../artists.php">Artists</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="../events.php">Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../about.php">About <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../contact.php">Contact Us</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            <a class="nav-link" href="../../account/login.php"><?php echo $account; ?></a>
            <!-- <a class="nav-link" href="../sign-in.html">Sign In</a> -->
          </form>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="container">
      <div><a href="../../index.php"><img src="../../images/logo/kays-originals.png" style="display: block; margin: 0 auto; height: 50%; width: 21.3%; margin-top: -12px; margin-bottom: -50px;"></a></div>
      <p class="lead"><a href="../../html/events.html"><span style="float: left;"><< Back to Event List</span></a><a href="../events/march-18-2018-deirdre-cooper-owens.php"><span style="float:right;">Next Event >></span></p></a>
      <h1 class="mt-5" style="text-align: center;">Me, Myself and Eye: Owen Howard</h1>
      <p class="lead" style="text-align: center;">Sunday, March 4, 2018<br />
        4:40 PM - 6:40 PM</p>
      <img class="featurette-image img-fluid mx-auto" src="../../images/events/owen-howard.jpg" alt="Owen Howard"><br />
      <p style="text-align: center;">Stop in for an afternoon of music-meets-art during Kay’s Originals' monthly Sunday series “Me Myself and Eye.” Michel Gentile presents Brooklyn-based jazz drummer & composer Owen Howard in a solo concert featuring the cutting-edge jazz that he is known for. Owen currently has six recordings to his credit, including two that have received Juno Awards (Canada’s version of the Grammys) nominations for Jazz Album of the Year: “Drum Lore Vol and Vol 2.” With his personal approach to percussion, Owen is in demand as a sideman as well, and has shared the stage and studio with such greats as Joe Lovano, Kenny Wheeler, Dave Holland, Sheila Jordan and Tom Harrell, to name a few. Owen conducts workshops throughout the world and has been on the faculty at The Banff Centre of the Arts, The Maine Jazz Camp, and directed jazz education at the Brooklyn Youth Music Project, a community-based project to support the development of life-long learners and young musicians.
      <br /><br />
      “Owen Howard swings with authority while cutting up the beat in creative ways—yet he has a penchant color and melody on the kit.”
      <br />
      —Bill Milkowski, Jazz Times

      <br /><br />
      Join us on the first Sunday of every month for Me, Myself, and Eye: Kay’s Originals' avant-garde music series curated by Michel Gentile.
      <br /><br />
      Suggested donation $10</p>

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
