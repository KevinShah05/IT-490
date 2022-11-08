<?php

/*Creating new RabbitMQ Client Instances*/ 

require_once('../SeedFiles/path.inc');
require_once('../SeedFiles/get_host_info.inc');
require_once('../SeedFiles/rabbitMQLib.inc');


function createClientDB($request){
  $client = new rabbitMQClient("../SeedFiles/RabbitMQ-DB.ini","testServer");
    
  if (isset($argv[1])){
    $msg = $argv[1];
  }
  else{
    $msg = "client";
  }

  
$response = $client->send_request($request);

return $response;
}

?>