<?php
include_once('../config/dbConfig.php');

function generateGatePassID($conn) {
	$stmt = $conn->prepare("SELECT MAX(id) AS max_id FROM gatepass");
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();
	$max_id = $row['max_id'];
	$next_id = $max_id + 1;
	$stmt->close();
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


	$stmt = $conn->prepare("INSERT INTO gatepass (passid,rollno,name,year,branch,college,block,roomno,reason,place,startdate,enddate,transport_type,parent_mobile) 
		VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

	$stmt->bind_param("ssssssssssssss", 
		$gatepassid,
		$student_details['rollno'],
		$student_details['name'],
		$student_details['year'],
		$student_details['branch'],
		$student_details['college'],
		$student_details['block'],
		$student_details['roomno'],
		$reason,
		$place,
		$startdate,
		$enddate,
		$transport,
		$student_details['parent_mobile']
	);
	$stmt->execute();
	$stmt->close();
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
}
?>