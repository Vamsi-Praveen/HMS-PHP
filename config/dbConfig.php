<?php
    $server_address = "127.0.0.1:3307";
    $username = "root";
    $password = "";
    $database = "hms";

    try {
        $conn = mysqli_connect($server_address,$username,$password,$database);
    } catch (Exception $e) {
        echo 'Db Connection failed';
    }
?>