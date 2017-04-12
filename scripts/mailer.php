<?php


function sendEmail($name,$recipient,$body)
{
  require '../vendor/autoload.php';
  require 'db.php';

  //Construct SendGrid Email object here
  $from = new SendGrid\Email($name, $name."@bzimmerman.me");
  $subject = $name;
  $to = new SendGrid\Email("Recipient", $recipient);
  $content = new SendGrid\Content("text/plain", $body);
  $mail = new SendGrid\Mail($from, $subject, $to, $content);

  //Load .env and retrieve sendgrid api key
  $dotenv = new Dotenv\Dotenv($_SERVER['DOCUMENT_ROOT'] . '/..');
  $dotenv->load();
  $apiKey = getenv('SENDGRID_API_KEY');

  //Send the email
  $sg = new \SendGrid($apiKey);
  $response = $sg->client->mail()->send()->post($mail);

  //Store in the database
  $pdo = getPDO();
  $vars = array(":user_id"=>$_SESSION['user_id'],":name"=>$name,":recipient"=>$recipient,":body"=>$body);
  $sql = "INSERT INTO emails(user_id,name,recipient,body) VALUES(:user_id,:name,:recipient,:body)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($vars);
}

function getEmails()
{
  require 'db.php';

  $pdo = getPDO();
  $sql = "SELECT * FROM emails";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll();
}

?>
