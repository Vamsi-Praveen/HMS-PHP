<?php
session_start();
$title = "Gate Pass";
include('./includes/header.php');
include_once('./config/dbConfig.php');
?>
<?php
function generateGatePassID($conn) {
    $query = "SELECT MAX(id) AS max_id FROM gatepass";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $max_id = $row['max_id'];
    $next_id = $max_id + 1;
    return "GP" . $next_id;
}
if(isset($_POST['submit'])){
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
            // Encode the data as JSON
       $json_data = json_encode($data);
       header("Location: viewGatePass.php?data=" . urlencode($json_data));
       exit();
   } else {
    echo "<script>alert('Error')</script>";
    header("Location: gatepass.php");
    exit();
}
}

?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include('./includes/sidebar.php')?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include('./includes/navbar.php')?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Gate Pass</h1>
                <div>
                    <div class="row">

                        <div class="col-lg-8">

                            <!-- Student card -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Enter Roll No</h6>
                                </div>
                                <div class="card-body">
                                 <div class="col-lg-10">
                                     <div class="mb-2">
                                        <label for="exampleFormControlInput1" class="form-label">Roll No</label>
                                        <input type="text" class="form-control" id="rollno" name="rollno">
                                        <button class="btn btn-primary mt-2" name="getdetails" id="getdetails">Get Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- details -->
                <div id="details"></div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("getdetails").addEventListener("click", function(event) {
            var input = document.getElementById('rollno');
            if (input.value.trim() === "") {
                alert("Please fill in all required fields.");
                event.preventDefault(); // Prevent form submission
            }
            else
            {
                const detailsDiv = document.getElementById('details');
                const xhr = new XMLHttpRequest();
                xhr.open('post','./utils/getStuDetails.php',true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange  = function(){
                    if(xhr.readyState == 4 && xhr.status == 200){
                        var response = JSON.parse(xhr.responseText);
                        if(response?.error){
                            alert(response?.error);
                        }else{
                            detailsDiv.innerHTML = `

                            <div>
                            <div class="row">
                            <div class="col-lg-8">
                            <div class="card shadow my-2">
                            <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                            </div>
                            <div class="card-body">
                            <form action="gatepass.php" method="post" id="gatepassForm">
                            <input type="hidden" name="student_details" value='${JSON.stringify(response)}'/>
                            <div>
                            <div class="d-flex mb-2">
                            <span class="mr-2">Name :</span>
                            <h6 class="text-gray-800 font-weight-bold">${response?.name}</h6>
                            </div>
                            <div class="d-flex mb-2">
                            <span class="mr-2">RollNo :</span>
                            <h6 class="text-gray-800 font-weight-bold">${response?.rollno}</h6>
                            </div>
                            <div class="d-flex mb-2">
                            <span class="mr-2 m-0 p-0">Room No :</span>
                            <h6 class="m-0 p-0 text-gray-800 font-weight-bold">${response?.block}-${response?.roomno}</h6>
                            </div>
                            <div class="d-flex">
                            <div class="d-flex mb-2 mr-2">
                            <span class="mr-2">College :</span>
                            <h6 class="m-0 p-0 text-gray-800 font-weight-bold">${response?.college}</h6>
                            </div>
                            <div class="d-flex mb-2 mr-2 align-items-center">
                            <span class="mr-2 m-0 p-0">Year/Branch :</span>
                            <h6 class="m-0 p-0 text-gray-800 font-weight-bold">${response?.year}/${response?.branch}</h6>
                            </div>
                            </div>
                            <div class="d-flex mb-2 mr-2 alin-items-center">
                            <span class="mr-2 m-0 p-0">Parent Number :</span>
                            <h6 class="m-0 p-0 text-gray-800 font-weight-bold">${response?.parent_mobile}</h6>
                            </div>
                            </div>
                            <div class="mt-2">
                            <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Reason</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="reason">
                            </div>
                            <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Place</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="place">
                            </div>
                            <div class="mb-3 row ml-1">
                            <div class="mr-2">
                            <label>Start Date</label>
                            <input type="date" name="startdate">
                            </div>
                            <div>
                            <label>End Date</label>
                            <input type="date" name="enddate">
                            </div>
                            </div>
                            <div>
                            <label>Transport Type</label>
                            <select name="transport">
                            <option value="own">Own</option>
                            <option value="collegebus">College Bus</option>
                            </select>
                            </div>
                            </div>
                            <div class="mt-2 d-flex">
                            <button class="btn btn-success mr-2" id="send-otp">Send OTP</button>
                            <div>
                            <input type="text" class="form-control" id="otp-input" name="otp-input" placeholder="Enter OTP">
                            </div>
                            </div>
                            <div class="mt-2">
                            <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                            </div>
                            </div>
                            </form>
                            </div>
                            </div>
                            </div>
                            </div>
                            `
                            document.getElementById('send-otp').addEventListener('click',function(e){
                                e.preventDefault();
                                const xhr_new = new XMLHttpRequest();
                                xhr_new.open('POST','./utils/genOTP.php',true);
                                xhr_new.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr_new.onreadystatechange = function(){
                                    if(xhr_new.readyState == 4 && xhr_new.status == 200){
                                        alert('Otp sent successful');
                                    }
                                }
                                xhr_new.send("rollno="+response?.rollno);
                            })


                            document.getElementById('gatepassForm').addEventListener('submit', function(e) {
                                e.preventDefault();
                                const otp = document.getElementById("otp-input").value;
                                const rollno = response?.rollno;
                                const xhr_validate = new XMLHttpRequest();
                                xhr_validate.open('POST','./utils/validate_otp.php',true);
                                xhr_validate.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                xhr_validate.onreadystatechange = function(){
                                    if(xhr_validate.readyState == 4 && xhr_validate.status == 200){
                                        const responseData  = xhr_validate.responseText;
                                        if(responseData == 1){
                                            document.getElementById('gatepassForm').submit();
                                        }
                                        else{
                                            alert('Invalid Otp');
                                        }
                                    }
                                };
                                xhr_validate.send("rollno="+rollno+"&otp="+otp);
                            });

                        }
                    }
                }
                xhr.send("rollno="+input.value);
            }
        });
});

</script>

<!-- Logout Modal-->
<?php include('./includes/logoutModal.php')?>
<?php include('./includes/footer.php')?>