<?php
include_once('../config/dbConfig.php');

$res = [];

// Query to get count of students
$query = "SELECT COUNT(*) AS student_count FROM students";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
if ($result) {
    $row = $result->fetch_assoc();
    $res['student_count'] = $row['student_count'];
}

// Query to get count of gate passes
$query = "SELECT COUNT(*) AS gatepass_count FROM gatepass";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
if ($result) {
    $row = $result->fetch_assoc();
    $res['gatepass_count'] = $row['gatepass_count'];
}

$stmt->close();
echo json_encode($res);
?>
