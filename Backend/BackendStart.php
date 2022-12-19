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
    //Add Preferences
    case "foodPrefs":
      echo "\nType: Add Preferences";
      $response_msg = addPreference($request['username'], $request['foodpref'], $request['diet-type'], $request['restrictions']);
      break;
    //Add Health Info
    case "bmiform":
      echo "\nType: Add Health Info";
      $response_msg = updateHealthInfo($request['username'], $request['age'], $request['height'], $request['weight'], $request['goals'], $request['activity'], $request['gender']);
      break;
    case "searchFood":
      echo "\nType: recommendation search";
      $response_msg = doFood($request['username'], $request['searchRecipe']);
      break;
    case "fridgesearch":
      echo "\nType: fridge search";
      $response_msg = whatsinyourfridge($request['username'], $request['ingredient'], $request['ingredient1'], $request['ingredient2'], $request['ingredient3'], $request['ingredient4']);
      break;
    case "updateBMR":
      echo "\nType: updating BMR";
      $response_msg = displayBMR($request['username']);
    }
    return $response_msg;
  }

$server = new rabbitMQServer("RabMQConnect.ini","testServer");


echo "dbServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "dbServer END".PHP_EOL;
exit();
?>