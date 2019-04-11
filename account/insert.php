<?php

    $title = "Add New User";


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

      if ($session_row['permissions'] !== 'admin') {

        header("Location: account.php");

      }

    } else {

        header("Location: login.php");

    }



  $status = "";

if(isset($_POST['new']) && $_POST['new']==1){

  if (!$_POST['email']) {

      $error .= "A email address is required<br>";

  }

  if (!$_POST['firstname']) {

      $error .= "A First Name is required<br>";

  }

  if (!$_POST['lastname']) {

      $error .= "A Last Name is required<br>";

  }

  if (!$_POST['password']) {

      $error .= "A password is required<br>";

  }

  /*if ($_POST['email'] !== $_POST['email2']) {

      $error .= "The emails entered do not match.<br>";

  }

  if ($_POST['password'] !== $_POST['password2']) {

      $error .= "A passwords entered do not match.<br>";

  }*/

  if ($error != "") {

      $error = "<p>There were error(s) in your form:</p>".$error;

  } else {

      $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

      $result = mysqli_query($link, $query);

      if (mysqli_num_rows($result) > 0) {

          $error = "That email is already in use.";

      } else {

          $email = $_REQUEST['email'];
          $firstname =$_REQUEST['firstname'];
          $lastname =$_REQUEST['lastname'];
          $password = md5(md5(mysqli_insert_id($link)).$_REQUEST['password']);
          $preferences = implode(', ', $_REQUEST['preferences']);
          $permissions= $_REQUEST['permissions'];
          $ins_query="INSERT INTO users
          (`email`, `firstname`, `lastname`,`password`,`preferences`,`permissions`)values
          ('$email', '$firstname', '$lastname','$password','$preferences','$permissions')";
          mysqli_query($link,$ins_query)
          or die(mysql_error());
          $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
          mysqli_query($link, $query);
          $status = "New Record Inserted Successfully.
          </br></br><a href='view.php'>View Inserted Record</a>";
    }
  }
}
include("header.php");
?>

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
          <a class="nav-link" href="view.php">View Users</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="insert.php">New User</a>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link" href="reports.php">Reports</a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link" href="emailForm.php">Email</a>
        </li>
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



<div class="form" style="margin-top: 50px; overflow: auto; height: 750px;">
<h1>Add New User</h1>

<div id="error">
  <?php if ($status!="") {
echo '<div class="alert alert-success" role="alert">'.$status.'';
} ?>
<?php if ($error!="") {
echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
} ?>
</div>

<form name="form" method="post" action="">
<input type="hidden" name="new" value="1" />

<label for="email"><b>Email</b></label>
<p><input class="form-control" type="email" name="email" placeholder="Enter Email Address" required autofocus /></p>

<!--<label for="email2"><b>Confirm Email</b></label>
<p><input class="form-control" type="email" name="email2" placeholder="Confirm Email Address" required /></p>-->

<label for="firstname"><b>First Name</b></label>
<p><input class="form-control" type="text" name="firstname" placeholder="Enter First Name" required /></p>

<label for="lastname"><b>Last Name</b></label>
<p><input class="form-control" type="text" name="lastname" placeholder="Enter Last Name" required /></p>

<label for="password"><b>Password</b></label>
<p><input class="form-control" type="password" name="password" placeholder="Enter Password" required /></p>

<!--<label for="password2"><b>Confirm Password</b></label>
<p><input class="form-control" type="password" name="password2" placeholder="Confirm Password" required /></p>-->

<label for="preferences"><b>Preferences</b></label><br />
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="preferences[]" id="inlineCheckbox1" value="Abstract">
  <label class="form-check-label" for="inlineCheckbox1">Abstract</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="preferences[]" id="inlineCheckbox2" value="Contemporary">
  <label class="form-check-label" for="inlineCheckbox2">Contemporary</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="preferences[]" id="inlineCheckbox3" value="Impressionism">
  <label class="form-check-label" for="inlineCheckbox3">Impressionism</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="preferences[]" id="inlineCheckbox4" value="Surrealism">
  <label class="form-check-label" for="inlineCheckbox4">Surrealism</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="preferences[]" id="inlineCheckbox5" value="No Preference">
  <label class="form-check-label" for="inlineCheckbox5">No Preference</label>
</div>

<br /><br />

<label for="permissions"><b>Permissions</b></label>
<p><select class="form-control" name="permissions" style="width: 35%;" requried>
  <option value ="member">Member</option>
  <option value="admin">Admin</option>
</select></p>
<!--<p><input type="text" name="permissions" placeholder="Permissions" required /></p> -->
<p class="text-center"><input class="btn btn-success" name="submit" type="submit" value="Submit" />   <button class="btn btn-primary" type="reset">Clear</button></p>
</form>
<!-- <p style="color:#FF0000; text-align: center;"><?php /*echo $status;*/ ?></p> -->
</div>



<?php

    include("footer.php");
?>
