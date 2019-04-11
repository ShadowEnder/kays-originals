<?php

  if (array_key_exists("submit", $_POST)) {

    $link = mysqli_connect("shareddb-i.hosting.stackcp.net", "ko-users-33377bbd", "4f8ra2m4nq", "ko-users-33377bbd");

    if (mysqli_connect_error()) {
      die ("Database Connection Error");
    }

    $error = "";

    if (!$_POST['username']) {
      $error .= "A username is required<br>";
    }

    if (!$_POST['password']) {
      $error .= "A password is required<br>";
    }

    if ($error != "") {
      $error = "<p>There were error(s) in your form:</p>".$error;
    } else {
      $query = "SELECT id from `users` WHERE username = '".mysqli_real_escape_string($link, $_POST['username'])."' LIMIT 1";

      $result = mysqli_query($link, $query);

      if (mysqli_num_rows($result) > 0) {
        $error = "That username is taken.";

      } else {

        $hash = password_hash($_Post['password'], PASSWORD_DEFAULT);

        $query = "INSERT INTO `users` (`username`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['username'])."', ('".mysqli_real_escape_string($link, $_POST['password'])."')"

        if (!mysqli_query($link, $query)) {

          $error = "<p>Could not sign you up - please try again later.</p>";

        } else {

          $query = "UPDATE `users` SET password = '".md5(md5((.mysqli_insert_id($link)).$_Post['password']))."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";

          mysqli_query($link, $query);

          echo "Sign up successful";

        }
      }
    }
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon"
      type="image/png"
      href="../images/logo/logo.png">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/floating-labels.css" rel="stylesheet">

    <title>Sign In</title>

  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="">Kay's Originals</a> <!-- href="../index.html" -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <!-- <li class="nav-item">
              <a class="nav-link" href="../index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="artists.html">Artists</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="events.html">Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">About</a>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link" href="html/sign-in.html">Sign In</a>
            </li> -->
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            <a class="nav-link" href="sign-in.html">Sign In</a>
          </form>
        </div>
      </nav>
    </header>

    <form class="form-signin" method="post">
      <div class="text-center mb-4">
        <img class="mb-4" src="../images/logo/kays-originals.png" alt="" width="50%" height=""> <!-- 72 width and height -->
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <p></p>
      </div>

      <div id ="error"><?php echo $error; ?></div>

      <div class="form-label-group">
        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputUsername">Username</label>
      </div>

      <div class="form-label-group">
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
      <!--<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>-->
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
