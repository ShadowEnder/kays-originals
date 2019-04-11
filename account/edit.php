<?php

    $title = "Edit User";
    include("header.php");

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



  $id=$_REQUEST['id'];
  $query = "SELECT * FROM users WHERE id='".$id."' LIMIT 1";
  $result = mysqli_query($link, $query) OR die ( mysqli_error());
  $row = mysqli_fetch_assoc($result);
  $arr = explode(', ', $row['preferences']);
  /* print_r($arr); */
/*   print_r(strval($row['id'])); */

$status = "";

if(isset($_POST['new']) && $_POST['new']==1)
{

  if (!$_POST['email']) {

      $status = "";

      $error .= "A email is required<br>";

  }

  if (!$_POST['firstname']) {

      $status = "";

      $error .= "A First Name is required<br>";

  }

  if (!$_POST['lastname']) {

      $status = "";

      $error .= "A Last Name is required<br>";

  }

  if ($error != "") {

      $status = "";

      $error = "<p>There were error(s) in your form:</p>".$error;

  } else {

      $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

      $result = mysqli_query($link, $query);

      if ($row['email'] == $_POST['email']) {

        $status = "";

        $id=$_REQUEST['id'];
        $email =$_REQUEST['email'];
        $firstname =$_REQUEST['firstname'];
        $lastname =$_REQUEST['lastname'];
        /* $password =$_REQUEST['password']; */
        $preferences = $_REQUEST['preferences'];
        $permissions =$_REQUEST['permissions'];

        /* password='".md5(md5((strval($row['id']))).$password)."', */ /*was below under username, password editing disabled for security, etc. */
        $update="UPDATE users SET
        email='".$email."',
        firstname='".$firstname."',
        lastname='".$lastname."',
        preferences='".implode(', ',$preferences)."',
        permissions='".$permissions."'
        WHERE id='".$id."'";

        mysqli_query($link, $update) or die(mysqli_error());

        $status = "Record Updated Successfully. </br></br>

        <a href='view.php'>View Updated Record</a>";

        $id=$_REQUEST['id'];
        $query = "SELECT * FROM users WHERE id='".$id."' LIMIT 1";
        $result = mysqli_query($link, $query) OR die ( mysqli_error());
        $row = mysqli_fetch_assoc($result);
        $arr = explode(', ', $row['preferences']);

      } elseif (mysqli_num_rows($result) > 0) {

          $error = "That email is already in use.";

      } else {

        $status = "";

        $id=$_REQUEST['id'];
        $email =$_REQUEST['email'];
        $firstname =$_REQUEST['firstname'];
        $lastname =$_REQUEST['lastname'];
        /* $password =$_REQUEST['password']; */
        $preferences = $_REQUEST['preferences'];
        $permissions =$_REQUEST['permissions'];

        /* password='".md5(md5((strval($row['id']))).$password)."', */ /*was below under username, password editing disabled for security, etc. */
        $update="UPDATE users SET
        email='".$email."',
        firstname='".$firstname."',
        lastname='".$lastname."',
        preferences='".implode(', ',$preferences)."',
        permissions='".$permissions."'
        WHERE id='".$id."'";

        mysqli_query($link, $update) or die(mysqli_error());

        $status = "Record Updated Successfully. </br></br>

        <a href='view.php'>View Updated Record</a>";

        $id=$_REQUEST['id'];
        $query = "SELECT * FROM users WHERE id='".$id."' LIMIT 1";
        $result = mysqli_query($link, $query) OR die ( mysqli_error());
        $row = mysqli_fetch_assoc($result);
        $arr = explode(', ', $row['preferences']);

        /*echo '<p style="color:#FF0000;">'.$status.'</p>';*/

      }

    }
}

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
        <li class="nav-item">
          <a class="nav-link" href="view.php">View Users</a>
        </li>
        <li class="nav-item">
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



<div class="form" style="margin-top: -0px; overflow: auto; height: 650px;">
<h1>Edit User</h1>

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

<label for="email"><b>Email</b></label>
<p><input class="form-control" type="email" name="email" placeholder="Enter Email" required value="<?php echo $row['email'];?>" /></p>
<!--
<label for="password"><b>Password</b></label>
<p><input class="form-control" type="password" name="password" placeholder="Enter Password" required value="<?php echo $row['password'];?>" /></p>
-->
<label for="firstname"><b>First Name</b></label>
<p><input class="form-control" type="text" name="firstname" placeholder="Enter First Name" required value="<?php echo $row['firstname'];?>" /></p>

<label for="lastname"><b>Last Name</b></label>
<p><input class="form-control" type="text" name="lastname" placeholder="Enter Last Name" required value="<?php echo $row['lastname'];?>" /></p>

<label for="preferences"><b>Preferences</b></label><br />
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="preferences[]" id="inlineCheckbox1" value="Abstract" <?php if(in_array('Abstract',$arr) !== false){ ?> checked="checked" <?php } ?>>
  <label class="form-check-label" for="inlineCheckbox1">Abstract</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="preferences[]" id="inlineCheckbox2" value="Contemporary" <?php if(in_array('Contemporary',$arr) !== false){ ?> checked="checked" <?php } ?>>
  <label class="form-check-label" for="inlineCheckbox2">Contemporary</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="preferences[]" id="inlineCheckbox3" value="Impressionism" <?php if(in_array('Impressionism',$arr) !== false){ ?> checked="checked" <?php } ?>>
  <label class="form-check-label" for="inlineCheckbox3">Impressionism</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="preferences[]" id="inlineCheckbox4" value="Surrealism" <?php if(in_array('Surrealism',$arr) !== false){ ?> checked="checked" <?php } ?>>
  <label class="form-check-label" for="inlineCheckbox4">Surrealism</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="preferences[]" id="inlineCheckbox5" value="No Preference" <?php if(in_array('No Preference',$arr) !== false){ ?> checked="checked" <?php } ?>>
  <label class="form-check-label" for="inlineCheckbox5">No Preference</label>
</div>

<br /><br />

<label for="permissions"><b>Permissions</b></label>
<?php $permissions = $_GET['permissions']; ?>
<p><select class="form-control" name="permissions" style="width: 35%;" requried>
  <option value="<?php echo $row['permissions'];?>" selected> <?php echo $row['permissions']; ?> </option>
  <option value ="member">Member</option>
  <option value="admin">Admin</option>
</select></p>

<p class="text-center"><input class="btn btn-success" name="submit" type="submit" value="Update" />   <button class="btn btn-primary" type="reset">Reset</button></p>
</form>
<!-- <p style="color:#FF0000; text-align: center;"><?php /*echo $status*/ ?></p> -->
</div>
</div>





<?php

    include("footer.php");
?>
