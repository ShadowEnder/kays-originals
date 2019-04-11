<?php

    $title = "Login";

    session_start();

    $error = "";

    if (array_key_exists("logout", $_GET)) {

        unset($_SESSION);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";

        session_destroy();

    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {

      include("connection.php");

      $session_query = "SELECT id FROM `users` WHERE id = '".$_SESSION['id']."' LIMIT 1";
      $session_result = mysqli_query($link, $session_query) OR die ( mysqli_error());
      $session_row = mysqli_fetch_assoc($session_result);

      if ($session_row['permissions'] == 'admin') {

        header("Location: view.php");

      } else {

        header("Location: account.php");

      }

      } else {



      }

    if (array_key_exists("submit", $_POST)) {

        include("connection.php");

        if (!$_POST['email']) {

            $error .= "A email is required<br>";

        }

        if (!$_POST['password']) {

            $error .= "A password is required<br>";

        }

        if ($error != "") {

            $error = "<p>There were error(s) in your form:</p>".$error;

        } else {


                    $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

                    $result = mysqli_query($link, $query);

                    $row = mysqli_fetch_array($result);

                    if (isset($row)) {

                        $hashedPassword = md5(md5($row['id']).$_POST['password']);

                        if ($hashedPassword == $row['password']) {

                            $_SESSION['id'] = $row['id'];

                            if (isset($_POST['stayLoggedIn']) AND $_POST['stayLoggedIn'] == '1') {

                                setcookie("id", $row['id'], time() + 60*60*24);

                            }

                            if ($row['permissions'] == 'member') {

                              header("Location: account.php");

                            } else {

                              header("Location: view.php");

                            }

                        } else {

                            $error = "That email/password combination could not be found.";

                        }

                    } else {

                        $error = "That email/password combination could not be found.";

                    }

              }

        }





?>

<?php include("header.php"); ?>

<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="../index.php">Kay's Originals</a> <!-- href="../index.html" -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../html/artists.php">Artists</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../html/events.php">Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../html/about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../html/contact.php">Contact Us</a>
        </li>
      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
        <a class="nav-link" href="signUp.php">Sign Up</a>
        <!-- <a class="nav-link" href="index.php">Log In</a> -->
        <!-- <a class="nav-link" href="sign-in.html"></a> -->
      </form>
    </div>
  </nav>
</header>

      <div class="container" id="homePageContainer" style="margin-top: 50px;">

        <a href="../index.php"><img class="mb-4" src="../images/logo/kays-originals.png" alt="Kay's Originals Logo" width="50%" height=""></a>

          <p><strong></strong></p>

          <div id="error"><?php if ($error!="") {
    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
      } ?></div>


      <form method="post" id = "logInForm">

          <h3>Log In</h3>

          <p>Log in using your username and password.</p>

          <fieldset class="form-group">

              <input class="form-control" type="email" name="email" placeholder="Email" autofocus>

          </fieldset>

          <fieldset class="form-group">

              <input class="form-control"type="password" name="password" placeholder="Password">

          </fieldset>

          <div class="checkbox">

              <label>

                  <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in

              </label>

          </div>

              <input type="hidden" name="signUp" value="0">

          <fieldset class="form-group">

              <input class="btn btn-success" type="submit" name="submit" value="Log In!">

          </fieldset>

        <p>Not registered?</p>
        <p><a href="signUp.php" style="color: #4d84f9;">Sign Up</a></p>
        <!--<button class="btn btn-primary toggleForms">
          Sign Up
        </button>-->
        <!-- Rectangular switch -->
        <!-- Rounded switch -->


      </form>


<?php include("footer.php"); ?>
