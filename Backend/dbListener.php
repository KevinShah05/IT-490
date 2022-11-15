<?php

require_once('../RabbitMQ/path.inc');
require_once('../RabbitMQ/get_host_info.inc');
require_once('../RabbitMQ/rabbitMQLib.inc');
require_once('functionsDB.php');


    function requestProcessor($request){
        echo "received request".PHP_EOL;
        echo $request['type'];
        var_dump($request);
        
        if(!isset($request['type'])){
            return array('message'=>"ERROR: Message type is not supported");
        }
        switch($request['type']){
                
            //Verify Username
            case "VerifyUsername":
                echo "<br>VerifyUsername";
                $response_msg = VerifyUsername($request['username']);
                break;
                
            //Verify Email
            case "VerifyEmail":
                echo "<br>in VerifyEmail";
                $response_msg = VerifyEmail($request['email']);
                break;
          
            //Register
            case "Register":
                echo "<br>in Register";
                $response_msg = Register($request['first_name'], $request['last_name'], $request['email'], $request['username'], $request['height'], $request['weight'], $request['password']);
                break;
                
                
            //Login
            case "doLogin":
                echo "<br>in doLogin";
                $response_msg = doLogin($request['username'], $request['password']);
                break;        
        }
        echo $response_msg;
        return $response_msg;
    }

    //creating a new server
    $server = new rabbitMQServer('rabbitMQ_db.ini', 'testServer');
    
    //processes the request sent by client
    $server->process_requests('requestProcessor');
    echo "dbListener END".PHP_EOL;
    exit();

?>