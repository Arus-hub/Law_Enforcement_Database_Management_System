<?php

include "../../db_connect.php";


session_start();


if(isset($_SESSION['username'])){

        #checking of submited the from for adding incident
        if(isset($_POST["i_submit"])){

            $veh_licence = $_POST["veh_lic"];
            
            $incident_date = $_POST["incident_date"];
            $incident_report = $_POST["report"];
            $offence_id = $_POST["offence_id"];

            $query1 = "SELECT * FROM vehicle WHERE Vehicle_licence = '".$veh_licence."' "; 
            $v_query = mysqli_query($conn,$query1);

              if(mysqli_fetch_array($v_query)>0){

                    $query3 = "SELECT * FROM offence WHERE Offence_ID = '".$offence_id."'";
                    $o_query = mysqli_query($conn,$query3);
                        
                    if(mysqli_fetch_array($o_query)>0){

                    $fetch = "SELECT * FROM vehicle v LEFT JOIN ownership o ON v.Vehicle_ID = o.Vehicle_ID LEFT JOIN people p ON p.People_ID = o.People_ID  WHERE v.Vehicle_licence = '".$veh_licence."' ";
                    $vehicle = mysqli_query($conn,$fetch);
                    $row5 = mysqli_fetch_array($vehicle);
                    $vehid = $row5['Vehicle_ID'];
                    $pepid = $row5['People_ID'];
                
                    $insert = "INSERT INTO incident VALUES ('','$vehid','$pepid','$incident_date','$incident_report','$offence_id')";
                    mysqli_query($conn,$insert);

                    date_default_timezone_set('Europe/London');
                    $date1 = date("Y-m-d H:i:s");
                    $user1 = $_SESSION['username'];
                    $audit = "INSERT INTO audit VALUES ('','$user1','Insert','Incident','$veh_licence','$date1')";
                    mysqli_query($conn,$audit);

                    echo '<script>alert("Data Inserted Successfully")</script>';

                    } else {
                        echo '<script>alert("Select the offence ID from the Drop down list")</script>';
                    }

                

            }
            else{
                echo '<script>alert("Select the Vehicle Licence Number from the Drop down list or Add the new vehicle")</script>';
            }
        }
        #--------------------------------------------------------------------------------------------------------------------------------
        #checking if the form is submitteed or not  ,for VEHICLE
        if(isset($_POST["v_submit"])){

          $vehicle_type = $_POST["vehicle_type"];
          $vehicle_colour = $_POST["vehicle_colour"];
          $vehicle_licence = $_POST["vehicle_licence"];
          $people_licence = $_POST["people_licence"];
          
          $sql = "SELECT * FROM vehicle WHERE Vehicle_licence = '".$vehicle_licence."' ";                
          $result = mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)==0){
              $sql1 = "SELECT * FROM people WHERE People_licence = '".$people_licence."' ";
              $res = mysqli_query($conn,$sql1);

                if(mysqli_fetch_array($res)>0){
                        #for inserting into vehicle table
                        $query = "INSERT INTO vehicle VALUES('', '$vehicle_type','$vehicle_colour','$vehicle_licence')";
                        mysqli_query($conn,$query);
                        
                        $own = "SELECT * FROM vehicle WHERE Vehicle_licence = '".$vehicle_licence."' ";
                        $res_own = mysqli_query($conn,$own);
                        $row3 = mysqli_fetch_array($res_own);
                        $veh_id = $row3['Vehicle_ID'];
                        

                        $own1 = "SELECT * FROM people WHERE People_licence = '".$people_licence."' ";
                        $pep = mysqli_query($conn,$own1);
                        $row4 = mysqli_fetch_array($pep);
                        $pep_id = $row4['People_ID'];
                        
                        #for inserting into ownership table
                        $own_add = "INSERT INTO ownership VALUES('$pep_id','$veh_id')";
                        mysqli_query($conn,$own_add); 

                        #for inserting into the audit table
                        date_default_timezone_set('Europe/London');
                        $date1 = date("Y-m-d H:i:s");
                        $user1 = $_SESSION['username'];
                        $audit = "INSERT INTO audit VALUES ('','$user1','Insert','Vehicle','$vehicle_licence','$date1')";
                        mysqli_query($conn,$audit);

                        echo '<script>alert("Data Added Successfully")</script>'; 
                                     
                }

                else {
                    echo '<script>alert("Select the Persons Licence Number from the Drop down list or Add the new person")</script>';
                }

            }
            else{
                echo '<script>alert("Please Make sure the Vehicle Licence Number doesnot match to the data already present in the data")</script>';
            }
        }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Asap&display=swap" rel="stylesheet">
        <style> @import url('https://fonts.googleapis.com/css2?family=Asap&display=swap'); </style>
        <title>Traffic Police Website</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

  <body class="bg-light"  style="font-family: 'Asap', sans-serif;">
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
  <div class="row d-flex justify-content-center align-items-center">
    <div class="col-xl-6 offset-xl-1">
      <div class="col-xl-5 w-75">
          <form class="p-4" action="" method="post" autocomplete="off" >
                
              <div class="form-outline mb-4">
                <h6><label for="incident_date" class="form-label" >Incident Date </label></h6>
                <input type="date" name="incident_date" class="form-control form-control-sm" placeholder = "Enter the Date" required>
              </div>
                <div class="form-outline mb-4">
                <h6><label for="report" class="form-label">Incident Report </label></h6>
                <textarea id="report" name="report" rows="2" cols="30" class="form-control form-control-sm" placeholder = "Enter Report"> </textarea>
              </div>

                <div class="form-outline mb-4">
                <h6><label for="veh_lic" class="form-label">Vehicle's Licence </label></h6>
                <?php
                    # PHP code for drop down list to select form vehicle
                    $sql2 = "SELECT * FROM vehicle";
                    $result2 = mysqli_query($conn, $sql2);
                    
                    echo "<datalist id='list1'>";
                    while ($row = mysqli_fetch_array($result2)) {     
                        echo "<option> $row[Vehicle_licence] </option>";
                    }
                    echo "</datalist>";
                    echo "<input type='search' name = 'veh_lic' list = 'list1'/ class='form-control form-control-sm' placeholder = 'Select the Vehicles Licence Number' required>";
                        ?> 
                </div>



                <div class="form-outline mb-4">
                    <h6><label for="offence_id" class="form-label">Offence ID</label></h6>
                    <?php
                    #php code for drop down list to select from offences
                    $sql4 = "SELECT * FROM offence";
                    $result4 = mysqli_query($conn, $sql4);
                    
                    echo "<datalist id='list4'>";
                    while ($row = mysqli_fetch_array($result4)) {     
                        echo "<option> $row[Offence_ID] </option>";
                    }
                    echo "</datalist>";
                    echo "<input type='search' name='offence_id' list = 'list4'/ class='form-control form-control-sm' placeholder = 'Select the Offence ID' required>";
                        ?>
                </div>

        
              <button type="submit" class="btn btn-secondary btn-sm" name="i_submit">Submit</button>
            </form>
            <p class="small fw-bold mt-2 pt-1 mb-0">Does the vehicle exist in the database? If not Add them 
            <button type="button" class="btn btn-primary btn-sm" id="Vehicle_add_Button">Add Vehicle</button> </p>
      </div>
    </div>
  </div>
</div>





  <!-- Form for adding vehcile -->


<div class="container h-custom">
  <div class="row d-flex justify-content-center align-items-center">
    <div class="col-xl-6 offset-xl-1">
      <div class="col-xl-5 w-75">

          <form id="vehicle_form"class="p-4" action="" method="post" autocomplete="off" style="display:none;">
              
          <div class="form-outline mb-4">
          <h6><label for="vehicle_type" class="form-label">Vehicle's Type</label></h6>
              <input type="text" name="vehicle_type" required class="form-control form-control-sm" placeholder = "Enter Vehicle's Type">
                </div>
          <div class="form-outline mb-4">
          <h6><label for="vehicle_colour" class="form-label">Vehicle's Colour</label></h6>
              <input type="text" name="vehicle_colour" required class="form-control form-control-sm" placeholder = "Enter Vehicle's Colour">
                </div>
          <div class="form-outline mb-4">
          <h6><label for="vehicle_licence" class="form-label">Vehicle's Licence Number</label></h6>
              <input type="text" name="vehicle_licence" required class="form-control form-control-sm" placeholder = "Enter Vehicle's Licence Number">
                </div>   
              <div class="form-outline mb-4">
              <h6><label for="people_licence" class="form-label">Owner's Licence Number</label></h6>
                  <?php
                  
                  $sql = "SELECT * FROM people";
                  $result = mysqli_query($conn, $sql);
                  
                  echo "<datalist id='list'>";
                  while ($row = mysqli_fetch_array($result)) {     
                      echo "<option> $row[People_licence] </option>";
                  }
                  echo "</datalist>";
                  echo "<input type='search' name = 'people_licence' list = 'list'/ class='form-control form-control-sm' placeholder = 'Select Owners Licence Number'required>";
                      ?>  
                    </div>  
            </br>
            </br>
            <button type="submit" class="btn btn-secondary btn-sm"name="v_submit">Submit</button>
          </form>

          <p class="small fw-bold mt-2 pt-1 mb-0">Does the person exist in the database? If not Add them 
            <button type="button" class="btn btn-primary btn-sm" id="People_add_Button">Add People</button> </p>
      </div>
     </div>
  </div>
</div>

    <script>
$("#Vehicle_add_Button").click(function(){
        $("#vehicle_form").toggle();
    });
</script>

<!-- ------------------------------------------------------------------------------------- -->
<!-- Form For adding a person -->


<div class="container h-custom">
  <div class="row d-flex justify-content-center align-items-center">
    <div class="col-xl-6 offset-xl-1">
     <div class="col-xl-5 w-75">

        <form id="people_form" class="p-4" action="" method = "post" style="display:none;">

        <div class="form-outline mb-4">
          <h6><label for="people_name" class="form-label">Owner's name:</label></h6> 
          <input type="text" name="people_name" class="form-control form-control-sm" placeholder = "Enter Owners Name" required>
          </div>

          <div class="form-outline mb-4">
          <h6><label for="people_address" class="form-label">Owner's Address</label></h6>
          <input type="text" name="people_address" class="form-control form-control-sm" placeholder = "Enter Owners Address" required>
          </div>

          <div class="form-outline mb-4">
          <h6><label for="P_licence" class="form-label">Owner's Licence Number</label></h6>
          <input type="text" name="P_licence" class="form-control form-control-sm" placeholder = "Enter Owners Licence Number" required>
          </div>

          <button type="submit" class="btn btn-secondary btn-sm" id="submit1" name = "submit1">Submit</button>
        </form>

      </div>
    </div>
  </div>
</div>

<script>
$("#People_add_Button").click(function(){
        $("#people_form").toggle();
    });
</script>

<?php

if(isset($_POST["submit1"])){

  $people_name = $_POST["people_name"];
  $people_address = $_POST["people_address"];
  $p_licence = $_POST["P_licence"];

  $psql = "SELECT * FROM people WHERE People_licence = '".$p_licence."' ";
  $presult = mysqli_query($conn,$psql);
  if(mysqli_fetch_array($presult)==0){
     $pep = "INSERT INTO people VALUES('','$people_name','$people_address','$p_licence') ";
     mysqli_query($conn,$pep);

      #for inserting into the audit table
      date_default_timezone_set('Europe/London');
      $date1 = date("Y-m-d H:i:s");
      $user1 = $_SESSION['username'];
      $audit = "INSERT INTO audit VALUES ('','$user1','Insert','People','$p_licence','$date1')";
      mysqli_query($conn,$audit);

     
     echo '<script> alert("Data Inserted Successfully") </script>';

  }
  else{
     echo '<script> alert("The Persons Licence Number already exists in database") </script>';

  }


}




?>


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