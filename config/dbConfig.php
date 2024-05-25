<?php
    $server_address = "127.0.0.1:3307";
    $username = "root";
    $password = "";
    $database = "hms";

    try {
        $conn = mysqli_connect($server_address,$username,$password,$database);
        if(!$conn){
            echo "Database Connection failed";
            exit();
        }
    } catch (Exception $e) {
        echo 'Db Connection failed';
    }
?>