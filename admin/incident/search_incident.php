


<?php

include "../../db_connect.php";
session_start();

if(isset($_SESSION['username'])){

?>    

<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Traffic Police Website</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Asap&display=swap" rel="stylesheet">
    <style> @import url('https://fonts.googleapis.com/css2?family=Asap&display=swap'); </style>
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
<!-- form for searching incidents by dates-->
<div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-25">
            <div class="col-md-6 col-lg-6 col-xl-5">
                <form class="" role="search" action="" method="post">
                        
                        <label for="" class="form-label">From Date </label></hr></hr>
                        <input type="date" name="from_date" required> </hr></hr>
                        
                        <label class="form-label">To Date</label>
                        <input type="date" name="to_date" required>
                        <button type="submit" name="i_submit" class="btn btn-secondary">Submit</button></br></br>
                </form>
            </div>
        </div>
</div>
<!-- PHP code for getting the value from database using date -->
<?php 

    if(isset($_POST['i_submit'])) # checking if the submit button is pressed or not
    {
?>
          <!--  <button type="button" id = "1" onclick="myFunction(this.id)">Toggle</button>  -->
<div class="container-fluid h-custom">
 <div class="row d-flex justify-content-center align-items-center ">
 <div class="col-xl-5 w-75 p-3">
            <div id="date-table">
            <table  class="table table-striped table-bordered border-5 border-dark">
                <thead class="table-dark">
                <tr>
                    <th>Vehicle's Licence Number</th>
                    <th>Owner's Licence Number</th>
                    <th>Incident Date</th>
                    <th>Report</th>
                    <th>Offence</th>

                </tr>
                </thead>
                <tbody class="table-group-divider">

                <?php
                if(isset($_POST['from_date']) && isset($_POST['to_date']))
                {
                    $from_date = $_POST['from_date'];
                    $to_date = $_POST['to_date'];

                    $query = "SELECT * FROM incident WHERE Incident_Date BETWEEN '$from_date' AND '$to_date' ";
                    $query_run = mysqli_query($conn, $query);

                    #for inserting into the audit table
                    date_default_timezone_set('Europe/London');
                    $date1 = date("Y-m-d H:i:s");
                    $user1 = $_SESSION['username'];
                    $audit = "INSERT INTO audit VALUES ('','$user1','Search','Incident','$from_date to $to_date','$date1')";
                    mysqli_query($conn,$audit);

                    if(mysqli_num_rows($query_run) > 0)
                    {
                        while($row = mysqli_fetch_array($query_run))
                        {
                            $v_id = $row["Vehicle_ID"];
                            $p_id = $row["People_ID"];
                            $o_id = $row["Offence_ID"];
                            $i_date = $row["Incident_Date"];
                            $i_report = $row["Incident_Report"];

                            #searching vehicle licence number for the vehicle id
                            $sql1 = "SELECT * FROM vehicle WHERE Vehicle_ID = '".$v_id."' ";
                            $veh_sql = mysqli_query($conn,$sql1);
                            $veh = mysqli_fetch_array($veh_sql);
                            $veh_lic = $veh['Vehicle_licence'];

                            $sql2 = "SELECT * FROM people WHERE People_ID = '".$p_id."' ";
                            $pep_sql = mysqli_query($conn,$sql2);
                            $pep = mysqli_fetch_array($pep_sql);
                            $pep_lic = $pep['People_licence'];

                            $sql3 = "SELECT * FROM offence WHERE Offence_ID = '".$o_id."' ";
                            $off_sql = mysqli_query($conn,$sql3);
                            $off = mysqli_fetch_array($off_sql);
                            $off_desc = $off['Offence_description'];
                        
                        ?>
                                        
                    <tr>
                    <td><?= $veh_lic; ?></td>
                    <td><?= $pep_lic; ?></td>
                    <td><?= $i_date; ?></td>
                    <td><?= $i_report; ?></td>
                    <td><?= $off_desc; ?></td>
                    </tr>
                    

                <?php
                        } #ending the while loop for browsing throug the database to find data
                } #ending the in loop for $query_run>0
                
                    else
                     { ?>
                        <tr>
                        <td> No Record Found </td>
                         </tr>
                    <?php     
                     }
                    }?>
                     
             </tbody>
        </table> 
        </div> <!-- div ending for the table searched using date -->
</div>
</div>
</div>

 <?php } ?> <!-- ending of if loop - print data - incident date -->

<!-- Ending the PHP code for getting the value from database using date -->


<!-- form for searching incidents by Persons Licence Number-->

<div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-25">
            <div class="col-md-6 col-lg-6 col-xl-5">
                <form class="" role="search" action="" method="post">
                        <label class="form-label" for="">People Licence Number</label>
                        <input type="text" name="people_licence" required value="" placeholder="Owners's Licence">
                        <button type="submit" name="p_submit" class="btn btn-secondary">Submit</button></br>
                </form>
            </div>
        </div>
</div>
<!--PHP code for getting the value from database using persons licence number -->
<?php

if(isset($_POST["p_submit"]))
{ ?> 
 
 <!--<button id = "2" onclick="myFunction(this.id)">Person</button>-->
 <div class="container-fluid h-custom">
 <div class="row d-flex justify-content-center align-items-center ">
 <div class="col-xl-5 w-75 p-3">
    <div id="people-table">
        <table class="table table-striped table-bordered border-5 border-dark">
                <thead class="table-dark">
                <tr>
                    <th>Vehicle's Licence Number</th>
                    <th>Owner's Licence Number</th>
                    <th>Incident Date</th>
                    <th>Report</th>
                    <th>Offence</th>

                </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                        $people_lic = $_POST["people_licence"];
                        $sql4 = "SELECT * FROM people WHERE People_licence = '".$people_lic."' ";
                        $r = mysqli_query($conn, $sql4);
                        if(mysqli_num_rows($r) > 0)
                        {

                            $find = mysqli_fetch_array($r);
                            $people_id = $find['People_ID'];

                            $sql5 = "SELECT * FROM incident i LEFT JOIN vehicle v ON i.Vehicle_ID = v.Vehicle_ID LEFT JOIN ownership o ON v.Vehicle_ID = o.Vehicle_ID LEFT JOIN people p ON p.People_ID = o.People_ID LEFT JOIN offence of ON i.Offence_ID = of.Offence_ID  WHERE p.People_ID = '".$people_id."'";
                            $run = mysqli_query($conn,$sql5);

                              #for inserting into the audit table
                              date_default_timezone_set('Europe/London');
                              $date1 = date("Y-m-d H:i:s");
                              $user1 = $_SESSION['username'];
                              $audit = "INSERT INTO audit VALUES ('','$user1','Search','Incident','$people_lic','$date1')";
                              mysqli_query($conn,$audit);

                            
                            if(mysqli_num_rows($run)>0)
                            {
                                foreach($run as $items)
                                {
                            ?>
                                    <tr>
                                    <td><?= $items['Vehicle_licence']; ?></td>
                                    <td><?= $items['People_licence']; ?></td>
                                    <td><?= $items['Incident_Date']; ?></td>
                                    <td><?= $items['Incident_Report']; ?></td>
                                    <td><?= $items['Offence_description']; ?></td>
                                            
                            <?php
                                }

                            }
                            ?>
                        <?php

                        }
                        else
                        { 
                        ?>
                            <tr>
                            <td> No Record Found </td>
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
<?php
    }
?>





<!-- form for searching incidents by Vehicle's Licence Number-->

<div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-25">
            <div class="col-md-7 col-lg-5 col-xl-5">
                <form class="" role="search" action="" method="post">
                        <label class="form-label" for="">Vehicle Licence Number</label>
                        <input type="text" name="vehicle_licence" required value="" placeholder="Vehicle's Licence"> 
                        <button type="submit" name="v_submit" class="btn btn-secondary">Submit</button>  
                </form> 
                    </br>
            </div>
        </div>
</div>
                    

<!--PHP code for getting the value from database using vehicles licence number -->
<?php

if(isset($_POST["v_submit"]))
{ ?> 
 
 <!-- <button id = "3" onclick="myFunction(this.id)">Vehicle</button> -->
 <div class="container-fluid h-custom">
 <div class="row d-flex justify-content-center align-items-center ">
 <div class="col-xl-5 w-75 p-3">
    <div id="vehicle-table">
        <table class="table table-striped table-bordered border-5 border-dark">
                <thead class="table-dark">
                <tr>
                    <th>Vehicle's Licence Number</th>
                    <th>Owner's Licence Number</th>
                    <th>Incident Date</th>
                    <th>Report</th>
                    <th>Offence</th>

                </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                        $vehicle_lic = $_POST["vehicle_licence"];
                        $sql7 = "SELECT * FROM vehicle WHERE Vehicle_licence = '".$vehicle_lic."' ";
                        $ret = mysqli_query($conn, $sql7);
                        if(mysqli_num_rows($ret) > 0)
                        {

                            $find_veh = mysqli_fetch_array($ret);
                            $vehicle_id = $find_veh['Vehicle_ID'];

                            $sql8 = "SELECT * FROM incident i LEFT JOIN vehicle v ON i.Vehicle_ID = v.Vehicle_ID LEFT JOIN ownership o ON v.Vehicle_ID = o.Vehicle_ID LEFT JOIN people p ON p.People_ID = o.People_ID LEFT JOIN offence of ON i.Offence_ID = of.Offence_ID  WHERE v.Vehicle_ID = '".$vehicle_id."'";
                            $runn = mysqli_query($conn,$sql8);

                              #for inserting into the audit table
                                date_default_timezone_set('Europe/London');
                                $date1 = date("Y-m-d H:i:s");
                                $user1 = $_SESSION['username'];
                                $audit = "INSERT INTO audit VALUES ('','$user1','Search','Incident','$vehicle_lic','$date1')";
                                mysqli_query($conn,$audit);


                            if(mysqli_num_rows($runn)>0)
                            {
                                foreach($runn as $items)
                                {
                            ?>
                                    <tr>
                                    <td><?= $items['Vehicle_licence']; ?></td>
                                    <td><?= $items['People_licence']; ?></td>
                                    <td><?= $items['Incident_Date']; ?></td>
                                    <td><?= $items['Incident_Report']; ?></td>
                                    <td><?= $items['Offence_description']; ?></td>
                                            
                            <?php
                                }

                            }
                            ?>
                        <?php

                        }
                        else
                        { 
                        ?>
                            <tr>
                            <td> No Record Found </td>
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

<?php
    }
?>
     
<!-- The java scrypt for hiding the table searched by using incident dates -->    
      <script>
            function myFunction(clicked) 
            {
                if(clicked<2){
                var x = document.getElementById("date-table");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
            else if(clicked==2){
                var y = document.getElementById("people-table");
                if (y.style.display === "none") {
                    y.style.display = "block";
                } else {
                    y.style.display = "none";
                }
            }

            else if(clicked==3){
                var z = document.getElementById("vehicle-table");
                if (z.style.display === "none") {
                    z.style.display = "block";
                } else {
                    z.style.display = "none";
                }


            }
        }
    </script>
<!-- The java scrypt for hiding the table searched by using Person Licence Number -->  
        
<!-- The java scrypt for hiding the table searched by using Vehicle Licence Number -->  




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

        