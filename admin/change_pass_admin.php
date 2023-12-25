<?php
include "../db_connect.php";
session_start();


if(isset($_SESSION['username'])){
    if(isset($_POST['submit'])){
    $old_password = $_POST['old_pass'];
    $new_password = $_POST['new_pass'];
    $conf_new_pass = $_POST['conf_new_pass'];
    $user = $_SESSION['username'];

    $sql = "SELECT * FROM admin WHERE username = '".$user."' ";
    $run =mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($run);
    $pass = $row['password'];

    if($pass == $old_password){

        if($new_password == $conf_new_pass){

            $query = "UPDATE officer SET password = '".$new_password."' WHERE username = '".$user."' ";
            $fire = mysqli_query($conn,$query);
            echo '<script>alert("Password Changed Successfully")</script>';
            

        }
        else{
            echo '<script>alert("New password does not match the Confirmed New Password")</script>';
        }

    }
    else{
        echo '<script>alert("Please enter the right old password")</script>';
    }

    




    }
?>


<html>

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Traffic Police Website</title>
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Asap&display=swap" rel="stylesheet">
        <style> @import url('https://fonts.googleapis.com/css2?family=Asap&display=swap'); </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="bg-light" style="font-family: 'Asap', sans-serif;">
<nav class="navbar navbar-expand-lg py-3 navbar-dark bg-dark" style="font-family: 'Martian Mono', monospace;">
    <div class="container-fluid" style="padding-right: 130px; padding-left: 30px;">
            
            <a class="navbar-brand" href="..\admin_home.php">
            <img src="../img/icon.png" alt="Bootstrap" width="60" height="55">
            </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
             
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Add New
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="..\admin\incident\add_incident.php"> Add Incident </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\admin\vehicle\add_vehicle.php"> Add Vehicle </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\admin\person\add_person.php"> Add Person </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\admin\fines\add_fines.php"> Add Fines </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\admin\officer\add_officer.php"> Add Officer </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Search
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="..\admin\incident\search_incident.php"> Search Incident </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\admin\vehicle\search_vehicle.php"> Search Vehicle </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\admin\person\search_person.php"> Search Person </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Edit
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="..\admin\incident\edit_incident.php"> Edit Incident </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Options
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="..\admin\change_pass_admin.php"> Change the Password </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\logout.php"> Logout </a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>
<div class="container h-custom">
    <div class="row justify-content-center align-items-center">
        <div class=" col-xl-6 offset-xl-1 ">
            <div class="col-xl-5 w-75">
                <form action="" method = "post" class="p-4" autocomplete="off">

                    <div class="form-outline mb-4">
                        <label for="old_pass" class="form-label">Old Password:</label>
                        <input type="text" name="old_pass" class="form-control form-control-sm" placeholder ="Old Password" required>
                    </div>   
                    <div class="form-outline mb-4">
                        <label for="new_pass" class="form-label">New Password:</label>
                        <input type="text" name="new_pass" class="form-control form-control-sm" placeholder = "New Password" required>
                    </div>
                    <div class="form-outline mb-4">
                       <label for="conf_new_pass" class="form-label">Confirm New Password:</label>
                        <input type="text" name="conf_new_pass" class="form-control form-control-sm" placeholder = "Confirm Password"required>
                    </div>   

                    
                        <button type="submit" class="btn btn-secondary btn-sm" name="submit">Submit</button>

                    <a href="..\admin_home.php"> Back </a></br></br>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   
</body>
</html>

<?php

} else {
    header("Location: ../index.php");
    exit();
}