<?php 
session_start();
$title = "Add Staff";
include('./includes/header.php');
?>

<?php
include_once('./config/dbConfig.php');

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $name = $_POST['name'];
    $empid = $_POST['empid'];
    $college = $_POST['college'];
    $designation = $_POST['designation'];
    $block = $_POST['block'];
    $roomno = $_POST['roomno'];
    $mobile = $_POST['mobile'];
    $department = $_POST['department'];

    $query = "INSERT INTO staff (empid, name, email, college, department, designation, block, roomno, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("sssssssss", $empid, $name, $email, $college, $department,$designation, $block, $roomno, $mobile);

    $result = $stmt->execute();
    $stmt->close();
    if($result){
        echo "<script>alert('Added Successfully')</script>";
    } else {
        echo "<script>alert('Error Occurred')</script>";   
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
                <h1 class="h3 mb-4 text-gray-800">Add Staff</h1>

                <div class="row">

                    <div class="col-lg-8">

                        <!-- Student card -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Enter Details to Add New Staff</h6>
                            </div>
                            <div class="card-body">
                             <form action="add_staff.php" method="post" id="student-form">
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
                                      <label for="exampleFormControlInput1" class="form-label">Emp Id</label>
                                      <input type="text" class="form-control" id="exampleFormControlInput1" name="empid">
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
                                    <label class="form-label">Department</label>
                                    <select name="department" class="form-select p-1">
                                        <option selected>Select Dept.</option>
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
                                 <div class="mb-2 d-flex flex-column">
                                    <label class="form-label">Designation</label>
                                    <select name="designation" class="form-select p-1">
                                        <option selected>Select Designation</option>
                                        <option value="Asst.Professor">Asst. Professor</option>
                                        <option value="Lecturer">Lecturer</option>
                                        <option value="Jr.Lecturer">Jr.Lecturer</option>
                                        <option value="Lab Assistant">Lab Assistant</option>
                                        <option value="Other">Other</option>

                                    </select>
                                </div>
                                <div class="mb-3">
                                  <label for="exampleFormControlInput1" class="form-label">Room No</label>
                                  <input type="text" class="form-control" id="exampleFormControlInput1" name="roomno">
                              </div>
                               <div class="mb-3">
                                  <label for="exampleFormControlInput1" class="form-label">Staff Mobile Number</label>
                                  <input type="text" class="form-control" id="exampleFormControlInput1" name="mobile">
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
            if (formData.get("email").trim() === "" || formData.get("name").trim() === "" || formData.get("empid").trim() === "" || formData.get("college") === "Select College" || formData.get("department") === "Select Dept." || formData.get("block") === "Select Block" || formData.get("roomno").trim() === "" || formData.get("designation") === "Select Designation" ) {
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