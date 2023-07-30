<?php 
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "phpecom";

    //Creating database connection
    $con = mysqli_connect($host,$username,$password,$database);

    //Check database
    if(!$con){
        die("connection failed:".mysqli_connect_error());
    }
?>