#!/usr/bin/php
<?php
session_start();

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$username = "";

$client = new rabbitMQClient("RabbitMQ-DB.ini","testServer");
//echo "ppdClient BEGIN".PHP_EOL;

if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}

//LOGIN
if (isset($_POST['login'])) {
	$request = array();
	$request['type']     = "Login";
	$request['username'] = $_POST["username"];
	$request['password'] = $_POST["password"];
	$request['message']  = $msg;

	//echo "SENT: ";
	$response = $client->send_request($request);
	//echo "client received response: ".PHP_EOL;
	
	print_r($response);

	if (!$response){
		array_push($errors, "Incorrect username or password");	
	}
	if ($response){  
				
		$_SESSION['username'] = $request['username'];
      	$_SESSION['success'] = "Login Succesful!";  
		$_SESSION['json'] = json_decode($response);
		header('location: landing.html');
	}
}

//REGISTRATION
if(isset($_POST['register'])){
	$request = array();
	$request['type'] = "Register";
	$request['username'] = $_POST["username"];
	$request['password'] = $_POST["password"];
	$request['firstname'] = $_POST["firstname"];
	$request['lastname'] = $_POST["lastname"];
	$request['email'] = $_POST["email"];
	$request['gender'] = $_POST["gender"];
	
	//$request['birthdate'] = $_POST["birthdate"];
	$request['message'] = $msg;

	$response = $client->send_request($request);

	print_r($response);
	
	if ($response==1){
		echo "<strong>Registration Succesful</strong>";
		$_SESSION['username'] = $request['username'];
      	$_SESSION['success'] = "You are now logged in";
		$_SESSION['json'] = json_decode($response);
		header('location: landing.html');	
	}
	else{ 
		array_push($errors, "User already exists"); 
	}
}

//echo "ppdClient END".PHP_EOL;

?>