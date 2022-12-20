<?php
session_start();
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

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
	
	$response = $client->send_request($request);	
	print_r($response);

	if (!$response){
		array_push($errors, "Incorrect username or password");	
	}
	if ($response){  	
		$_SESSION['username'] = $request['username'];
      	$_SESSION['success'] = "Login Succesful!";  
		$_SESSION['json'] = json_decode($response);
		header('location: landing.php');
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
	//$request['gender'] = $_POST["gender"];
	$request['message'] = $msg;

	$response = $client->send_request($request);

	print_r($response);
	
	if ($response==1){
		echo "<strong>Registration Succesful</strong>";
		$_SESSION['username'] = $request['username'];
		//$_SESSION['firstname'] = $request['firstname'];
      	$_SESSION['success'] = "You are now logged in";
		$_SESSION['json'] = json_decode($response);
		header('location: landing.php');	
	}
	else{ 
		array_push($errors, "User already exists"); 
	}
}

//BMIForm
if(isset($_POST['bmiform'])){
	$request = array();
	$request['type'] = "bmiform";
	$request['username'] = $_SESSION["username"];
	$request['age'] = $_POST["age"];
	$request['height'] = $_POST["height"];
	$request['weight'] = $_POST["weight"];
	$request['goals'] = $_POST["goals"];
	$request['activity'] = $_POST["activity"];
	$request['gender'] = $_POST["gender"];
	$request['message'] = $msg;

	$response = $client->send_request($request);

	print_r($response);
	
	if ($response==1){
		echo "<strong>BMI Calculation Succesful</strong>";
		$_SESSION['json'] = $response;
		//$_SESSION["BMR"] = $request["BMR"];
		header('location: landing.php');	
	}
	else{ 
		array_push($errors, "BMI Calculation Failed"); 
	}
}

//Food Preferences Form
if(isset($_POST['foodPrefs'])){
	$request = array();
	$request['type'] = "foodPrefs";
	$request['username'] = $_SESSION["username"];
	$request['foodpref'] = $_POST["foodpref"];
	$request['diet-type'] = $_POST["diet-type"];
	$request['restrictions'] = $_POST["restrictions"];
	$request['message'] = $msg;

	$response = $client->send_request($request);

	print_r($response);
	
	if ($response==1){
		echo "<strong>Food Preferences Set!</strong>";
		$_SESSION['foodpref'] = $request['foodpref'];
		$_SESSION['diet-type'] = $request['diet-type'];
		$_SESSION['restrictions'] = $request['restrictions'];
		//$_SESSION['json'] = json_decode($response);
		header('location: landing.php');	
	}
	else{ 
		array_push($errors, "Setting Food Preferences Failed"); 
	}
}

//Veiw Stats
/*if (isset($_POST["updateBMR"])){
	$request = array();
	$request['type'] = "updateBMR";
	$request['username'] = $_SESSION["username"];
	//$request['update'] = $_POST["update"];
	$request['message'] = $msg;

	$response = $client->send_request($request);

	print_r($response);
	
	if ($response==1){
		echo "<strong>Stats Veiwed!</strong>";
		//$_SESSION['update'] = $request['update'];
		$_SESSION['json'] = $response;
		//header('location: landing.php');	
	}
	else{ 
		array_push($errors, "Viewing Stats Failed!"); 
	}
}*/

//Search Recipes
if (isset($_POST['searchFood'])) {
	$request = array();
	$request['type']     = "searchFood";
	$request['username'] = $_SESSION["username"];
	$request['searchRecipe']   = $_POST["searchRecipe"];

	$response = $client->send_request($request);
	
	print_r($response);

	if ($response==1) {
		echo "<strong>Search Successful!</strong>";
		//$_SESSION['json'] = json_decode($response);
		//$_SESSION['message'] = json_decode($msg);
		//header('location: landing.php');	
	}
	else{ 
		array_push($errors, "Recipe Search Failed!"); 
	}
}

//Fridge Search
if (isset($_POST['fridgesearch'])) {
	$request = array();
	$request['type']     = "fridgesearch";
	$request['username'] = $_SESSION["username"];
	$request['ingredient']   = $_POST["ingredient"];
	$request['ingredient1']   = $_POST["ingredient1"];
	$request['ingredient2']   = $_POST["ingredient2"];
	$request['ingredient3']   = $_POST["ingredient3"];
	$request['ingredient4']   = $_POST["ingredient4"];


	$response = $client->send_request($request);
	
	print_r($response);

	if ($response==1) {
		$_SESSION['response'] = json_decode($response);
		header('location: landing.php');	
	}
	else{ 
		array_push($errors, "Whats in your fridge failed!"); 
	}
}

?>