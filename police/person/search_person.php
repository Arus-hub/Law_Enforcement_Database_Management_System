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
<body  class="bg-light" style="font-family: 'Asap', sans-serif;">
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
<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-7 col-lg-5 col-xl-3">
                    <form action="" method="GET" class="d-flex" role="search">
                        
                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Enter Owner's Licence Number">
                        <button type="submit" class="btn btn-secondary">Search</button>
                        
                    </form>
            </div>
        
        <div class="col-md-8 col-lg-6 col-xl-7 offset-xl-1">
        <?php                
                if(isset($_GET['search']))
                { ?>
        <table class="table table-striped table-bordered border-5 border-dark">
            <thead class="table-dark">
                <tr>
                    
                    <th>Owner's Name</th>
                    <th>Address</th>
                    <th>Owner's Licence Number</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                    $value = $_GET['search'];
                    $query = "SELECT * FROM people WHERE CONCAT(People_name,People_licence) LIKE '%$value%'";
                    $result = mysqli_query($conn,$query);

                    date_default_timezone_set('Europe/London');
                    $date1 = date("Y-m-d H:i:s");
                    $user1 = $_SESSION['username'];
                    $audit = "INSERT INTO audit VALUES ('','$user1','Search','People','$value','$date1')";
                    mysqli_query($conn,$audit);

                    if(mysqli_num_rows($result)>0)
                    {
                        foreach($result as $items)
                        {
                            ?>
                            <tr>
                            
                            <td><?= $items['People_name']; ?></td>
                            <td><?= $items['People_address']; ?></td>
                            <td><?= $items['People_licence']; ?></td>

                            <?php
                        }

                    }
                    else
                    { 
                        ?>
                           <tr>
                            <td> No Record Found </td>
                           </tr>

                        <?php

                    }
                }
                ?>
                <tr>

                </tr>
            </tbody>
        </table>

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

