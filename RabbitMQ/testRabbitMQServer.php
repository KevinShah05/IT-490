#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password)
{
    // lookup username in databas
	$mydb = new mysqli('127.0.0.1', 'yfoodAdmin', 'fefefefe', 'yfoodDatabase');

	if ($mydb->errno !=0){
		echo "Fail to connect DB: ".$mydb->error.PHP_EOL;
		exit(0);}
	echo "Connected to DB";

$query = "SELECT password FROM users WHERE username = '$username';";
	      $response = $connection->query($query);
        if ($num_rows > 0){
        		if(password_verify($password, $response -> fetch_assoc()))
        		{
        			return true;
        		}
        		else
        		{
        			return false;
        		}
        		return true;
        }
        else
        {
            return false;
        }
    }

		
  	// check password
    //return false if not valid


function doRegister($username,$password)
{
    // lookup username in databas
        $mydb = new mysqli('127.0.0.1', 'dbusername', 'dbpassword', 'dbname');

        if ($mydb->errno !=0){
                echo "Fail to connect DB: ".$mydb->error.PHP_EOL;
                exit(0);}
        echo "Connected to DB";


}


function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
	    return doLogin($request['username'],$request['password']);
    case "register":
      return doRegister($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>
