<?php
include_once('./config/dbConfig.php');
include('./utils/functions.php');


if(isset($_GET['p'])){
    $type = $_GET['p'];
    if($type == 'student'){
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
    }
    elseif($type == 'staff')
    {
        if(isset($_GET['empid'])){
            $empid = decrypt_data($_GET['empid']);

            $query = "DELETE FROM staff WHERE empid = ?";

            $stmt = $conn->prepare($query);

            $stmt->bind_param("s", $empid);

            $result = $stmt->execute();

            $stmt->close();
            if(!$result){
                echo "Error " . $stmt->error;
            }
        }
    }
}




?>
