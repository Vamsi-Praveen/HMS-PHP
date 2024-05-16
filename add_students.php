<?php 
session_start();
$title = "Add Student";
include('./includes/header.php');
?>

<?php
include_once('./config/dbConfig.php');
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $college = $_POST['college'];
    $branch = $_POST['branch'];
    $block = $_POST['block'];
    $roomno = $_POST['roomno'];
    $mobile = $_POST['mobile'];
    $parentMobile = $_POST['parentMobile'];

    $query = "INSERT INTO STUDENTS (rollno,name,email,college,branch,block,roomno,mobile,parent_mobile) values('$rollno','$name','$email','$college','$branch','$block','$roomno','$mobile','$parentMobile');";

    $result = mysqli_query($conn,$query);

    if($result){
        echo "<script>alert('Added Sucessfully')</script>";
    }
    else
    {
        echo "<script>alert('Error Occured')</script>";   
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
                <h1 class="h3 mb-4 text-gray-800">Add Student</h1>

                <div class="row">

                    <div class="col-lg-8">

                        <!-- Student card -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Enter Details to Add New Student</h6>
                            </div>
                            <div class="card-body">
                             <form action="add_students.php" method="post" id="student-form">
                                 <div class="col-lg-10">
                                     <div class="mb-2">
                                      <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                      <input type="email" class="form-control" id="exampleFormControlInput1" name="email">
                                  </div>
                                  <div class="mb-2">
                                      <label for="exampleFormControlInput1" class="form-label">Name</label>
                                      <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
                                  </div>
                                  <div class="mb-3">
                                      <label for="exampleFormControlInput1" class="form-label">Roll No</label>
                                      <input type="text" class="form-control" id="exampleFormControlInput1" name="rollno">
                                  </div>
                                  <div class="mb-3 d-flex flex-column">
                                    <label class="form-label">College</label>
                                    <select name="college" class="form-select p-1">
                                        <option selected>Select College</option>
                                        <option value="AEC">AEC</option>
                                        <option value="ACOE">ACOE</option>
                                        <option value="ACET">ACET</option>
                                    </select>
                                </div>
                                 <div class="mb-3 d-flex flex-column">
                                    <label class="form-label">Year</label>
                                    <select name="year" class="form-select p-1">
                                        <option selected>Select Year</option>
                                        <option value="I">1</option>
                                        <option value="II">2</option>
                                        <option value="III">3</option>
                                        <option value="IV">4</option>
                                    </select>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label class="form-label">Branch</label>
                                    <select name="branch" class="form-select p-1">
                                        <option selected>Select Branch</option>
                                        <option value="CSE">CSE</option>
                                        <option value="IT">IT</option>
                                        <option value="ECE">ECE</option>
                                        <option value="AIML">AIML</option>
                                        <option value="CIVIL">CIVIL</option>
                                        <option value="MECH">MECH</option>
                                        <option value="PT">PT</option>
                                    </select>
                                </div>
                                
                                <div class="mb-2 d-flex flex-column">
                                    <label class="form-label">Block</label>
                                    <select name="block" class="form-select p-1">
                                        <option selected>Select Block</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                  <label for="exampleFormControlInput1" class="form-label">Room No</label>
                                  <input type="text" class="form-control" id="exampleFormControlInput1" name="roomno">
                              </div>
                               <div class="mb-3">
                                  <label for="exampleFormControlInput1" class="form-label">Student Mobile Number</label>
                                  <input type="text" class="form-control" id="exampleFormControlInput1" name="mobile">
                              </div>
                               <div class="mb-3">
                                  <label for="exampleFormControlInput1" class="form-label">Parent Mobile Number</label>
                                  <input type="text" class="form-control" id="exampleFormControlInput1" name="parentMobile">
                              </div>
                              <div>
                                <button class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </div>
                    </form>
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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("student-form").addEventListener("submit", function(event) {
            var formData = new FormData(this);
            if (formData.get("email").trim() === "" || formData.get("name").trim() === "" || formData.get("rollno").trim() === "" || formData.get("college") === "Select College" || formData.get("branch") === "Select Branch" || formData.get("block") === "Select Block" || formData.get("roomno").trim() === "") {
                alert("Please fill in all required fields.");
                event.preventDefault(); // Prevent form submission
            } else if (!isValidEmail(formData.get("email").trim())) {
                alert("Please enter a valid email address.");
                event.preventDefault(); // Prevent form submission
            }
        });
    });

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
</script>


<!-- Logout Modal-->
<?php include("./includes/logoutModal.php")?>
<?php include("./includes/footer.php")?>