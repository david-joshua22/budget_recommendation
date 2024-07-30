<?php
    $server_name = "localhost";
    $db_name = "webpage";
    $username = "root";
    $password = "";
    $conn  = new mysqli($server_name,$username,$password,$db_name,3306);

    if($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }
?>