<?php

$status = "";
$class = "alert alert-danger";

if(isset($_POST['new']) && $_POST['new']==1){

  if (!$_POST['name']) {

      $class = "alert alert-danger";
      $error .= "A name is required<br>";

  }

  if (!$_POST['email']) {

      $class = "alert alert-danger";
      $error .= "A email address is required<br>";

  }

  if (!$_POST['comment']) {

      $class = "alert alert-danger";
      $error .= "A comment is required<br>";

  }

  if ($error != "") {

      $class = "alert alert-danger";
      $error = "<p>There were error(s) in your form:</p>".$error;

  } else {

          $name =$_REQUEST['name'];
          $email = $_REQUEST['email'];
          $comments = $_REQUEST['comment'];

          $to = "jonathan.randacciu@my.liu.edu";
          $subject = "Sent from Contact Us form";
          $headers = 'From:  ' . $name . ' <' . $email .'>' . " \r\n" .
            'Reply-To: '.  $email . "\r\n";
          $message = $comments."\r\r\n\nSent by: ".$name.' <'.$email.'>';

          mail($to, $subject, $message, $headers);

          $class = "alert alert-success";
          $error = "Message sent!";
  }

}

?>

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

    <title>Contact Us</title>

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
              <a class="nav-link" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="artists.php">Artists</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="events.php">Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
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
      <h1 class="mt-5" style="text-align: center; margin-bottom: 2.5rem;">Contact Us</h1>

      <div class="form" style="margin-top: -50px; width: 50%; margin: 0 auto;">
      <h1></h1>
      <div id="error"><?php if ($error!="") {
      echo '<div class="'.$class.'" role="alert" style="text-align: center;">'.$error.'</div>';
      } ?></div>
      <form name="form" method="post" action="">
      <input type="hidden" name="new" value="1" />

      <label for="username" style="text-align: left;"><b>Name:</b></label>
      <p><input class="form-control" type="text" name="name" placeholder="Enter Your Name" required autofocus /></p>

      <label for="email" style="text-align: left;"><b>Email:</b></label>
      <p><input class="form-control" type="email" name="email" placeholder="Enter Your Email" required /></p>

      <label for="comment" style="text-align: left;"><b>Comment:</b></label>
      <textarea class="form-control" rows="5" id="comment" name="comment" placeholder="Enter Your Comments Here" required></textarea>

      <br /><br />

      <p class="text-center"><input class="btn btn-success" name="submit" type="submit" value="Submit" />   <button class="btn btn-primary" type="reset">Clear</button></p>
      </form>
      <p style="color:#FF0000; text-align: center;"><?php echo $status; ?></p>
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
