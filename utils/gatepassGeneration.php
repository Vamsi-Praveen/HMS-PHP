<?php
include_once('../config/dbConfig.php');
function generateGatePassID($conn) {
	$query = "SELECT MAX(id) AS max_id FROM gatepass";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$max_id = $row['max_id'];
	$next_id = $max_id + 1;
	return "GP" . $next_id;
}
if(isset($_POST['student_details'])){
	$student_details = json_decode($_POST['student_details'], true);
	$reason = $_POST['reason'];
	$transport = $_POST['transport'];
	$startdate = $_POST['startdate'];
	$enddate = $_POST['enddate'];
	$place = $_POST['place'];
	$gatepassid = generateGatePassID($conn);

	$query = "INSERT INTO gatepass (passid,rollno,name,year,branch,college,block,roomno,reason,place,startdate,enddate,transport_type,parent_mobile) 
	VALUES ('$gatepassid','{$student_details['rollno']}','{$student_details['name']}','{$student_details['year']}',
		'{$student_details['branch']}','{$student_details['college']}','{$student_details['block']}',
		'{$student_details['roomno']}','$reason','$place','$startdate','$enddate','$transport','{$student_details['parent_mobile']}')";
	$result = mysqli_query($conn,$query);
	if($result){
		$data = array(
			'gatepassid' => $gatepassid,
			'student_details' => $student_details,
			'reason' => $reason,
			'place' => $place,
			'startdate' => $startdate,
			'enddate' => $enddate,
			'transport' => $transport
		);
		echo json_encode($data);
		return;
		
	} 
}
?>