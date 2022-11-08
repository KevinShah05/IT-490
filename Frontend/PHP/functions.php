<?php

    //Required Files
    require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    //Check is user is logged in and if not send them to login page
    function gateway(){
        if (!$_SESSION["logged"]){
            header("Location: ../HTML-CSS/login.html");
        }
    }

    //Send login request to RabbitMQ
    function login($username, $password){
        
        $request = array();
        
        $request['type'] = "Login";
        $request['username'] = $username;
        $request['password'] = $password;

        $returnedValue = createClientDB($request);
        
        if($returnedValue == 1){
            $_SESSION["username"] = $username;
            $_SESSION["logged"] = true;
        }else{
            session_destroy();
        }
       
        return $returnedValue;
    }

    //Send the register request to RabbitMQ
    function register($firstname, $lastname, $username, $email, $password, $height, $weight){
        
        $request = array();
        
        $request['type'] = "Register";
        $request['firstname'] = $firstname;
        $request['lastname'] = $lastname;
        $request['email'] = $email;
        $request['username'] = $username;
        $request['height'] = $height;
        $request['weight'] = $weight;
        $request['password'] = $password;


        $returnedValue = createClientDB($request);

        return $returnedValue;
    }

    //Check if user exists already
    function uNameVerifiy($username){
        
        $request = array();
        
        $request['type'] = "CheckUsername";
        $request['username'] = $username;

        $returnedValue = createClientDB($request);

        return $returnedValue;
    } 

    //Check if email exists
    function emailVerifiy($email){
        
        $request = array();
        
        $request['type'] = "CheckEmail";
        $request['email'] = $email;

        $returnedValue = createClientDB($request);

        return $returnedValue;
    } 
?>