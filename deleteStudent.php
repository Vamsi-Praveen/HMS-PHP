<?php
include_once('./config/dbConfig.php');
include('./utils/functions.php');

if(isset($_GET['rollno'])){
    $rollno = decrypt_data($_GET['rollno']);

    $query = "DELETE FROM students WHERE rollno = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("s", $rollno);

    $result = $stmt->execute();

    $stmt->close();
    if(!$result){
        echo "Error " . $stmt->error;
    }
}

?>
