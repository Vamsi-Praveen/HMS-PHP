<?php
include_once('utils/functions.php');
include_once('config/dbConfig.php');
if($_SERVER['REQUEST_METHOD']== 'GET'){
	if(isset($_GET['p']) && isset($_GET['complaint_id']) && isset($_GET['status'])){
		$type = $_GET['status'];
		$complaint = $_GET['complaint_id'];
		for($i = 0 ;$i<strlen($complaint);$i++){
			if($complaint[$i]==" "){
				$complaint[$i]='+';
			}
		}
		$complaintID = decrypt_data($complaint);
		echo $complaintID;
		switch ($type) {
			case 1:
			$query = "UPDATE complaints set status = ? where complaint_id = ?";
			$stmt = $conn->prepare($query);
			$s = 'success';
			$stmt->bind_param('ss',$s,$complaintID);
			$stmt->execute();
			if($stmt->affected_rows == 0){
				echo $stmt->error;
			}
			break;
			case 0:
			$query = "UPDATE complaints set status = ? where complaint_id = ?";
			$stmt = $conn->prepare($query);
			$s = 'rejected';
			$stmt->bind_param('ss',$s,$complaintID);
			$stmt->execute();
			if($stmt->affected_rows == 0){
				echo $stmt->error;
			}
			break;
			default:
			exit();
			break;
		}
	}
	else
	{
		echo "<script>window.location.href='view_details.php?p=complaints'</script>";
	}
}


?>