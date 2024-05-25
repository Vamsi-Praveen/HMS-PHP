<?php
session_start();
$title = "Gate Pass";
include('./includes/header.php');
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
                <div id="details" style="display: none;">
                    <div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card shadow my-2">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                                    </div>
                                    <div class="card-body">
                                        <form id="gatepassForm">
                                            <input type="hidden" name="student_details" id="student_details"/>
                                            <div>
                                                <div class="d-flex mb-2">
                                                    <span class="mr-2">Name :</span>
                                                    <h6 class="text-gray-800 font-weight-bold" id="name"></h6>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <span class="mr-2">RollNo :</span>
                                                    <h6 class="text-gray-800 font-weight-bold" id="rollno_display"></h6>
                                                </div>
                                                <div class="d-flex mb-2">
                                                    <span class="mr-2 m-0 p-0">Room No :</span>
                                                    <h6 class="m-0 p-0 text-gray-800 font-weight-bold" id="roomno"></h6>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="d-flex mb-2 mr-2">
                                                        <span class="mr-2">College :</span>
                                                        <h6 class="m-0 p-0 text-gray-800 font-weight-bold" id="college"></h6>
                                                    </div>
                                                    <div class="d-flex mb-2 mr-2 align-items-center">
                                                        <span class="mr-2 m-0 p-0">Year/Branch :</span>
                                                        <h6 class="m-0 p-0 text-gray-800 font-weight-bold" id="branch"></h6>
                                                    </div>
                                                </div>
                                                <div class="d-flex mb-2 mr-2 alin-items-center">
                                                    <span class="mr-2 m-0 p-0">Parent Number :</span>
                                                    <h6 class="m-0 p-0 text-gray-800 font-weight-bold" id="parentMobile"></h6>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <div class="mb-3">
                                                    <label for="reason" class="form-label">Reason</label>
                                                    <input type="text" class="form-control" id="reason" name="reason">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="place" class="form-label">Place</label>
                                                    <input type="text" class="form-control" id="place" name="place">
                                                </div>
                                                <div class="mb-3 row ml-1">
                                                    <div class="mr-2">
                                                        <label>Start Date</label>
                                                        <input type="date" name="startdate" id="startdate">
                                                    </div>
                                                    <div>
                                                        <label>End Date</label>
                                                        <input type="date" name="enddate" id="enddate">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label>Transport Type</label>
                                                    <select name="transport" id="transport">
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
                </div>
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


<script src="vendor/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#getdetails').click(function(){
            const rollno = $('#rollno').val().trim();
            if(rollno == ""){
                alert('Provide Roll No');
                return;
            }
            $.ajax({
                url:'utils/getStuDetails.php',
                type:'POST',
                data:{rollno:rollno},
                success: function(response){
                    if(JSON.parse(response).error == "No Student Found"){
                        $('#details').hide();
                        alert("No Student Found");
                        return;
                    }
                    const result = JSON.parse(response);
                    $('#student_details').val(JSON.stringify(result));
                    $('#name').text(result.name);
                    $('#rollno_display').text(result?.rollno);
                    $('#roomno').text(result.block + "-" + result.roomno);
                    $('#college').text(result.college);
                    $('#branch').text(result.year + "/" + result.branch);
                    $('#parentMobile').text(result.parent_mobile);
                    $("#details").show();
                }
            })
        })

        $("#send-otp").click(function(e){
            e.preventDefault();
            const rollno = $('#rollno').val().trim();
            $.ajax({
                url:'utils/genOTP.php',
                type:'POST',
                data:{
                    rollno:rollno
                },
                success:function(response){
                    alert('OTP sent successful');
                    return;
                }
            })
        })

        $("#gatepassForm").submit(function(e){
            e.preventDefault();
            const otpEntered = $('#otp-input').val().trim();
            if(otpEntered==''){
                return alert('Please enter OTP');
            }
            $.ajax({
                url:'utils/validate_otp.php',
                type:"POST",
                data:{
                    rollno:$('#rollno').val(),
                    otp:otpEntered
                },
                success:function(response){
                    const result = JSON.parse(response)
                    if(result.valid == false){
                        alert('Invalid OTP')
                        return;
                    }
                    else
                    {
                        $.ajax({
                            url:'utils/gatepassGeneration.php',
                            data:$('#gatepassForm').serialize(),
                            type:'POST',
                            success:function(response){
                               return window.location.href = 'viewGatepass.php?data='+ encodeURIComponent(response)
                            },
                            error:function(e){
                                alert('Error Occured');
                                console.log(e)
                            }
                        })
                    }
                }
            })
        })      
    })
</script>

<!-- Logout Modal-->
<?php include('./includes/logoutModal.php')?>
<?php include('./includes/footer.php')?>
