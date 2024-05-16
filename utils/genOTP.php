<?php
include_once('../config/dbConfig.php');
if (isset($_POST['rollno'])) {
    $rollno = $_POST['rollno'];
    $otpGen = generateOTP();
    date_default_timezone_set('Asia/Kolkata');
    $current_time = time();
    $time_now = date('h:i:sa',$current_time);
    $expiryTime = strtotime('+10minutes',$current_time);
    $exipryTimeFormated = date('h:i:sa',$expiryTime);
    echo $exipryTimeFormated;
    $query = "INSERT INTO gatepass_otp(rollno,otp,time_now,expiryTime) values('$rollno','$otpGen','$time_now','$exipryTimeFormated');";
    $result = mysqli_query($conn,$query);
    if($result){
        echo "otp send successfully";
    }
    else
    {
        echo "otp send failed";
        exit();
    }

}
function generateOTP(){
    $otp = rand(1000,9999);
    return $otp;
}
?>
