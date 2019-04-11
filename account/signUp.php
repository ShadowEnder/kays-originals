<?php

    $title = "Sign Up";

    session_start();

    $error = "";

    if (array_key_exists("logout", $_GET)) {

        unset($_SESSION);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";

        session_destroy();

    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {

      $session_query = "SELECT * FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
      $session_result = mysqli_query($link, $session_query) OR die ( mysqli_error());
      $session_row = mysqli_fetch_assoc($session_result);

      if ($session_query['permissions'] == 'admin') {

        header("Location: view.php");

      } else {

        header("Location: account.php");

      }



    } else {



    }

    if (array_key_exists("submit", $_POST)) {

        include("connection.php");


        if (!$_POST['email']) {

            $error .= "An email address is required<br>";

        }

        if (!$_POST['password']) {

            $error .= "A password is required<br>";

        }

        if (!$_POST['firstname']) {

            $error .= "A first name is required<br>";

        }

        if (!$_POST['lastname']) {

            $error .= "A last name is required<br>";

        }

        if ($error != "") {

            $error = "<p>There were error(s) in your form:</p>".$error;

        } else {

            if ($_POST['signUp'] == '1') {

                $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

                $result = mysqli_query($link, $query);

                if ($_POST['email'] !== $_POST['email2']) {

                    $error = "The emails entered do not match.";

                } elseif (mysqli_num_rows($result2) > 0) {

                    $error = "That email is already in use.";

                } elseif ($_POST['password'] !== $_POST['password2']) {

                  $error = "The passwords entered do not match.";

                } else {

                    $query = "INSERT INTO `users` (`email`, `firstname`, `lastname`,`password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['firstname'])."', '".mysqli_real_escape_string($link, $_POST['lastname'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";

                    if (!mysqli_query($link, $query)) {

                        $error = "<p>Could not sign you up - please try again later.</p>";

                    } else {

                        $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";

                        $id = mysqli_insert_id($link);

                        mysqli_query($link, $query);

                        $_SESSION['id'] = $id;

                        if ($_POST['stayLoggedIn'] == '1') {

                            setcookie("id", $id, time() + 60*60*24);

                        }

                        header("Location: account.php");

                    }

                }

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
        <!-- <a class="nav-link" href="signUp.php">Sign Up</a> -->
        <a class="nav-link" href="login.php">Log In</a>
        <!-- <a class="nav-link" href="sign-in.html"></a> -->
      </form>
    </div>
  </nav>
</header>

      <div class="container" id="homePageContainer" style="margin-top: 50px;">

        <a href="../index.php"><img class="mb-4" src="../images/logo/kays-originals.png" alt="Kay's Originals Logo" width="50%" height="" style="margin-top: 25px;"></a>

          <p><strong></strong></p>

          <div id="error"><?php if ($error!="") {
    echo '<div class="alert alert-danger" role="alert" style="margin-top: -25px;">'.$error.'</div>';
      } ?></div>


<form method="post" id = "signUpForm">

    <h3>Sign Up</h3>

    <p>Interested? Sign up now.</p>

    <fieldset class="form-group">

        <input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $_POST['email'] ?>">

    </fieldset>

    <fieldset class="form-group">

        <input class="form-control" type="email" name="email2" placeholder="Confirm Email" value="<?php echo $_POST['email2'] ?>">

    </fieldset>

    <fieldset class="form-group">

        <input class="form-control" type="text" name="firstname" placeholder="First Name" value="<?php echo $_POST['firstname'] ?>">

    </fieldset>

    <fieldset class="form-group">

        <input class="form-control" type="text" name="lastname" placeholder="Last Name" value="<?php echo $_POST['lastname'] ?>">

    </fieldset>

    <fieldset class="form-group">

        <input class="form-control" type="password" name="password" placeholder="Password">

    </fieldset>

    <fieldset class="form-group">

        <input class="form-control" type="password" name="password2" placeholder="Confirm Password">

    </fieldset>

    <div class="checkbox">

        <label>

        <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in

        </label>

    </div>

    <fieldset class="form-group">

        <input type="hidden" name="signUp" value="1">

        <input class="btn btn-success" type="submit" id="signUpButton" name="submit" value="Sign Up!">

    </fieldset>

    <p>Already have an account?</p>
    <p><a href="login.php" style="color: #4d84f9;">Log In</a></p>


</form>

      </div>

<?php include("footer.php"); ?>
