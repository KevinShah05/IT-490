#!/usr/bin/php
<?php

/*Creating new RabbitMQ Client Instances*/ 


session_start();
require_once('../SeedFiles/path.inc');
require_once('../SeedFiles/get_host_info.inc');
require_once('../SeedFiles/rabbitMQLib.inc');

$client = new rabbitMQClient("../SeedFiles/RabbitMQ-DB.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}

$userName = $_POST["username"];
$userPass = $_POST["password"];

$request = array();
$request['type'] = "login";
$request['username'] = $userName;
$request['password'] = $userPass;
#$request['username'] = "steve";
#$request['password'] = "password";
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
if ($response ==1){

	$_SESSION["username"]= $_POST["username"];
	header("Location: ../HTML-CSSJS/landing.html");
}else{
	header("Location: ../HTML-CSSJS/login.html");
}
?>