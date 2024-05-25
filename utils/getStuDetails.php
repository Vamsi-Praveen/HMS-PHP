<?php
session_start();
include_once('../config/dbConfig.php');

if(isset($_POST['rollno'])){
    $rollno = $_POST['rollno'];

    $stmt = $conn->prepare("SELECT * FROM students WHERE rollno = ?");

    $stmt->bind_param("s",$rollno);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows == 0) {
        echo json_encode(array('error' => 'No Student Found'));
    } else {
        $res = $result->fetch_assoc();
        echo json_encode($res);
    }
    $stmt->close();
}
?>