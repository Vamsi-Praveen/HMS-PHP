<?php 
session_start();
$title = "Add Student";
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
                <h1 class="h3 mb-4 text-gray-800">Add New Room</h1>

                <div class="row">

                    <div class="col-lg-8">

                        <!-- Student card -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Enter Details</h6>
                            </div>
                            <div class="card-body">
                             <div class="col-lg-10">
                                 <div class="mb-2">
                                  <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                  <input type="email" class="form-control" id="exampleFormControlInput1">
                              </div>
                              <div class="mb-2">
                                  <label for="exampleFormControlInput1" class="form-label">Name</label>
                                  <input type="text" class="form-control" id="exampleFormControlInput1">
                              </div>
                              <div class="mb-3">
                                  <label for="exampleFormControlInput1" class="form-label">Roll No</label>
                                  <input type="text" class="form-control" id="exampleFormControlInput1">
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
                              <input type="text" class="form-control" id="exampleFormControlInput1">
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

<!-- Logout Modal-->
<?php include("./includes/logoutModal.php")?>
<?php include("./includes/footer.php")?>