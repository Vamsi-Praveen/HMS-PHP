<?php
include_once('../config/dbConfig.php');

$res = [];

// Subquery to generate all block names you're interested in
$subquery = "SELECT 'A' AS block UNION ALL
             SELECT 'B' UNION ALL
             SELECT 'C' UNION ALL
             SELECT 'D' UNION ALL
             SELECT 'E' UNION ALL
             SELECT 'F'";

// Query to get count of students for each block, including blocks with no students
$query = "SELECT b.block, IFNULL(s.student_count, 0) AS student_count
          FROM ($subquery) b
          LEFT JOIN (
              SELECT block, COUNT(*) AS student_count
              FROM students
              GROUP BY block
          ) s ON b.block = s.block";

$result = mysqli_query($conn, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Store the count for each block in the $res array
        $res[$row['block']] = $row['student_count'];
    }
}

// Return counts as JSON
echo json_encode($res);
?>
