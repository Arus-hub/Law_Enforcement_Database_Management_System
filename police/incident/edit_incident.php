<?php

include "../../db_connect.php";

session_start();


if(isset($_SESSION['username'])){

if(isset($_POST['submit'])){
    $date = $_POST['date'];
    $vehicle_lic = $_POST['vehicle_lic'];
    $report = $_POST['report'];

    $own = "SELECT * FROM vehicle WHERE Vehicle_licence = '".$vehicle_lic."' ";
    $res_own = mysqli_query($conn,$own);
    if($row = mysqli_fetch_array($res_own)){
        $vehicle_id = $row['Vehicle_ID'];

        $sql = "SELECT * FROM incident WHERE Vehicle_ID = '".$vehicle_id."' AND Incident_Date = '".$date."' ";
        $run = mysqli_query($conn,$sql);
        
        if($row = mysqli_fetch_array($run)){
            $oldrec = $row['Incident_Report'];
            $update = "UPDATE incident SET Incident_Report = '".$report."' WHERE Vehicle_ID = '".$vehicle_id."' AND Incident_Date = '".$date."' ";
            $fire = mysqli_query($conn,$update);

              #for inserting into the audit table for updating the record
                date_default_timezone_set('Europe/London');
                $date1 = date("Y-m-d H:i:s");
                $user1 = $_SESSION['username'];
                $audit = "INSERT INTO audit VALUES ('','$user1','Update','Incident','$vehicle_lic - $oldrec to $report','$date1')";
                mysqli_query($conn,$audit);


            echo '<script>alert("Record Updated Successfully")</script>';

        }else{
            echo '<script>alert("No Record forund of the vehicle on the date provided")</script>';
        }

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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body class="bg-light" style="font-family: 'Asap', sans-serif;">
<nav class="navbar navbar-expand-lg py-3 navbar-dark bg-dark" style="font-family: 'Martian Mono', monospace;">
    <div class="container-fluid" style="padding-right: 130px; padding-left: 30px;">
            
            <a class="navbar-brand" href="..\..\home.php">
            <img src="../../img/icon.png" alt="Bootstrap" width="60" height="55">
            </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
             
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Add New
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="..\..\police\incident\add_incident.php"> Add Incident </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\..\police\vehicle\add_vehicle.php"> Add Vehicle </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\..\police\person\add_person.php"> Add Person </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Search
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="..\..\police\incident\search_incident.php"> Search Incident </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\..\police\vehicle\search_vehicle.php"> Search Vehicle </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="..\..\police\person\search_person.php"> Search Person </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Edit
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="..\..\police\incident\edit_incident.php"> Edit Incident </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Options
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="..\..\police\change_pass.php"> Change the Password </a></li>
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
                <form class="p-4" action="" method="post" autocomplete="off">

                        <b>Enter the Date of Incident and the Vehicle Licence Number of which You want to update the Report</b><br></br>
                        <div class="form-outline mb-4">
                        <h6><label for="date" class="form-label">Date of Incident</label></h6>
                        <input type="date" name="date" class="form-control form-control-sm" placeholder = "Enter Owners Name" required>
                        </div>

                        <div class="form-outline mb-4">
                        <h6><label for="veh_lic" class="form-label">Vehicle's Licence Number </label></h6>
                        <?php
                            # PHP code for drop down list to select form vehicle
                            $sql2 = "SELECT * FROM vehicle";
                            $result2 = mysqli_query($conn, $sql2);
                            
                            echo "<datalist id='list1'>";
                            while ($row = mysqli_fetch_array($result2)) {     
                                echo "<option> $row[Vehicle_licence] </option>";
                            }
                            echo "</datalist>";
                            echo "<input type='search' name = 'vehicle_lic' list = 'list1'/ class='form-control form-control-sm' placeholder = 'Select the Vehicles Licence Number' required>";
                                ?> 
                        </div>

                        <div class="form-outline mb-4">
                        <h6><label for="report" class="form-label">Incident Report </label></h6>
                        <textarea id="report" name="report" rows="2" cols="30"class="form-control form-control-sm" placeholder = "Enter the New Report"> </textarea>
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
else{
    header("Location: ../../index.php");
    exit();
}
?>


