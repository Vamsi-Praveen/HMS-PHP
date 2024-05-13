<?php
session_start();
$title = "View Gate Pass";
$bodyColor = "bg-light";
include('./includes/header.php');

$student_details = json_decode(urldecode($_GET['data']), true);
?>

<div class='container mt-4 col-lg-5'>
    <div class="card shadow-sm">
        <h1 class='card-header text-center'>Gate Pass</h1>
        <div class="card-body d-flex flex-column justify-content-center">
            <div class="d-flex">
                <div class="mr-5">
                    <p class="card-text"><strong>Gate Pass ID:</strong> <?php echo $student_details['gatepassid'] ?></p>
                    <p class="card-text"><strong>Name:</strong> <?php echo $student_details['student_details']['name']; ?></p>
                    <p class="card-text"><strong>Roll No:</strong> <?php echo $student_details['student_details']['rollno']; ?></p>
                    <p class="card-text"><strong>Year/Branch:</strong> <?php echo $student_details['student_details']['year']; ?>/<?php echo $student_details['student_details']['branch']; ?></p>
                    <p class="card-text"><strong>Room No:</strong> <?php echo $student_details['student_details']['block']; ?>-<?php echo $student_details['student_details']['roomno']; ?></p>

                </div>
                <div>
                    <p class="card-text"><strong>Reason:</strong> <?php echo $student_details['reason']; ?></p>
                    <p class="card-text"><strong>Place:</strong> <?php echo $student_details['place']; ?></p>
                    <p class="card-text"><strong>Start Date:</strong> <?php echo $student_details['startdate']; ?></p>
                    <p class="card-text"><strong>End Date:</strong> <?php echo $student_details['enddate']; ?></p>
                    <p class="card-text"><strong>Transport Type:</strong> <?php echo $student_details['transport']; ?></p>
                </div>
            </div>
            <div class="mt-4">
                <p>Sign of Security Guard : </p>
            </div>
        </div>

    </div>
    <button class="btn btn-primary mt-5" onclick="printFn()">Print</button>
</div>

<script>
    function printFn(){
        window.print();
        window.location.href = "gatepass.php";
    }
</script>


<?php include('./includes/footer.php') ?>
