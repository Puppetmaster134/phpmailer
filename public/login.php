<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_SESSION['logged_in']))
{
  header('Location: index.php');
}

if(isset($_POST['login']))
{
  if(isset($_POST['username']) && isset($_POST['password']))
  {
    require './../scripts/login.php';
    if(checkLoginInfo($_POST['username'],$_POST['password']))
    {
      header('Location: ./index.php');
    }
  }

}
?>
<html>
<head>
  <title>PHP Mailer - Login</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="jumbotron col-sm-4 offset-sm-4" style="text-align:center;background-color:#0275d8;color:lightblue">
        <h3>PHP Mailer</h3>
        <p style="font-style:italic">By Brian Zimmerman</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4 offset-sm-4" style="border-radius:5px;border:1px dotted #0275d8; padding:5px">
        <form method="post">
          <div class="form-group">
            <label for="username" class="description">Username:</label>
            <input id="name" class="form-control" name="username" type="text" placeholder="Username"/>
          </div>
          <div class="form-group">
            <label for="username" class="description">Password:</label>
            <input id="password" class="form-control" name="password" type="password" placeholder="Password"/>
          </div>
          <div style="text-align:center">
            <button id="send" name="login" class="btn btn-primary" type="submit">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
