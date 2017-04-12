<?php

function getPDO()
{
  require('../vendor/autoload.php');
  $dotenv = new Dotenv\Dotenv($_SERVER['DOCUMENT_ROOT']);
  $dotenv->load();
  $hostname = getenv('DB_HOST');
  $db_name = getenv('DB_NAME');
  $username = getenv('DB_USER');
  $password = getenv('DB_PASS');
  $dsn = "mysql:host=$hostname;dbname=$db_name";
  $opt = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  return new PDO($dsn, $username, $password, $opt);
}



?>
