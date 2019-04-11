<?php

    $title = "View Clients";
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

      $preferences = $row['permissions'];

      $query = "SELECT diary FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
      $row = mysqli_fetch_array(mysqli_query($link, $query));

      $permissions = $row['permissions'];

      if ($permissions == 'admin') {

        header("Location: view.php");

      } elseif ($permissions == 'member') {

        header("Location: account.php");

      }
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
        <li class="nav-item active">
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
<!--
<nav class="navbar navbar-light bg-faded navbar-fixed-top">


  <a class="navbar-brand" href="#">Secret Diary</a>

    <div class="pull-xs-right">
      <a href ='index.php?logout=1'>
        <button class="btn btn-success-outline" type="submit">Logout</button></a>
    </div>

</nav>
-->




    <div class="container-fluid" id="containerLoggedInPage">

        <!-- <textarea id="diary" class="form-control"><?php echo $diaryContent; ?></textarea> -->







    <div class="form" style="margin-top: -100px; overflow: auto; height: 650px;">
    <h1 style="text-align: center;">View Clients</h1>
    <table width="100%" border="1" style="border-collapse:collapse;" class="table table-striped">
    <thead class="thead-dark">
    <tr>
    <th scope="col"><strong>ID</strong></th>
    <th scope="col"><strong>Email</strong></th>
    <th scope="col"><strong>First Name</strong></th>
    <th scope="col"><strong>Last Name</strong></th>
    <th scope="col"><strong>Password</strong></th>
    <th scope="col"><strong>Client Preferences</strong></th>
    <th scope="col"><strong>Permissions</strong></th>
    <th scope="col"><strong>Edit</strong></th>
    <th scope="col"><strong>Delete</strong></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $count=1;
    $sel_query="SELECT * FROM users ORDER BY id desc;";
    $result = mysqli_query($link,$sel_query);
    while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
    <td align="center" scope="row" style="font-weight: bold;"><?php echo $row['id']; ?></td>
    <td align="center"><?php echo $row["email"]; ?></td>
    <td align="center"><?php echo $row["firstname"]; ?></td>
    <td align="center"><?php echo $row["lastname"]; ?></td>
    <td align="center"><?php echo $row["password"]; ?></td>
    <td align="center"><?php echo $row["preferences"]; ?></td>
    <td align="center"><?php echo $row["permissions"]; ?></td>
    <td align="center">
    <a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a>
    </td>
    <td align="center">
    <a href="delete.php?id=<?php echo $row["id"]; ?>" onclick='javascript:confirmationDelete($(this));return false;'>Delete</a>
    </td>
    </tr>
    <?php $count++; } ?>
    </tbody>
    </table>
    </div>


</div>

<?php

    include("footer.php");
?>

<script>
function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete this user?');
   if(conf)
      window.location=anchor.attr("href");
}
</script>
