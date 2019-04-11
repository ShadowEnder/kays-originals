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

    <title>Deirdre Cooper Owens Lecture and Book Signing</title>

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
      <p class="lead"><a href="../events/march-18-2018-deirdre-cooper-owens.php"><span style="float: left;"><< Previous Event</span></a><a href="../events/april-8-2018-rubin-gonzalez.php"><span style="float:right;">Next Event >></span></p></a>
      <h1 class="mt-5" style="text-align: center;">Deirdre Cooper Owens Lecture and Book Signing</h1>
      <p class="lead" style="text-align: center;">Sunday, March 18, 2018<br />
        4:40 PM - 6:40 PM</p>
      <img class="featurette-image img-fluid mx-auto" src="../../images/events/deirdre-cooper-owens.png" alt="Deirdre Cooper Owens"><br />
      <p style="text-align: center;"><b><i>Medical Bondage: Race, Gender, and the Origins of American Gynecology by Deirdre Cooper Owens</i></b>
      <br /><br />
      The accomplishments of pioneering doctors such as John Peter Mettauer, James Marion Sims, and Nathan Bozeman are well documented. It is also no secret that these nineteenth-century gynecologists performed experimental caesarean sections, ovariotomies, and obstetric fistulae repairs primarily on poor and powerless women. Medical Bondage breaks new ground by exploring how and why physicians denied these women their full humanity yet valued them as “medical superbodies” highly suited for medical experimentation.
      <br /><br />
      Deirdre Cooper Owens is an Assistant Professor of History at Queens College, CUNY. She holds an M.A. in African American Studies from Clark Atlanta University and a Ph.D. in History from the University of California, Los Angeles where she also received a certificate in Women’s Studies.  Cooper Owens has received numerous awards and fellowships including a residential postdoctoral fellowship at the Carter G. Woodson Institute for African American and African Studies at the University of Virginia and an American College of Obstetricians and Gynecologists Fellowship to explore medicine, gender and the historical influence of race on each of these categories.  Her book, Medical Bondage:  Race, Gender, and the Origins of American Gynecology has been published in November 2017 by The University of Georgia Press, Race and Atlantic World Series.  Professor Cooper Owens has taught at a number of colleges and universities where she focused on classes that emphasized United States slavery, race, gender, and medicine.
      </p><br />
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
