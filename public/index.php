<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!isset($_SESSION['logged_in']))
{
  header('Location: ./login.php');
}

if(isset($_POST['send']))
{
  if(isset($_POST['name']) && isset($_POST['address']) && isset($_POST['message']))
  {
    require './../scripts/mailer.php';
    $name = $_POST['name'];
    $address = $_POST['address'];
    $body = $_POST['message'];
    sendEmail($name,$address,$body);
  }
}
?>
<html>
<head>
  <title>PHP Mailer - Home</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <form method="post">
          <div class="form-group">
            <label for="name" class="description">Name:</label>
            <input id="name" name="name" class="form-control" type="text" placeholder="Your Name"/>
          </div>
          <div class="form-group">
            <label for="address" class="description">To:</label>
            <input id="address" name="address" class="form-control" type="text" placeholder="Their Email Address"/>
          </div>
          <div class="form-group">
            <label for="message" class="description">Message:</label>
            <textarea id="message" name="message" class="form-control" type="text" rows=20></textarea>
          </div>
          <div style="text-align:center">
            <button id="send" name="send" class="btn btn-primary" type="submit">Send</button>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <div class="card">
          <div class="card-block">
            <h4 class="card-title" style="text-align:center">Control Panel</h4>
            <div class="row">
              <a class="btn btn-primary col-md-3 offset-md-2" href="./logout.php">Logout</a>
              <a class="btn btn-primary col-md-3 offset-md-2" href="./sent.php">View Emails</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>
</html>
