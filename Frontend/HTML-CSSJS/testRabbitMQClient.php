#!/usr/bin/php
<?php
session_start();
require_once('../../RabbitMQ/path.inc');
require_once('../../RabbitMQ/get_host_info.inc');
require_once('../../RabbitMQ/rabbitMQLib.inc');


$client = new rabbitMQClient("../../RabbitMQ/testRabbitMQ.ini","testServer");
echo "ppdClient BEGIN".PHP_EOL;

if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}

//LOGIN
if (isset($_POST['login_user'])) {
	$request = array();
	$request['type']     = "Login";
	$request['username'] = $_POST["username"];
	$request['password'] = $_POST["password"];
	$request['message']  = $msg;

	$response = $client->send_request($request);
	//$response = $client->publish($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==0){
		array_push($errors, "Wrong username/password combination");	
	}
	if ($response != null){  
				
		$_SESSION['username'] = $request['username'];
      		$_SESSION['success'] = "You are now logged in";
		$_SESSION['json'] = json_decode($response);
		header('location: landing.html');
	}
}

//REG
if (isset($_POST['reg_user'])) {
	$request = array();
	$request['type']       = "Register";
	$request['firstName']   = $_POST["firstName"];
	$request['lastName']   = $_POST["lastName"];
    $request['email']      = $_POST["email"];
	$request['userName'] = $_POST["userName"];

	$request['password_1'] = $_POST["password_1"];
	$request['password_2'] = $_POST["password_2"];

	if ($request['password_1'] != $request['password_2']) {  
		array_push($errors, "Passwords don't match");	
	}
	else { $response = $client->send_request($request); }
	//$response = $client->send_request($request);
	//$response = $client->publish($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);
	
	if ($response==1){
		echo "<strong>New User Registered</strong>";
		$_SESSION['username'] = $request['username'];
      		$_SESSION['success'] = "You are now logged in";
		header('location: landing.html');	
	}
	else{ array_push($errors, "User already exists"); }
}

echo "ppdClient END".PHP_EOL;

?>