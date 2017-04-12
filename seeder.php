<?php
require('vendor/autoload.php');

function getPDO()
{
  $hostname = $_SERVER['RDS_HOSTNAME'] ?? getenv('DB_HOST');
  $db_name = $_SERVER['RDS_DB_NAME'] ?? getenv('DB_NAME');
  $username = $_SERVER['RDS_USERNAME'] ?? getenv('DB_USER');
  $password = $_SERVER['RDS_PASSWORD'] ?? getenv('DB_PASS');
  $dsn = "mysql:host=$hostname;dbname=$db_name";
  $opt = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  return new PDO($dsn, $username, $password, $opt);
}


function createUserTable($pdo)
{
  $sql ="DROP TABLE IF EXISTS users";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  $sql = "CREATE TABLE users (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,username VARCHAR(16) NOT NULL,password VARCHAR(32) NOT NULL)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
}

function createEmailTable($pdo)
{
  $sql ="DROP TABLE IF EXISTS emails";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  $sql = "CREATE TABLE emails (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,user_id INT(6) NOT NULL,name VARCHAR(64) NOT NULL,recipient VARCHAR(64) NOT NULL,body BLOB NOT NULL)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
}


function addUser($pdo,$username,$password)
{
  $vars = array(":username"=>$username,":password"=>$password);
  $sql = "INSERT INTO users(username,password) VALUES(:username,:password)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($vars);
}

function addEmail($pdo,$user_id,$name,$recipient,$body)
{
  $vars = array(":user_id"=>$user_id,":name"=>$name,":recipient"=>$recipient,":body"=>$body);
  $sql = "INSERT INTO emails(user_id,name,recipient,body) VALUES(:user_id,:name,:recipient,:body)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($vars);
}

$dotenv = new Dotenv\Dotenv('.');
$dotenv->load();

$pdo = getPDO();
createUserTable($pdo);
createEmailTable($pdo);

//Add dummy user
$username = getenv('DUMMY_USERNAME');
$password = md5(getenv('DUMMY_PASSWORD'));
addUser($pdo,$username,$password);

//Add dummy email
/*
$user_id = 1;
$name = "Brian Zimmerman";
$recipient = "bdzimmerman91@gmail.com";
$body = "Hello World!";
addEmail($pdo,$user_id,$name,$recipient,$body);
*/




?>
