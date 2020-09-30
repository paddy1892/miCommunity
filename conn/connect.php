<?php

//connect to DB
$user = "pmccarney03";
$webserver="localhost";

include('password.php');

//database name for MySQL
$db = "pmccarney03";
        
$conn = mysqli_connect($webserver, $user, $password, $db);

if(!$conn){
    die("Connection failed:".mysqli_connect_error());
}





