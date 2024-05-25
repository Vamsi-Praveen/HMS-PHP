<?php
include_once('../config/dbConfig.php');

if(isset($_POST['otp']) && isset($_POST['rollno'])){
    $otp = $_POST['otp'];
    $rollno = $_POST['rollno'];

    $query = "SELECT * FROM gatepass_otp 
              WHERE rollno = ? 
              AND NOW() < STR_TO_DATE(expiryTime, '%h:%i:%s%p')
              ORDER BY STR_TO_DATE(expiryTime, '%h:%i:%s%p') ASC
              LIMIT 1";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("s", $rollno);

    $stmt->execute();

    $result = $stmt->get_result();

    $stmt->close();

    if($result && $result->num_rows > 0){
        $data = $result->fetch_assoc();
        if($data['otp'] == $otp){
            echo json_encode(array('valid' => true));
        }
        else {
            echo json_encode(array('valid' => false));
        }
    }
    else {
        echo json_encode(array('valid' => false));
    }
}
?>
