<?php

function checkLoginInfo($username,$password)
{
  require 'db.php';
  $vars = array(":username"=>$username,":password"=>md5($password));
  $sql = "SELECT id FROM users WHERE username=:username AND password=:password";
  $pdo = getPDO();
  $stmt = $pdo->prepare($sql);
  $stmt->execute($vars);
  $rs = $stmt->fetch();

  if(isset($rs['id']))
  {
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $rs['id'];
    return true;
  }

  return false;
}


?>
