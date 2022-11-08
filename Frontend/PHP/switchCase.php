<?php

    //Include Required Files
    require_once('../SeedFiles/path.inc');
    require_once('../SeedFiles/get_host_info.inc');
    require_once('../SeedFiles/rabbitMQLib.inc');
    require_once('rabbitMQClient.php');

    //Include Functions
    include("functions.php");
    
    
    //Start Session
    session_start();

    $type = $_GET["type"];

    //Switch-Case is executed depending on the type of request
    switch ($type) {
            
        case "Login":                                      
            
            $username = $_GET["username"];
            $password = $_GET["password"];
            
            $response = login($username, $password);
            echo $response;
            break;
            
        case "RegisterUser":
            
            $firstname = $_GET["firstname"];
            $lastname = $_GET["lastname"];
            $email = $_GET["email"];
            $username = $_GET["username"];
            $height = $_GET["height"];
            $weight = $_GET["weight"];
            $password = $_GET["password"];
            
            $response = register($firstname, $lastname, $email, $username, $height, $weight, $password);
            echo $response;
            break;
            
        case "UsernameVerification":
            
            $username = $_GET["username"];
            
            $response = uNameVerifiy($username);
            echo $response;
            break;
        
        case "EmailVerification":
            
            $email = $_GET["email"];
            
            $response = emailVerifiy($email);
            echo $response;
            break;
    }
?>