<?php

    $title = "Reports";

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

	include("header.php");

/*
        $query = "SELECT * FROM `users` IN preferences = (".implode(', ', $_POST['preferences']).")";

        $result = mysqli_query($link, $query);

        $row = mysqli_fetch_assoc($result);

        $emails = $result;
*/

  $visibileOR = "display: none;";
  $visibileORButton = "display: none;";
  $visibileAND = "display: none;";
  $visibileANDButton = "display: none;";
  $visibile1 = "display: none;";
  $visibile1Button = "display: none;";
  $visibile2 = "display: none;";
  $visibile2Button = "display: none;";
  $visibile3 = "display: none;";
  $visibile3Button = "display: none;";
  $visibile4 = "display: none;";
  $visibile4Button = "display: none;";
  $visibile5 = "display: none;";
  $visibile5Button = "display: none;";

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
        <li class="nav-item active">
          <a class="nav-link" href="reports.php">Reports</a>
        </li>
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



<center>
<div class="container-fluid" id="containerLoggedInPage">

    <div class="form" style="margin-top: -0px; overflow: auto; height: 650px;">
      <h1 style="text-align: center;">User Email Report</h1>
      <div id="error"><?php if ($error!="") {
      echo '<div class="'.$class.'" role="alert" style="text-align: center;">'.$error.'</div>';
      } ?></div>
      <br />
      <form name="form" method="post" action="">
      <input type="hidden" name="new" value="1" />
        <label for="preferences"><b>Preferences</b></label><br />
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="preferences1" id="inlineCheckbox1" value="Abstract">
          <label class="form-check-label" for="inlineCheckbox1">Abstract</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="preferences2" id="inlineCheckbox2" value="Contemporary">
          <label class="form-check-label" for="inlineCheckbox2">Contemporary</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="preferences3" id="inlineCheckbox3" value="Impressionism">
          <label class="form-check-label" for="inlineCheckbox3">Impressionism</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="preferences4" id="inlineCheckbox4" value="Surrealism">
          <label class="form-check-label" for="inlineCheckbox4">Surrealism</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" name="preferences5" id="inlineCheckbox5" value="No Preference">
          <label class="form-check-label" for="inlineCheckbox5">No Preference</label>
        </div>
        <br /><br />
        <p class="text-center"><input class="btn btn-success" name="submit" type="submit" value="Submit" />   <button class="btn btn-primary" type="reset">Clear</button></p>
      </form>
      <br />
      <!-- Selection: OR -->
      <?php
      if(isset($_POST['new']) && $_POST['new']==1) {
        /* $visibile = "visibility: visible;"; */
        $count=1;
        /*$preferences = implode(", ", $_POST['preferences']);*/
        $sel_query="SELECT * FROM `users` WHERE `permissions` = 'member' AND `preferences` LIKE '%{$_POST['preferences1']}%' OR `preferences` LIKE '%{$_POST['preferences2']}%' OR `preferences` LIKE '%{$_POST['preferences3']}%' OR `preferences` LIKE '%{$_POST['preferences4']}%' OR `preferences` LIKE '%{$_POST['preferences5']}%'";
        $result = mysqli_query($link,$sel_query);
        if (($_POST['preferences1'] !== NULL) && ($_POST['preferences2'] !== NULL || $_POST['preferences3'] !== NULL || $_POST['preferences4'] !== NULL || $_POST['preferences5'] !== NULL)){
          $pref1 = ' or ';
          $visibileOR = "display: block;";
          $visibileORButton = "display: inline;";
        }
        if (($_POST['preferences2'] !== NULL) && ($_POST['preferences3'] || $_POST['preferences4'] !== NULL || $_POST['preferences5'] !== NULL)){
          $pref2 = ' or ';
          $visibileOR = "display: block;";
          $visibileORButton = "display: inline;";
        }
        if ($_POST['preferences3'] !== NULL && ($_POST['preferences4'] !== NULL || $_POST['preferences5'] !== NULL)){
          $pref3 = ' or ';
          $visibileOR = "display: block;";
          $visibileORButton = "display: inline;";
        }
        if ($_POST['preferences4'] !== NULL && ($_POST['preferences5'] !== NULL)){
          $pref4 = ' or ';
          $visibileOR = "display: block;";
          $visibileORButton = "display: inline;";
        }
        echo '<div class="alert alert-primary" role="alert" style="width: 30%; '.$visibileOR.';">
        <strong><u>Selection:<br /></u>
        <i>'.$_POST['preferences1'].$pref1
        .$_POST['preferences2'].$pref2
        .$_POST['preferences3'].$pref3
        .$_POST['preferences4'].$pref4
        .$_POST['preferences5'].'
        </i></strong></div>';

        /* '.implode(", ", $_REQUEST['preferences']).' */
        ?>
        <div class="alert alert-info" role="alert" name="reported_emails_or" id="reported_emails_or" style="<?php echo $visibileOR; ?>">
        <?php

        while($row = mysqli_fetch_assoc($result)) { ?>
          <?php
          if (strpos($row['preferences'], $_POST['preferences1']) !== false ||  strpos($row['preferences'], $_POST['preferences2']) !== false ||  strpos($row['preferences'], $_POST['preferences3']) !== false || strpos($row['preferences'], $_POST['preferences4']) !== false || strpos($row['preferences'], $_POST['preferences5']) !== false) {
            echo ''.$row['email'].'; ';
            $toOR .=  ''.$row['email'].'; ';

          /*
            $db_pref = $row['preferences'];
            if (strpos($preferences, $db_pref) !== false) {
              echo $row["email"];
            } else {
              echo "nope";
            }
            echo $db_pref;*/
          }?>
      <?php $count++; } ?></div><?php } ?>

      <div class="container">
      <!-- The button used to copy the text -->
      <button class="btn btn-secondary" onclick="copyReportedEmails('#reported_emails_or')" style="<?php echo $visibileORButton; ?>">
        Copy Emails
      </button>

      <a href="emailForm.php?toInput=<?php echo $toOR; ?>" class="btn btn-default"><button class="btn btn-warning" type="submit" style="width:auto; <?php echo $visibileORButton; ?>">Email</button></a>

    </div>
      <br style="<?php echo $visibileOR; ?>" /><br style="<?php echo $visibileOR; ?>" />





      <!-- Selection: AND -->
      <?php
      if(isset($_POST['new']) && $_POST['new']==1) {
        /* $visibile = "visibility: visible;"; */
        $count=1;
        /*$preferences = implode(", ", $_POST['preferences']);*/
        $sel_query="SELECT * FROM `users` WHERE `permissions` = 'member' AND `preferences` LIKE '%{$_POST['preferences1']}%' OR `preferences` LIKE '%{$_POST['preferences2']}%' OR `preferences` LIKE '%{$_POST['preferences3']}%' OR `preferences` LIKE '%{$_POST['preferences4']}%' OR `preferences` LIKE '%{$_POST['preferences5']}%'";
        $result = mysqli_query($link,$sel_query);
      if (($_POST['preferences1'] !== NULL) && ($_POST['preferences2'] !== NULL || $_POST['preferences3'] !== NULL || $_POST['preferences4'] !== NULL || $_POST['preferences5'] !== NULL)){
        $pref1 = ' and ';
        $visibileAND = "display: block;";
        $visibileANDButton = "display: inline;";
      }
      if (($_POST['preferences2'] !== NULL) && ($_POST['preferences3'] || $_POST['preferences4'] !== NULL || $_POST['preferences5'] !== NULL)){
        $pref2 = ' and ';
        $visibileAND = "display: block;";
        $visibileANDButton = "display: inline;";
      }
      if (($_POST['preferences3'] !== NULL) && ($_POST['preferences4'] !== NULL || $_POST['preferences5'] !== NULL)){
        $pref3 = ' and ';
        $visibileAND = "display: block;";
        $visibileANDButton = "display: inline;";
      }
      if (($_POST['preferences4'] !== NULL) && ($_POST['preferences5'] !== NULL)){
        $pref4 = ' and ';
        $visibileAND = "display: block;";
        $visibileANDButton = "display: inline;";
      }

      echo '<div class="alert alert-primary" role="alert" style="width: 30%; '.$visibileAND.';">
      <strong><u>Selection:<br /></u>
      <i>'.$_POST['preferences1'].$pref1
      .$_POST['preferences2'].$pref2
      .$_POST['preferences3'].$pref3
      .$_POST['preferences4'].$pref4
      .$_POST['preferences5'].'
      </i></strong></div>';
      /* '.implode(", ", $_REQUEST['preferences']).' */
      ?>
      <div class="alert alert-info" role="alert" id="reported_emails_and" style="<?php echo $visibileAND; ?>">
      <?php
      /*
      $checked_arr = $_POST['preferences'];
      $countp = count($checked_arr);
      */
      $counts = array_count_values($_POST);
      $countp = $counts['Abstract'] + $counts['Contemporary'] + $counts['Impressionism'] + $counts['Surrealism'] + $counts['No Preference'];
      /*if($_POST['preferences1'] !== false) {
        $countp++;
      }
      if($_POST['preferences2'] !== false) {
        $countp++;
      }
      if($_POST['preferences3'] !== false) {
        $countp++;
      }
      if($_POST['preferences4'] !== false) {
        $countp++;
      }
      if($_POST['preferences5'] !== false) {
        $countp++;
      }*/

      while($row = mysqli_fetch_assoc($result)) { ?>
        <?php
        /*echo $countp;*/
        if ((strpos($row['preferences'], $_POST['preferences1']) !== false) ||  (strpos($row['preferences'], $_POST['preferences2']) !== false) ||  (strpos($row['preferences'], $_POST['preferences3']) !== false) ||  (strpos($row['preferences'], $_POST['preferences4']) !== false) ||  (strpos($row['preferences'], $_POST['preferences5']) !== false)) {
          if ($countp == 5) {
            if ((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences2']) !== false) && (strpos($row['preferences'], $_POST['preferences3']) !== false) && (strpos($row['preferences'], $_POST['preferences4']) !== false) && (strpos($row['preferences'], $_POST['preferences5']) !==false)) {
              echo ''.$row['email'].'; ';
              $toAND .=  ''.$row['email'].'; ';
            }
          }
          elseif ($countp == 4) {
            if (((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences2']) !== false) && (strpos($row['preferences'], $_POST['preferences3']) !== false) && (strpos($row['preferences'], $_POST['preferences4']) !== false)) ||
                ((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences2']) !== false) && (strpos($row['preferences'], $_POST['preferences3']) !== false) && (strpos($row['preferences'], $_POST['preferences5']) !== false)) ||
                ((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences3']) !== false) && (strpos($row['preferences'], $_POST['preferences4']) !== false) && (strpos($row['preferences'], $_POST['preferences5']) !== false)) ||
                ((strpos($row['preferences'], $_POST['preferences2']) !== false) && (strpos($row['preferences'], $_POST['preferences3']) !== false) && (strpos($row['preferences'], $_POST['preferences4']) !== false) && (strpos($row['preferences'], $_POST['preferences5']) !== false))) {
                  echo ''.$row['email'].'; ';
                  $toAND .=  ''.$row['email'].'; ';
                }
          }
          elseif ($countp == 3) {
            if(((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences2']) !== false) && (strpos($row['preferences'], $_POST['preferences3']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences2']) !== false) && (strpos($row['preferences'], $_POST['preferences4']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences2']) !== false) && (strpos($row['preferences'], $_POST['preferences5']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences3']) !== false) && (strpos($row['preferences'], $_POST['preferences4']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences4']) !== false) && (strpos($row['preferences'], $_POST['preferences5']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences2']) !== false) && (strpos($row['preferences'], $_POST['preferences3']) !== false) && (strpos($row['preferences'], $_POST['preferences4']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences2']) !== false) && (strpos($row['preferences'], $_POST['preferences3']) !== false) && (strpos($row['preferences'], $_POST['preferences5']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences3']) !== false) && (strpos($row['preferences'], $_POST['preferences4']) !== false) && (strpos($row['preferences'], $_POST['preferences5']) !== false))) {
              echo ''.$row['email'].'; ';
              $toAND .=  ''.$row['email'].'; ';
            }
          }
          elseif ($countp == 2) {
            if (((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences2']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences3']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences4']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences1']) !== false) && (strpos($row['preferences'], $_POST['preferences5']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences2']) !== false) && (strpos($row['preferences'], $_POST['preferences3']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences2']) !== false) && (strpos($row['preferences'], $_POST['preferences4']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences2']) !== false) && (strpos($row['preferences'], $_POST['preferences5']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences3']) !== false) && (strpos($row['preferences'], $_POST['preferences4']) !== false)) ||
            ((strpos($row['preferences'], $_POST['preferences4']) !== false) && (strpos($row['preferences'], $_POST['preferences5']) !== false))) {
              echo ''.$row['email'].'; ';
              $toAND .=  ''.$row['email'].'; ';
            }
          } else {echo $countp;}

      }
    }?>

    </div>

    <?php $count++; ?><?php } ?>

    <!-- The button used to copy the text -->
    <button class="btn btn-secondary" onclick="copyReportedEmails('#reported_emails_and')" style="<?php echo $visibileANDButton; ?>">
      Copy Emails
    </button>

    <a href="emailForm.php?toInput=<?php echo $toAND; ?>" class="btn btn-default"><button class="btn btn-warning" type="submit" style="width:auto; <?php echo $visibileORButton; ?>">Email</button></a>

    <br style="<?php echo $visibileAND; ?>" /><br style="<?php echo $visibileAND; ?>" />

    <!-- Selection: 5: NA -->
    <?php
    if(isset($_POST['new']) && $_POST['new']==1) {
      /* $visibile = "visibility: visible;"; */
      $count=1;
      /*$preferences = implode(", ", $_POST['preferences']);*/
      $sel_query="SELECT * FROM `users` WHERE `permissions` = 'member' AND `preferences`LIKE '%{$_POST['preferences5']}%'";
      $result = mysqli_query($link,$sel_query);
    if (($_POST['preferences5'] !== NULL)){
      $visibile5 = "display: block;";
      $visibile5Button = "display: inline;";
    echo '<div class="alert alert-primary" role="alert" style="width: 30%; '.$visibile5.';">
    <strong><u>Selection:<br /></u>
    <i>'.$_POST['preferences5'].'
    </i></strong></div>';
    /* '.implode(", ", $_REQUEST['preferences']).' */
    }
    ?>
    <div class="alert alert-info" role="alert" id="reported_emails_5" style="<?php echo $visibile5; ?>">
    <?php

    while($row = mysqli_fetch_assoc($result)) { ?>
      <?php
      if (strpos($row['preferences'], $_POST['preferences5']) !== false) {
          echo ''.$row['email'].'; ';
          $to5 .=  ''.$row['email'].'; ';
        }
      }?>

  </div>

  <?php $count++; ?><?php } ?>

  <!-- The button used to copy the text -->
  <button class="btn btn-secondary" onclick="copyReportedEmails('#reported_emails_5')" style="<?php echo $visibile5Button; ?>">
    Copy Emails
  </button>

  <a href="emailForm.php?toInput=<?php echo $to5; ?>" class="btn btn-default"><button class="btn btn-warning" type="submit" style="width:auto; <?php echo $visibile5Button; ?>">Email</button></a>

  <br style="<?php echo $visibile5; ?>" /><br style="<?php echo $visibile5; ?>" />

  <!-- Selection: 1 -->
  <?php
  if(isset($_POST['new']) && $_POST['new']==1) {
    /* $visibile = "visibility: visible;"; */
    $count=1;
    /*$preferences = implode(", ", $_POST['preferences']);*/
    $sel_query="SELECT * FROM `users` WHERE `permissions` = 'member' AND `preferences` LIKE '%{$_POST['preferences1']}%' OR `preferences` LIKE '%{$_POST['preferences2']}%' OR `preferences` LIKE '%{$_POST['preferences3']}%' OR `preferences` LIKE '%{$_POST['preferences4']}%'";
    $result = mysqli_query($link,$sel_query);
  if (($_POST['preferences1'] !== NULL)){
    $visibile1 = "display: block;";
    $visibile1Button = "display: inline;";
  echo '<div class="alert alert-primary" role="alert" style="width: 30%; '.$visibile1.';">
  <strong><u>Selection:<br /></u>
  <i>'.$_POST['preferences1'].'
  </i></strong></div>';
  /* '.implode(", ", $_REQUEST['preferences']).' */
  }
  ?>
  <div class="alert alert-info" role="alert" id="reported_emails_1" style="<?php echo $visibile1; ?>">
  <?php

  while($row = mysqli_fetch_assoc($result)) { ?>
    <?php
    if (strpos($row['preferences'], $_POST['preferences1']) !== false) {
        echo ''.$row['email'].'; ';
        $to1 .=  ''.$row['email'].'; ';
      }
    }?>

</div>

<?php $count++; ?><?php } ?>

<!-- The button used to copy the text -->
<button class="btn btn-secondary" onclick="copyReportedEmails('#reported_emails_1')" style="<?php echo $visibile1Button; ?>">
  Copy Emails
</button>

<a href="emailForm.php?toInput=<?php echo $to1; ?>" class="btn btn-default"><button class="btn btn-warning" type="submit" style="width:auto; <?php echo $visibile1Button; ?>">Email</button></a>

<br style="<?php echo $visibile1; ?>" /><br style="<?php echo $visibile1; ?>" />

<!-- Selection: 2 -->
<?php
if(isset($_POST['new']) && $_POST['new']==1) {
  /* $visibile = "visibility: visible;"; */
  $count=1;
  /*$preferences = implode(", ", $_POST['preferences']);*/
  $sel_query="SELECT * FROM `users` WHERE `permissions` = 'member' AND `preferences` LIKE '%{$_POST['preferences1']}%' OR `preferences` LIKE '%{$_POST['preferences2']}%' OR `preferences` LIKE '%{$_POST['preferences3']}%' OR `preferences` LIKE '%{$_POST['preferences4']}%'";
  $result = mysqli_query($link,$sel_query);
if (($_POST['preferences2'] !== NULL)){
  $visibile2 = "display: block;";
  $visibile2Button = "display: inline;";
echo '<div class="alert alert-primary" role="alert" style="width: 30%; '.$visibile2.';">
<strong><u>Selection:<br /></u>
<i>'.$_POST['preferences2'].'
</i></strong></div>';
/* '.implode(", ", $_REQUEST['preferences']).' */
}
?>
<div class="alert alert-info" role="alert" id="reported_emails_2" style="<?php echo $visibile2; ?>">
<?php

while($row = mysqli_fetch_assoc($result)) { ?>
  <?php
  if (strpos($row['preferences'], $_POST['preferences2']) !== false) {
      echo ''.$row['email'].'; ';
      $to2 .=  ''.$row['email'].'; ';
    }
  }?>

</div>

<?php $count++; ?><?php } ?>

<!-- The button used to copy the text -->
<button class="btn btn-secondary" onclick="copyReportedEmails('#reported_emails_2')" style="<?php echo $visibile2Button; ?>">
Copy Emails
</button>

<a href="emailForm.php?toInput=<?php echo $to2; ?>" class="btn btn-default"><button class="btn btn-warning" type="submit" style="width:auto; <?php echo $visibile2Button; ?>">Email</button></a>

<br style="<?php echo $visibile2; ?>" /><br style="<?php echo $visibile2; ?>" />

<!-- Selection: 3 -->
<?php
if(isset($_POST['new']) && $_POST['new']==1) {
  /* $visibile = "visibility: visible;"; */
  $count=1;
  /*$preferences = implode(", ", $_POST['preferences']);*/
  $sel_query="SELECT * FROM `users` WHERE `permissions` = 'member' AND `preferences` LIKE '%{$_POST['preferences1']}%' OR `preferences` LIKE '%{$_POST['preferences2']}%' OR `preferences` LIKE '%{$_POST['preferences3']}%' OR `preferences` LIKE '%{$_POST['preferences4']}%'";
  $result = mysqli_query($link,$sel_query);
if (($_POST['preferences3'] !== NULL)){
  $visibile3 = "display: block;";
  $visibile3Button = "display: inline;";
echo '<div class="alert alert-primary" role="alert" style="width: 30%; '.$visibile3.';">
<strong><u>Selection:<br /></u>
<i>'.$_POST['preferences3'].'
</i></strong></div>';
/* '.implode(", ", $_REQUEST['preferences']).' */
}
?>
<div class="alert alert-info" role="alert" id="reported_emails_3" style="<?php echo $visibile3; ?>">
<?php

while($row = mysqli_fetch_assoc($result)) { ?>
  <?php
  if (strpos($row['preferences'], $_POST['preferences3']) !== false) {
      echo ''.$row['email'].'; ';
      $to3 .=  ''.$row['email'].'; ';
    }
  }?>

</div>

<?php $count++; ?><?php } ?>

<!-- The button used to copy the text -->
<button class="btn btn-secondary" onclick="copyReportedEmails('#reported_emails_3')" style="<?php echo $visibile3Button; ?>">
Copy Emails
</button>

<a href="emailForm.php?toInput=<?php echo $to3; ?>" class="btn btn-default"><button class="btn btn-warning" type="submit" style="width:auto; <?php echo $visibile3Button; ?>">Email</button></a>

<br style="<?php echo $visibile3; ?>" /><br style="<?php echo $visibile3; ?>" />

<!-- Selection: 4 -->
<?php
if(isset($_POST['new']) && $_POST['new']==1) {
  /* $visibile = "visibility: visible;"; */
  $count=1;
  /*$preferences = implode(", ", $_POST['preferences']);*/
  $sel_query="SELECT * FROM `users` WHERE `permissions` = 'member' AND `preferences` LIKE '%{$_POST['preferences1']}%' OR `preferences` LIKE '%{$_POST['preferences2']}%' OR `preferences` LIKE '%{$_POST['preferences3']}%' OR `preferences` LIKE '%{$_POST['preferences4']}%'";
  $result = mysqli_query($link,$sel_query);
if (($_POST['preferences4'] !== NULL)){
  $visibile4 = "display: block;";
  $visibile4Button = "display: inline;";
echo '<div class="alert alert-primary" role="alert" style="width: 30%; '.$visibile4.';">
<strong><u>Selection:<br /></u>
<i>'.$_POST['preferences4'].'
</i></strong></div>';
/* '.implode(", ", $_REQUEST['preferences']).' */
}
?>
<div class="alert alert-info" role="alert" id="reported_emails_4" style="<?php echo $visibile4; ?>">
<?php

while($row = mysqli_fetch_assoc($result)) { ?>
  <?php
  if (strpos($row['preferences'], $_POST['preferences4']) !== false) {
      echo ''.$row['email'].'; ';
      $to4 .=  ''.$row['email'].'; ';
    }
  }?>

</div>

<?php $count++; ?><?php } ?>

<!-- The button used to copy the text -->
<button class="btn btn-secondary" onclick="copyReportedEmails('#reported_emails_4')" style="<?php echo $visibile4Button; ?>">
Copy Emails
</button>

<a href="emailForm.php?toInput=<?php echo $to4; ?>" class="btn btn-default"><button class="btn btn-warning" type="submit" style="width:auto; <?php echo $visibile4Button; ?>">Email</button></a>

</div>
</div>
</center>
<?php

    include("footer.php");
?>

<script>
function copyReportedEmails(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  alert("Emails Copied");
}
</script>
