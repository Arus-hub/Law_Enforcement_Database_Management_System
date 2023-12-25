<?php

include "../../db_connect.php";

session_start();

$query = "SELECT * FROM admin WHERE username = '".$_SESSION['username']."' ";
    $run = mysqli_query($conn,$query);
if(mysqli_fetch_array($run)>0){

    if(isset($_SESSION['username'])){

                if(isset($_POST["submit"])){
                    $fine_amount = $_POST["fine_amount"];
                    $fine_point = $_POST["fine_points"];
                    $incident_id = $_POST["incident_id"]; 

                    $query = "SELECT * FROM fines WHERE Incident_ID = '".$incident_id."' ";
                    $run = mysqli_query($conn,$query);
                    if(mysqli_fetch_array($run)==0){
                        $s = "SELECT * FROM incident WHERE Incident_ID = '".$incident_id."'";
                        $go = mysqli_query($conn,$s);
                        
                        if($row = mysqli_fetch_array($go)){
                            
                            $offence_id = $row['Offence_ID'];

                            $query2 = "SELECT * FROM offence WHERE Offence_ID = '".$offence_id."' ";
                            $run2 = mysqli_query($conn,$query2);
                            $row1 = mysqli_fetch_array($run2);
                            $max_fine = $row1["Offence_maxFine"];
                            $max_points = $row1["Offence_maxPoints"];

                            if($fine_amount<=$max_fine){

                                if($fine_point<=$max_points){

                                    $insert = "INSERT INTO fines VALUES ('','$fine_amount','$fine_point','$incident_id')";
                                    $fire = mysqli_query($conn,$insert);

                                    #for inserting into the audit table
                                    date_default_timezone_set('Europe/London');
                                    $date1 = date("Y-m-d H:i:s");
                                    $user1 = $_SESSION['username'];
                                    $audit = "INSERT INTO audit VALUES ('','$user1','Insert','Fines','$incident_id','$date1')";
                                    mysqli_query($conn,$audit);

                                }else{

                                    echo '<script>alert("The Points for this offence should not be more than '.$max_points.'")</script>';
                                }

                            }else{

                                echo '<script>alert("The Fine for this offence should not be more than '.$max_fine.'")</script>';
                            }

                        }else{
                            echo '<script>alert("Please Select the incident from dropdown list")</script>';
                        }
                        
                    } else {
                        echo '<script>alert("The Fine for Incident is already stored")</script>';


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
            
            <a class="navbar-brand" href="..\..\admin_home.php">
            <img src="../../img/icon.png" alt="Bootstrap" width="60" height="55">
            </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
             
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Add New
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="..\..\admin\incident\add_incident.php"> Add Incident </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\..\admin\vehicle\add_vehicle.php"> Add Vehicle </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\..\admin\person\add_person.php"> Add Person </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\..\admin\fines\add_fines.php"> Add Fines </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\..\admin\officer\add_officer.php"> Add Officer </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Search
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="..\..\admin\incident\search_incident.php"> Search Incident </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\..\admin\vehicle\search_vehicle.php"> Search Vehicle </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\..\admin\person\search_person.php"> Search Person </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Edit
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="..\..\admin\incident\edit_incident.php"> Edit Incident </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Options
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="..\..\admin\change_pass_admin.php"> Change the Password </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\..\logout.php"> Logout </a></li>
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
                    <label for="fine_amount" class="form-label">Fine Amount </label>
                    <input type="number" name="fine_amount" class="form-control form-control-sm" placeholder = "Enter the Fine Amount" required value="">
                </div>
                <div class="form-outline mb-4">
                    <label for="fine_points" class="form-label">Fine Points</label>
                    <input type="number" name="fine_points" class="form-control form-control-sm" placeholder = "Enter the Fine Points" required value="">
                </div>
                <div class="form-outline mb-4">
                    <label for ="incident_id" class="form-label">Incident ID</label>
                        <?php
                        
                        $sql = "SELECT * FROM incident";
                        $result = mysqli_query($conn, $sql);
                        
                        echo "<datalist id='list'>";
                        while ($row = mysqli_fetch_array($result)) {     
                            echo "<option> $row[Incident_ID] </option>";
                        }
                        echo "</datalist>";
                        echo "<input type='search' name = 'incident_id' list = 'list'/ required class='form-control form-control-sm' placeholder = 'Select Incident ID'>";
                            ?>  
                </div>  
                
                <button type="submit" class="btn btn-secondary btn-sm" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    </body>
</html>

<?php
}

}else{
    header("Location: ../../index.php");
    exit();
}
?> 