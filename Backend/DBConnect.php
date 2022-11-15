<?php

    //Establishes connection to MySQL database
    function connectDB(){
        
        $hostname = '127.0.0.1';
        $user = 'yfoodAdmin';
        $pass = 'fefefefe';
        $dbname = 'yfoodDatabase';
        
        $connection = mysqli_connect($hostname, $user, $pass, $dbname);
        
        if (!$connection){
            echo "Unable to connect to database: ".$connection->connect_errno.PHP_EOL;
            exit(1);
        }
        echo "Connection successfully establish".PHP_EOL;
        return $connection;
    }
    
?>