<?php

use Twilio\Rest\Client;
function sendSMS($number,$contents)
{
  require_once "../vendor/autoload.php";

  $dotenv = new Dotenv\Dotenv($_SERVER['DOCUMENT_ROOT'] . '/..');
  $dotenv->load();
  $AccountSid = getenv('TWILIO_USER');
  $AuthToken = getenv('TWILIO_AUTH_TOKEN');
  $TwilioNum = getenv('TWILIO_PHONE_NUMBER');
  $client = new Client($AccountSid, $AuthToken);
  $number = "+1".$number;
  $people = array(
      $number => "Person"
  );

  foreach ($people as $number => $name)
  {
      $sms = $client->account->messages->create(
          $number,
          array(
              'from' => $TwilioNum,
              'body' => $contents
          )
      );

  }
}
