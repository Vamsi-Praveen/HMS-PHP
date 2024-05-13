<?php
$title = "Login";
include('./includes/header.php');
include('./config/dbConfig.php');
    //session starting
session_start();
if(isset($_SESSION['username'])){
    header("location:index.php");
}
?>


<?php

$error_message = "";
$login_status = false;
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM  users where email='$email';";
    $result = mysqli_query($conn,$query);
    if(!mysqli_num_rows($result)>0){
        $error_message = "User Not Found";
    }
    else{
     $res = mysqli_fetch_assoc($result);
     $dbPassword = $res['password'];
     if($res){
        if($dbPassword==$password){
            $error_message = 'Login Success';
            $login_status = true;
            $_SESSION['username']=$email;
            $_SESSION['name'] = $res['name'];
            header('location:index.php');
        }
        else{
            $error_message = 'Invalid Credentials';
        }
    }
}
}

?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-9 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-lg-12">
                            <div class="px-5 py-4">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" action="login.php" method="post">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address..."
                                        name="email" 
                                        >
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block" name="login">
                                        Login
                                    </button>
                                </form>
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>-->  
                                    <div class="text-center mt-3 mb-0">
                                        <p class="text-danger fw-bold"><?php echo($error_message) ?></p>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php
    include('./includes/footer.php');
?>