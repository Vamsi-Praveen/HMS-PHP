<?php
include_once('../config/dbConfig.php');

$res = [];

$subquery = "SELECT 'A' AS block UNION ALL
             SELECT 'B' UNION ALL
             SELECT 'C' UNION ALL
             SELECT 'D' UNION ALL
             SELECT 'E' UNION ALL
             SELECT 'F'";

$stmtSubquery = $conn->prepare($subquery);
$stmtSubquery->execute();
$resultSubquery = $stmtSubquery->get_result();

// Query to get count of students for each block, including blocks with no students
$query = "SELECT b.block, IFNULL(s.student_count, 0) AS student_count
          FROM ($subquery) b
          LEFT JOIN (
              SELECT block, COUNT(*) AS student_count
              FROM students
              GROUP BY block
          ) s ON b.block = s.block";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $res[$row['block']] = $row['student_count'];
    }
}


echo json_encode($res);
?>
