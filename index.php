<?php
$title = "Dashboard";
include('./includes/header.php');
?>
<?php
session_start();
include_once('./config/dbConfig.php');
if(!isset($_SESSION['username'])){
    header("location:login.php");
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
            <?php include('./includes/navbar.php'); ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                 <!-- total students -->
                 <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    All Students</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                    $query = "select * from students";
                                    $result = mysqli_query($conn,$query);
                                    if($result){
                                        echo mysqli_num_rows($result);
                                    }
                                    else
                                    {
                                        echo 0; 
                                    }

                                ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Gate Passes</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    $query = "select * from gatepass";
                                    $result = mysqli_query($conn,$query);
                                    if($result){
                                        echo mysqli_num_rows($result);
                                    }
                                    else
                                    {
                                        echo 0; 
                                    }

                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Complaints</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    $query = "select * from complaints";
                                    $result = mysqli_query($conn,$query);
                                    if($result){
                                        echo mysqli_num_rows($result);
                                    }
                                    else
                                    {
                                        echo 0; 
                                    }

                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-question fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Students Count</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myAreaChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Overview</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart"></canvas>
        </div>
        <div class="mt-4 text-center small">
            <span class="mr-2">
                <i class="fas fa-circle text-primary"></i> Students
            </span>
            <span class="mr-2">
                <i class="fas fa-circle text-success"></i> GatePasses
            </span>
        </div>
    </div>
</div>
</div>
</div>
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
<?php
include('./includes/footer.php');
?>