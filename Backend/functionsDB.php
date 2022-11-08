<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('RabMQClient.php');
require_once('DBConnect.php');

    //check if username is taken
    function VerifyUsername($username){
        
        $connection = connectDB();
        
        $check_username = "SELECT * FROM user WHERE username = '$username'";
        $response = $connection->query($check_username);
        
        if($response){
            if($response->num_rows == 0){
                return true;
            }else if($response->num_rows == 1){
                return false;
                }
        }
    }

    //check if email is taken
    function VerifyEmail($email){
        
        $connection = connectDB();
        
        $check_email = "SELECT * FROM user WHERE email = '$email'";
        $response = $connection->query($check_email);
        
        if($response){
            if($response->num_rows == 0){
                return true;
            }else if($response->num_rows == 1){
                return false;
                }
        }
    }

    function Register($first_name, $last_name, $email, $username, $height, $weight, $password){
        
        //hashes password
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);

        //Makes connection to database
        $connection = connectDB();
        
        
        //Query for a new user
        $newuser_query = "INSERT INTO user VALUES ('$first_name', '$last_name', '$email', '$username', '$height', '$weight', '$hash_pass')";
        
        $result = $connection->query($newuser_query);
        
        return true;
    }

    function doLogin($username, $password){
        $connection = connectDB();
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
?>