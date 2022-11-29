<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbConnection.php');

//function that logs in user
function doLogin($username, $password){
  $conn = dbConnection();
  $query = "select password from users where username = '$username';";
  $response = $conn->query($query);
  $Array = $response -> fetch_assoc();
  $hashpass = $Array["password"];
  if ($response->num_rows == 1){
    if(password_verify($password, $hashpass))
    {
      echo "\n Password correct";
      return true;
    }
    else
    {
      echo "\n Password incorrect";
      return false;
    }
  echo "/n Login Successful";
  return true;
  }
  else
  {
    echo "/n Login information incorrect";
    return false;
  }
}

//Function that registers new users
function doRegister($username, $password, $firstname, $lastname, $email, $gender)
{
    $conn = dbConnection();
    $conn2 = dbConnection2();
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM `users` WHERE username='$username'";
    $result = $conn->query($query);
    if ($result->num_rows == 1) 
    {
      echo "\n***Username already in use***";
      return false;
    }
   	
    $insert = "INSERT INTO `users` (username, password, firstname, lastname, email, gender) 
  			  VALUES('$username', '$password', '$firstname', '$lastname', '$email', '$gender')";
    
    if ($conn->query($insert)) {
        echo "\n***New record created successfully***";
    } 
    else {
      echo "\n Error for main: " . $insert . "<br>" . $conn->error;
	    return false; 
    }

    if ($conn2->query($insert)) {
      echo "\n***New backup created successfully***";
    } 
    else {
      echo "\n Error for backup: " . $insert . "<br>" . $conn2->error;
      return false; 
    }
    return true;
}
?>