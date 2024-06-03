<?php
session_start();
$title = "View Details";
include('./includes/header.php');
include_once('./utils/functions.php');
?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $type = $_GET['p'] ?? null;
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

                if($type == 'students'){
                    ?>

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
                                            <th>Department</th>
                                            <th>Block</th>
                                            <th>RoomNo</th>
                                            <th>Mobile</th>
                                            <th>Parent Mobile</th>
                                            <th class="no-export">Actions</th>
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
                                                        <div style="cursor: pointer;">
                                                            <a href="edit.php?p=student&rollno=<?php echo encrypt_data($row['rollno'])?>">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                        </div> 
                                                        <div style="cursor:pointer" onclick="handleDelete('<?php echo encrypt_data($row['rollno']); ?>')">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </div>

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

                    <?php
                }
                elseif($type == 'staff'){

                    ?>

                    <h1 class="h3 mb-2 text-gray-800">View Staff Data</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Staff Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Emp.Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>College</th>
                                            <th>Department</th>
                                            <th>Designation</th>
                                            <th>Block</th>
                                            <th>RoomNo</th>
                                            <th>Mobile</th>
                                            <th class="no-export">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            include_once('./config/dbConfig.php');
                                            $query = "select * from staff";
                                            $result = mysqli_query($conn,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                <td><?php echo $row['empid']?></td>
                                                <td><?php echo $row['name']?></td>
                                                <td><?php echo $row['email']?></td>
                                                <td><?php echo $row['college']?></td>
                                                <td><?php echo $row['department']?></td>
                                                <td><?php echo $row['designation']?></td>
                                                <td><?php echo $row['block']?></td>
                                                <td><?php echo $row['roomno']?></td>
                                                <td><?php echo $row['phone']?></td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-around">
                                                        <div style="cursor: pointer;">
                                                            <a href="edit.php?p=staff&empid=<?php echo encrypt_data($row['empid'])?>">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                        </div> 
                                                        <div style="cursor:pointer" onclick="handleStaffDelete('<?php echo encrypt_data($row['empid']); ?>')">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </div>

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

                    <?php
                }
                elseif($type == 'gatepass'){
                    ?>

                    <h1 class="h3 mb-2 text-gray-800">View GatePass Data</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gatepass Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>GatePass Id</th>
                                            <th>RollNo</th>
                                            <th>Name</th>
                                            <th>Year</th>
                                            <th>Branch</th>
                                            <th>College</th>
                                            <th>Block</th>
                                            <th>Room No</th>
                                            <th>Reason</th>
                                            <th>Place</th>
                                            <th>StartDate</th>
                                            <th>End Date</th>
                                            <th>Transport</th>
                                            <th class="no-export">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            include_once('./config/dbConfig.php');
                                            $query = "select * from gatepass";
                                            $result = mysqli_query($conn,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                <td><?php echo $row['passid']?></td>
                                                <td><?php echo $row['rollno']?></td>
                                                <td><?php echo $row['name']?></td>
                                                <td><?php echo $row['year']?></td>
                                                <td><?php echo $row['branch']?></td>
                                                <td><?php echo $row['college']?></td>
                                                <td><?php echo $row['block']?></td>
                                                <td><?php echo $row['roomno']?></td>
                                                <td><?php echo $row['reason']?></td>
                                                <td><?php echo $row['place']?></td>
                                                <td><?php echo $row['startdate']?></td>
                                                <td><?php echo $row['enddate']?></td>
                                                <td><?php echo $row['transport_type']?></td>

                                                <td>
                                                    <div id="printPass">
                                                        <i class="fas fa-print fa-lg" style="cursor:pointer;"></i> 
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

                    <?php
                }
                elseif($type == "complaints"){
                    ?>
                    <h1 class="h3 mb-2 text-gray-800">View Complaints Data</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Complaint Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Complaint ID</th>
                                            <th>Roll No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>College</th>
                                            <th>Year</th>
                                            <th>Branch</th>
                                            <th>Block</th>
                                            <th>Room No</th>
                                            <th>Mobile</th>
                                            <th>Complaint</th>
                                            <th>Status</th>
                                            <th class="no-export">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            include_once('./config/dbConfig.php');
                                            $query = "SELECT s.*, c.complaint,c.status,c.complaint_id
                                            FROM complaints c
                                            JOIN students s ON s.rollno = c.rollno ORDER BY c.complaint_id asc;";
                                            $result = mysqli_query($conn,$query);
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                <td><?php echo $row['complaint_id']?></td>
                                                <td><?php echo $row['rollno']?></td>
                                                <td><?php echo $row['name']?></td>
                                                <td><?php echo $row['email']?></td>
                                                <td><?php echo $row['college']?></td>
                                                <td><?php echo $row['year']?></td>
                                                <td><?php echo $row['branch']?></td>
                                                <td><?php echo $row['block']?></td>
                                                <td><?php echo $row['roomno']?></td>
                                                <td><?php echo $row['mobile']?></td>
                                                <td><?php echo $row['complaint']?></td>
                                                <td
                                                class = "
                                                <?php
                                                if($row['status'] == 'pending'){
                                                    echo 'text-warning';
                                                }
                                                elseif($row['status'] == 'success'){
                                                    echo 'text-success';
                                                }
                                                elseif($row['status'] == 'rejected'){
                                                    echo "text-danger";
                                                }
                                                ?>

                                                "

                                                ><?php echo $row['status']?></td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-around">
                                                        <?php
                                                        if($row['status'] == 'pending'){
                                                            ?>
                                                            <div style="cursor: pointer;" onclick="handleSuccess('<?php echo encrypt_data($row['complaint_id'])?>')">
                                                                <i class="fas fa-check text-success"></i>
                                                            </div> 
                                                            <div style="cursor:pointer" onclick="handleReject('<?php echo encrypt_data($row['complaint_id']); ?>')">
                                                                <i class="fas fa-times text-danger"></i>
                                                            </div>
                                                            <?php
                                                        }
                                                        elseif($row['status'] == 'success' || $row['status'] == 'rejected'){
                                                            ?>
                                                            <h3>-</h3>
                                                            <?php
                                                        }


                                                        ?>
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
                    <?php
                }
                else{
                    echo '<h3>Invalid Path</h3>';
                }
                ?>

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
<script type="text/javascript">
     function handleDelete(rollno){
        if(confirm('Are You sure to delete student?')){
            const xhr = new XMLHttpRequest();
            xhr.open('GET','./delete.php?p=student&rollno='+rollno,true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xhr.onreadystatechange = function(){
                if(xhr.status == 200 && xhr.readyState == 4){
                    alert('Succesfully Record Deleted');
                    window.location.href = 'view_details.php?p=student';
                }
            }
            xhr.send();
        }
    }
    function handleStaffDelete(empid){
        if(confirm('Are You sure to delete staff?')){
            const xhr = new XMLHttpRequest();
            xhr.open('GET','./delete.php?p=staff&empid='+empid,true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xhr.onreadystatechange = function(){
                if(xhr.status == 200 && xhr.readyState == 4){
                    alert('Succesfully Record Deleted');
                    window.location.href = 'view_details.php?p=staff';
                }
            }
            xhr.send();
        }
    }

    function handleSuccess(id){
        if(confirm('Are You sure to change status to success?')){
            const xhr = new XMLHttpRequest();
            xhr.open('GET','changeStatus.php?p=complaints&status=1&complaint_id='+id,true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xhr.onreadystatechange = function(){
                if(xhr.status == 200 && xhr.readyState == 4){
                    alert('Successfull');
                    window.location.href = 'view_details.php?p=complaints';
                }
            }
            xhr.send();
        }
    }
    function handleReject(id){
        if(confirm('Are You sure to change status to reject?')){
            const xhr = new XMLHttpRequest();
            xhr.open('GET','changeStatus.php?p=complaints&status=0&complaint_id='+id,true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xhr.onreadystatechange = function(){
                if(xhr.status == 200 && xhr.readyState == 4){
                    alert('Successfull');
                    window.location.href = 'view_details.php?p=complaints';
                }
            }
            xhr.send();
        }
    }
    $('#printPass').click(function(){
        alert('Print Pass')
    })
</script>


<!-- Logout Modal-->
<?php include('./includes/logoutModal.php')?>

<?php include('./includes/footer.php')?>
