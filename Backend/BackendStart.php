#!/usr/bin/php
<?php
session_start();

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbConnection.php');
require_once('BackendFunctions.php');


function requestProcessor($request)
{
  echo "\n\n\nreceived request".PHP_EOL;
  echo $request['type'].PHP_EOL;
  var_dump($request);

  if(!isset($request['type']))
  {
    //return "ERROR: unsupported message type";
    return array('message'=>"ERROR: unsupported message type");
  }
  switch ($request['type'])
  {
    //Login function
    case "Login":
      echo "\nType: Login\n";
      $response_msg = doLogin($request['username'],$request['password']);
      break;
    //Register function
    case "Register":
      echo "\n*Type: Registration\n";
      $response_msg = doRegister($request['username'],$request['password'],$request['firstname'],$request['lastname'],$request['email'],$request['gender']);
      break;
    }
    return $response_msg;
  }

$server = new rabbitMQServer("RabMQConnect.ini","testServer");


echo "dbServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "dbServer END".PHP_EOL;
exit();
?>