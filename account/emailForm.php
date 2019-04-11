<?php

$title = "Email Form";
include("header.php");

session_start();

if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {

    $_SESSION['id'] = $_COOKIE['id'];

}

if (array_key_exists("id", $_SESSION)) {

  include("connection.php");

  $session_query = "SELECT * FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
  $session_result = mysqli_query($link, $session_query) OR die ( mysqli_error());
  $session_row = mysqli_fetch_assoc($session_result);

  if ($session_row['permissions'] !== 'admin') {

    header("Location: account.php");

  } else {

  }

} else {

    header("Location: login.php");

}

if(isset($_POST['new']) && $_POST['new']==1){

  if (!$_POST['subject']) {

      $class = "alert alert-danger";
      $error .= "A subject is required<br>";

  }

  if (!$_POST['message']) {

      $class = "alert alert-danger";
      $error .= "A message is required<br>";

  }

  if ($error != "") {

      $class = "alert alert-danger";
      $error = "<p>There were error(s) in your form:</p>".$error;

  } else {

    $sel_query="SELECT * FROM `users` WHERE `permissions` = 'member' AND `preferences` LIKE '%{$_POST['preferences1']}%' OR `preferences` LIKE '%{$_POST['preferences2']}%' OR `preferences` LIKE '%{$_POST['preferences3']}%' OR `preferences` LIKE '%{$_POST['preferences4']}%' OR `preferences` LIKE '%{$_POST['preferences5']}%'";
    $result = mysqli_query($link,$sel_query);

    $formSubject = $_POST['subject'];
    $formMessage = $_POST['message'];
    $emailList;
    $name = "Kay's Originals";
    $fromEmail = "jonathan.randacciu@my.liu.edu";

    while ($row = mysqli_fetch_assoc($result)) {

      if (strpos($row['preferences'], $_POST['preferences1']) !== false ||  strpos($row['preferences'], $_POST['preferences2']) !== false ||  strpos($row['preferences'], $_POST['preferences3']) !== false || strpos($row['preferences'], $_POST['preferences4']) !== false || strpos($row['preferences'], $_POST['preferences5']) !== false){

        $email = $row['email'];
        $firstName = $row['firstname'];
        $lastName = $row['lastname'];

        $to =$email;

        $emailList .= $email.'; ';

        $subject = $firstName." ".$lastName.": ".$formSubject;

        $headers = 'From:  ' . $name . ' <' . $fromEmail .'>' . " \r\n" .
          'Reply-To: '.  $fromEmail . "\r\n";

        $message = $formMessage."\r\r\n\nSent by: ".$name.' <'.$fromEmail.'>';

        mail($to, $subject, $message, $headers);

        $class = "alert alert-success";
        $error = "Message(s) sent! ".$emailList;

      }



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
            <!--<li class="nav-item ">
              <a class="nav-link" href="reports.php">Reports</a>
            </li>-->
            <li class="nav-item active">
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



<div>
  <form name="form" method="post" action="">
    <input type="hidden" name="new" value="1" />
    <div>
      <br />
      <h1 style="text-align: center;">Email Form</h1>
        <div id="error"><?php if ($error!="") {
        echo '<div class="'.$class.'" role="alert" style="text-align: center; width: 50%;">'.$error.'</div>';
        } ?></div>
        <?php echo $selection; ?>
    </div>

    <label for="preferences"><b>Preferences:</b></label><br />
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

    <div>
      <label for="subject"><b>Subject:</b></label>
      <p><input class="form-control" type="text" name="subject" placeholder="Enter Subject" style="width:100%;" required></p>
    </div>

    <div>
      <label for="message"><b>Message:</b></label>
      <textarea class="form-control" rows="5" id="message" name="message" placeholder="Enter Your Message Here" style="width:100%;" required></textarea>
    </div>

    <br />

    <div class="container">
      <input class="btn btn-success" name="submit" type="submit" value="Submit" />
      <button class="btn btn-primary" type="reset">Reset</button>
      <button class="btn btn-danger" type="button" onclick="document.getElementById('emailForm').style.display='none'" class="cancelbtn">Cancel</button>
    </div>

    <br />

  </form>
</div>

<?php

    include("footer.php");
?>
