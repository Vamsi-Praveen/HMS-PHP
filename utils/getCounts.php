<?php
include_once('../config/dbConfig.php');

$res = [];

// Query to get count of students
$query = "SELECT COUNT(*) AS student_count FROM students";
$result = mysqli_query($conn, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $res['student_count'] = $row['student_count'];
}

// Query to get count of gate passes
$query = "SELECT COUNT(*) AS gatepass_count FROM gatepass";
$result = mysqli_query($conn, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $res['gatepass_count'] = $row['gatepass_count'];
}

// Return counts as JSON
echo json_encode($res);
?>
