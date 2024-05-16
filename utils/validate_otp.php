<?php
include_once('../config/dbConfig.php');

if(isset($_POST['otp']) && isset($_POST['rollno'])){
	$otp = $_POST['otp'];
	$rollno = $_POST['rollno'];
	$query = "SELECT * FROM gatepass_otp 
	WHERE rollno = '$rollno' 
	AND NOW() < STR_TO_DATE(expiryTime, '%h:%i:%s%p')
	ORDER BY STR_TO_DATE(expiryTime, '%h:%i:%s%p') ASC
	LIMIT 1;"
	;
	$valid = false;
	$result = mysqli_query($conn,$query);
	if($result && mysqli_num_rows($result)>0){
		$data = mysqli_fetch_assoc($result);
		if($data['otp'] == $otp){
			$valid = true;
			echo $valid;
		}
		else
		{
			echo $valid;
		}
	}
}


?>