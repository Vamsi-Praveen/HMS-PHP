<?php
session_start();
include_once('../config/dbConfig.php');

if(isset($_POST['rollno'])){
    $rollno = $_POST['rollno'];

    $query = "SELECT * FROM students WHERE rollno = '$rollno'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 0) {
        echo json_encode(array('error' => 'No Student Found'));
    } else {
        $res = mysqli_fetch_assoc($result);
        echo json_encode($res);
    }
}
?>