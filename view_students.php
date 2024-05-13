<?php
session_start();
$title = "View Students";
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
                <h1 class="h3 mb-2 text-gray-800">View Student Data</h1>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Student Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>College</th>
                                        <th>Year</th>
                                        <th>Branch</th>
                                        <th>Block</th>
                                        <th>RoomNo</th>
                                        <th>Mobile</th>
                                        <th>Parent Mobile</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    include_once('./config/dbConfig.php');
                                    $query = "select * from students";
                                    $result = mysqli_query($conn,$query);
                                    while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <td><?php echo $row['rollno']?></td>
                                        <td><?php echo $row['name']?></td>
                                        <td><?php echo $row['email']?></td>
                                        <td><?php echo $row['college']?></td>
                                        <td><?php echo $row['year']?></td>
                                        <td><?php echo $row['branch']?></td>
                                        <td><?php echo $row['block']?></td>
                                        <td><?php echo $row['roomno']?></td>
                                        <td><?php echo $row['mobile']?></td>
                                        <td><?php echo $row['parent_mobile']?></td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-around">
                                                <i class="fas fa-pen"></i> 
                                                <i class="fas fa-trash text-danger"></i> 
                                            </div>
                                        </td>
                                        
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
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
<?php include('./includes/logoutModal.php')?>

<?php include('./includes/footer.php')?>
