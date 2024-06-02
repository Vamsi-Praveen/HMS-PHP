<?php 
session_start();
$title = "Edit Student";
include('./includes/header.php');
?>

<?php
include_once('./config/dbConfig.php');
include('./utils/functions.php');


if(isset($_GET['p'])){
    $type = $_GET['p'];
    if($type == 'student'){

        if(isset($_GET['rollno'])){
            $rollno = $_GET['rollno'];
            for($i = 0 ;$i<strlen($rollno);$i++){
                if($rollno[$i]==" "){
                    $rollno[$i]='+';
                }
            }
            $roll_no = decrypt_data($rollno);

            $stmt = $conn->prepare("select * from students where rollno = ?;");

            $stmt->bind_param('s',$roll_no);

            $stmt->execute();

            $result = $stmt->get_result();

            if($result){
                $row = $result->fetch_assoc();
            }
            $stmt->close();

        }
    }
    elseif($type == 'staff'){
        if(isset($_GET['empid'])){
            $empid = $_GET['empid'];
            for($i = 0 ;$i<strlen($empid);$i++){
                if($empid[$i]==" "){
                    $empid[$i]='+';
                }
            }
            $empId = decrypt_data($empid);

            $stmt = $conn->prepare("select * from staff where empid = ?;");

            $stmt->bind_param('s',$empId);

            $stmt->execute();

            $result = $stmt->get_result();

            if($result){
                $row = $result->fetch_assoc();
            }
            $stmt->close();

        }
    }
}


if(isset($_POST['submit'])){

    if($type == 'student'){
        $email = $_POST['email'];
        $name = $_POST['name'];
        $rollno = $_POST['rollno'];
        $college = $_POST['college'];
        $branch = $_POST['branch'];
        $block = $_POST['block'];
        $year = $_POST['year'];
        $roomno = $_POST['roomno'];
        $mobile = $_POST['mobile'];
        $parentMobile = $_POST['parentMobile'];


        $stmt = $conn->prepare("UPDATE students set name=?,rollno=?,email=?,college=?,branch=?,year=?,block=?,roomno=?,mobile=?,parent_mobile=? where rollno = ?;");

        $stmt->bind_param('sssssssssss',
            $name,
            $rollno,
            $email,
            $college,
            $branch,
            $year,
            $block,
            $roomno,
            $mobile,
            $parentMobile,
            $rollno
        );
        $stmt->execute();

        if($stmt->affected_rows >0){
            echo "<script>alert('Updated Sucessfully')</script>";
            echo "<script>window.location.href='view_details.php?p=student'</script>";
        }
        else
        {
            echo "<script>alert('Error Occured')</script>";  
            echo mysqli_error($conn); 
        }
        $stmt->close();
    }
    elseif($type == 'staff'){
        $email = $_POST['email'];
        $name = $_POST['name'];
        $empid = $_POST['empid'];
        $college = $_POST['college'];
        $block = $_POST['block'];
        $designation = $_POST['designation'];
        $department = $_POST['department'];
        $roomno = $_POST['roomno'];
        $mobile = $_POST['phone'];

        $stmt = $conn->prepare("UPDATE staff set name=?,empid=?,email=?,college=?,department=?,designation=?,block=?,roomno=?,phone=? where empid = ?;");

        $stmt->bind_param('ssssssssss',
            $name,
            $empid,
            $email,
            $college,
            $department,
            $designation,
            $block,
            $roomno,
            $mobile,
            $empid
        );
        $stmt->execute();

        if($stmt->affected_rows >0){
            echo "<script>alert('Updated Sucessfully')</script>";
            echo "<script>window.location.href='view_details.php?p=staff'</script>";
        }
        else
        {
            echo "<script>alert('Error Occured')</script>";  
            echo mysqli_error($conn); 
        }
        $stmt->close();
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
                <?php
                if($type=="student"){
                    ?>

                    <h1 class="h3 mb-4 text-gray-800">Edit Student</h1>

                    <div class="row">

                        <div class="col-lg-8">

                            <!-- Student card -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Enter Updated Details</h6>
                                </div>
                                <div class="card-body">
                                 <form action="edit.php?p=student&rollno=<?php echo encrypt_data($row['rollno'])?>" method="post" id="student-form">
                                     <div class="col-lg-10">
                                         <div class="mb-2">
                                          <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                          <input type="email" class="form-control" id="exampleFormControlInput1" name="email" value="<?php echo $row['email']?>">
                                      </div>
                                      <div class="mb-2">
                                          <label for="exampleFormControlInput1" class="form-label">Name</label>
                                          <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="<?php echo $row['name']?>">
                                      </div>
                                      <div class="mb-3">
                                          <label for="exampleFormControlInput1" class="form-label">Roll No</label>
                                          <input type="text" class="form-control" id="exampleFormControlInput1" name="rollno" value="<?php echo $row['rollno']?>">
                                      </div>
                                      <div class="mb-3 d-flex flex-column">
                                        <label class="form-label">College</label>
                                        <select name="college" class="form-select p-1">
                                            <option value="AEC" <?php if($row['college'] == 'AEC') echo 'selected'; ?>>AEC</option>
                                            <option value="ACOE" <?php if($row['college'] == 'ACOE') echo 'selected'; ?>>ACOE</option>
                                            <option value="ACET" <?php if($row['college'] == 'ACET') echo 'selected'; ?>>ACET</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 d-flex flex-column">
                                        <label class="form-label">Year</label>
                                        <select name="year" class="form-select p-1">
                                            <option selected>Select Year</option>
                                            <option value="1" <?php if($row['year'] == '1') echo 'selected';?>>1</option>
                                            <option value="2" <?php if($row['year'] == '2') echo 'selected';?>>2</option>
                                            <option value="3" <?php if($row['year'] == '3') echo 'selected';?>>3</option>
                                            <option value="4" <?php if($row['year'] == '4') echo 'selected';?>>4</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 d-flex flex-column">
                                        <label class="form-label">Branch</label>
                                        <select name="branch" class="form-select p-1">
                                            <option value="CSE" <?php if($row['branch'] == 'CSE') echo 'selected'; ?>>CSE</option>
                                            <option value="IT" <?php if($row['branch'] == 'IT') echo 'selected'; ?>>IT</option>
                                            <option value="ECE" <?php if($row['branch'] == 'ECE') echo 'selected'; ?>>ECE</option>
                                            <option value="AIML" <?php if($row['branch'] == 'AIML') echo 'selected'; ?>>AIML</option>
                                            <option value="MECH" <?php if($row['branch'] == 'MECH') echo 'selected'; ?>>MECH</option>
                                            <option value="CIVIL" <?php if($row['branch'] == 'CIVIL') echo 'selected'; ?>>CIVIL</option>
                                            <option value="PT" <?php if($row['branch'] == 'PT') echo 'selected'; ?>>PT</option>

                                        </select>
                                    </div>

                                    <div class="mb-2 d-flex flex-column">
                                        <label class="form-label">Block</label>
                                        <select name="block" class="form-select p-1">
                                            <option value="A" <?php if($row['block'] == 'A') echo 'selected'; ?>>A</option>
                                            <option value="B" <?php if($row['block'] == 'B') echo 'selected'; ?>>B</option>
                                            <option value="C" <?php if($row['block'] == 'C') echo 'selected'; ?>>C</option>
                                            <option value="D" <?php if($row['block'] == 'D') echo 'selected'; ?>>D</option>
                                            <option value="E" <?php if($row['block'] == 'E') echo 'selected'; ?>>E</option>
                                            <option value="F" <?php if($row['block'] == 'F') echo 'selected'; ?>>F</option>

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                      <label for="exampleFormControlInput1" class="form-label">Room No</label>
                                      <input type="text" class="form-control" id="exampleFormControlInput1" name="roomno" value="<?php echo $row['roomno']?>">
                                  </div>
                                  <div class="mb-3">
                                      <label for="exampleFormControlInput1" class="form-label">Student Mobile Number</label>
                                      <input type="text" class="form-control" id="exampleFormControlInput1" name="mobile" value="<?php echo $row['mobile']?>">
                                  </div>
                                  <div class="mb-3">
                                      <label for="exampleFormControlInput1" class="form-label">Parent Mobile Number</label>
                                      <input type="text" class="form-control" id="exampleFormControlInput1" name="parentMobile" value="<?php echo $row['parent_mobile']?>">
                                  </div>
                                  <div>
                                    <button class="btn btn-primary" name="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }
            elseif($type == 'staff'){
                ?>
                <h1 class="h3 mb-4 text-gray-800">Edit Staff</h1>

                <div class="row">

                    <div class="col-lg-8">

                        <!-- Student card -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Enter Updated Details</h6>
                            </div>
                            <div class="card-body">
                             <form action="edit.php?p=staff&empid=<?php echo encrypt_data($row['empid'])?>" method="post" id="student-form">
                                 <div class="col-lg-10">
                                     <div class="mb-2">
                                      <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                      <input type="email" class="form-control" id="exampleFormControlInput1" name="email" value="<?php echo $row['email']?>">
                                  </div>
                                  <div class="mb-2">
                                      <label for="exampleFormControlInput1" class="form-label">Name</label>
                                      <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="<?php echo $row['name']?>">
                                  </div>
                                  <div class="mb-3">
                                      <label for="exampleFormControlInput1" class="form-label">Emp.Id</label>
                                      <input type="text" class="form-control" id="exampleFormControlInput1" name="empid" value="<?php echo $row['empid']?>">
                                  </div>
                                  <div class="mb-3 d-flex flex-column">
                                    <label class="form-label">College</label>
                                    <select name="college" class="form-select p-1">
                                        <option value="AEC" <?php if($row['college'] == 'AEC') echo 'selected'; ?>>AEC</option>
                                        <option value="ACOE" <?php if($row['college'] == 'ACOE') echo 'selected'; ?>>ACOE</option>
                                        <option value="ACET" <?php if($row['college'] == 'ACET') echo 'selected'; ?>>ACET</option>
                                    </select>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label class="form-label">Designation</label>
                                    <select name="designation" class="form-select p-1">
                                        <option value="Asst.Professor" <?php if($row['designation'] == 'Asst.Professor') echo 'selected';?>>Asst. Professor</option>
                                        <option value="Lecturer" <?php if($row['designation'] == 'Lecturer') echo 'selected';?>>Lecturer</option>
                                        <option value="Jr.Lecturer" <?php if($row['designation'] == 'Jr.Lecturer') echo 'selected';?>>Jr. Lecturer</option>
                                        <option value="Lab Assistant" <?php if($row['designation'] == 'Lab Assistant') echo 'selected';?>>Lab Assistant</option>
                                        <option value="Other" <?php if($row['designation'] == 'Other') echo 'selected';?>>Other</option>
                                    </select>

                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label class="form-label">Department</label>
                                    <select name="department" class="form-select p-1">
                                        <option value="CSE" <?php if($row['department'] == 'CSE') echo 'selected'; ?>>CSE</option>
                                        <option value="IT" <?php if($row['department'] == 'IT') echo 'selected'; ?>>IT</option>
                                        <option value="ECE" <?php if($row['department'] == 'ECE') echo 'selected'; ?>>ECE</option>
                                        <option value="AIML" <?php if($row['department'] == 'AIML') echo 'selected'; ?>>AIML</option>
                                        <option value="MECH" <?php if($row['department'] == 'MECH') echo 'selected'; ?>>MECH</option>
                                        <option value="CIVIL" <?php if($row['department'] == 'CIVIL') echo 'selected'; ?>>CIVIL</option>
                                        <option value="PT" <?php if($row['department'] == 'PT') echo 'selected'; ?>>PT</option>

                                    </select>
                                </div>

                                <div class="mb-2 d-flex flex-column">
                                    <label class="form-label">Block</label>
                                    <select name="block" class="form-select p-1">
                                        <option value="A" <?php if($row['block'] == 'A') echo 'selected'; ?>>A</option>
                                        <option value="B" <?php if($row['block'] == 'B') echo 'selected'; ?>>B</option>
                                        <option value="C" <?php if($row['block'] == 'C') echo 'selected'; ?>>C</option>
                                        <option value="D" <?php if($row['block'] == 'D') echo 'selected'; ?>>D</option>
                                        <option value="E" <?php if($row['block'] == 'E') echo 'selected'; ?>>E</option>
                                        <option value="F" <?php if($row['block'] == 'F') echo 'selected'; ?>>F</option>

                                    </select>
                                </div>
                                <div class="mb-3">
                                  <label for="exampleFormControlInput1" class="form-label">Room No</label>
                                  <input type="text" class="form-control" id="exampleFormControlInput1" name="roomno" value="<?php echo $row['roomno']?>">
                              </div>
                              <div class="mb-3">
                                  <label for="exampleFormControlInput1" class="form-label">Student Mobile Number</label>
                                  <input type="text" class="form-control" id="exampleFormControlInput1" name="phone" value="<?php echo $row['phone']?>">
                              </div>
                              <div>
                                <button class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }

        ?>

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