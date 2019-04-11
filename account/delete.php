<?php

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
    $query = "DELETE FROM users WHERE id=$id LIMIT 1";
    $result = mysqli_query($link,$query) or die ( mysqli_error());
    header("Location: view.php");

?>
