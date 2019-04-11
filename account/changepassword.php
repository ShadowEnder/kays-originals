<?php

    $title = "Change Password";


    session_start();
    //$diaryContent="";

    if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {

        $_SESSION['id'] = $_COOKIE['id'];

    }

    if (array_key_exists("id", $_SESSION)) {

      include("connection.php"); /* select permissions from users where id = blahblahblah = $query , if $query != admin direct to header location:index.php */
/*
      $query = "SELECT diary FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
      $row = mysqli_fetch_array(mysqli_query($link, $query));

      $diaryContent = $row['diary'];
*/

      $session_query = "SELECT * FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
      $session_result = mysqli_query($link, $session_query) OR die ( mysqli_error());
      $session_row = mysqli_fetch_assoc($session_result);

      if ($session_row['permissions'] == 'admin') {

        header("Location: view.php");

      }

    } else {

        header("Location: login.php");

    }



  $id=$_REQUEST['id'];
  $query = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
  $result = mysqli_query($link, $query) OR die ( mysqli_error());
  $row = mysqli_fetch_assoc($result);
  $arr = explode(', ', $row['preferences']);
  /* print_r($arr); */
/*   print_r(strval($row['id'])); */

$status = "";

if(isset($_POST['new']) && $_POST['new']==1)
{


  if (!$_POST['password']) {

      $status = "";

      $error .= "A password is required<br>";

  }

  if (!$_POST['password2']) {

      $status = "";

      $error .= "The password must be confirmed<br>";

  }

  if ($error != "") {

      $status = "";

      $error = "<p>There were error(s) in your form:</p>".$error;

  } else {

      $query = "SELECT id FROM `users` WHERE id = '".mysqli_real_escape_string($link, $_SESSION['id'])."' LIMIT 1";

      $result = mysqli_query($link, $query);

      $row = mysqli_fetch_assoc($result);

      if (($row['id'] == $_SESSION['id']) && ($_POST['password'] == $_POST['password2'])) {

        $status = "";

        $id=$_REQUEST['id'];
        $password =$_REQUEST['password'];
        /* password='".md5(md5((strval($row['id']))).$password)."', */ /*was below under username, password editing disabled for security, etc. */

        $update="UPDATE users SET
        password='".md5(md5((strval($row['id']))).$password)."'
        WHERE id='".$id."'";

        mysqli_query($link, $update) or die(mysqli_error());

        $status = "Password Updated Successfully!";

      } elseif (($_POST['password'] !== $_POST['password2'])) {

          $status = "";

          $error = "The passwords entered do not match.";

      } else {

        $status = "";

        $id=$_REQUEST['id'];
        $password =$_REQUEST['password'];

        /* password='".md5(md5((strval($row['id']))).$password)."', */ /*was below under username, password editing disabled for security, etc. */
        $update="UPDATE users SET
        password='".md5(md5((strval($row['id']))).$password)."'
        WHERE id='".$id."'";

        mysqli_query($link, $update) or die(mysqli_error());

        $status = "Password Updated Successfully!";

        /*echo '<p style="color:#FF0000;">'.$status.'</p>';*/

      }

    }
}
include("header.php");
?>

<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="../index.php">Kay's Originals</a> <!-- href="../index.html" -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-ite">
          <a class="nav-link" href="account.php">Account</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="changepassword.php">Change Password</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="reports.php">Reports</a>
        </li> -->
        <!--<li class="nav-item">
          <a class="nav-link" href="about.html">About</a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="html/sign-in.html">Sign In</a>
        </li> -->
      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
        <a href='login.php?logout=1'>Logout</a>
      </form>
    </div>
  </nav>
</header>



<div class="form" style="margin-top: -0px; height: 650px;">
<h1>Change Password</h1>

<div id="error">
  <?php if ($status!="") {
echo '<div class="alert alert-success" role="alert">'.$status.'';
} ?>
  <?php if ($error!="") {
echo '<div class="alert alert-danger" role="alert">'.$error.'';
} ?>
</div>

<?php


  /*else {
  echo "<p></p>"; */ /* error , deleted b/c error was being printed always, edit works though */
?>

<div>
<form name="form" method="post" action="">
<input type="hidden" name="new" value="1" />

<input name="id" type="hidden" value="<?php echo $row['id'];?>" />

<label for="password"><b>Password</b></label>
<p><input class="form-control" type="password" name="password" placeholder="Enter Password" required /></p>

<label for="password"><b>Confirm Password</b></label>
<p><input class="form-control" type="password" name="password2" placeholder="Confirm Password" required /></p>

<br /><br />

<p class="text-center"><input class="btn btn-success" name="submit" type="submit" value="Update" />   <button class="btn btn-primary" type="reset">Reset</button></p>

<p class="text-center"><a href="account.php" style="color: #4d84f9;">Edit Account Information</a></p>

</form>
<!-- <p style="color:#FF0000; text-align: center;"><?php /*echo $status*/ ?></p> -->
</div>
</div>





<?php

    include("footer.php");
?>
