<?php

//Establishes connection to Main MySQL database
function dbConnection(){
    $connection = mysqli_connect('database-1.c8lwib2uf0za.us-east-1.rds.amazonaws.com', 'admin', 'fefefefe', 'yfoodAppDB');
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else{
        echo"Successfully connected to main database!";
    }
    return $connection;
}

//Established connection to backup MySQL database
function dbConnection2(){
    $connection2 = mysqli_connect('db1.c9xt0orcdsxi.us-east-1.rds.amazonaws.com', 'admin', 'Group#05', 'YFOOD490');
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else{
        echo"Successfully connected to backup database!";
    }
    return $connection2;
}


