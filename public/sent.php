<?php
session_start();ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!isset($_SESSION['logged_in']))
{
  header('Location: ./login.php');
}
?>
<html>
<head>
  <title>PHP Mailer - Emails</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <?php
      require './../scripts/mailer.php';
      $emails = getEmails();
      foreach($emails as $email)
      {
        echo "<div class='row'><div class='col-lg-8 offset-lg-2'>";
        echo "<div class='card'><div class='card-block'><form>";
        echo "<div class='form-group'><label for='name' class='description'>Name:</label><input id='name' class='form-control' value='" . $email['name'] . "' readonly/></div>";
        echo "<div class='form-group'><label for='recipient' class='description'>To:</label><input id='recipient' class='form-control' value='" . $email['recipient'] . "' readonly/></div>";
        echo "<div class='form-group'><label for='recipient' class='description'>Message:</label><textarea class='form-control' readonly>" . $email['body'] . "</textarea></div>";
        echo "</form></div></div>";
        echo "</div></div>";
      }
    ?>
    <div class="row">
      <div class="col-lg-2 offset-lg-5">
        <a href="./index.php"><button>Back to Mailer</button></a>
      </div>
    </div>
  </div>
</body>
</html>
