<?php
	include_once('./config/dbConfig.php');
	include('./utils/functions.php');

	if(isset($_GET['rollno'])){
		$rollno = decrypt_data($_GET['rollno']);

		$query = "DELETE FROM students WHERE rollno = '$rollno'";

		$result = mysqli_query($conn,$query);

		if(!$result){
			echo "Error ".mysqli_error($conn);
		}

	}


?>