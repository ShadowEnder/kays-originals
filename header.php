<!doctype html>

<?php

session_start();

if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {

    $_SESSION['id'] = $_COOKIE['id'];

}

if (array_key_exists("id", $_SESSION)) {

  include("account/connection.php");

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
      href="images/logo/logo.png">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">

    <title>Home</title>

  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="index.php">Kay's Originals</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="html/artists.php">Artists</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="html/events.php">Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="html/about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="html/contact.php">Contact Us</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            <a class="nav-link" href="account/login.php"><?php echo $account; ?></a>
            <!-- <a class="nav-link" href="html/sign-in.html">Sign In</a> -->
          </form>
        </div>
      </nav>
    </header>
