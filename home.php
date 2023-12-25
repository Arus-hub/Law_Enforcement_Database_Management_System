<?php
session_start();


if(isset($_SESSION['username'])){
?>

     <!Doctype html>
     <html>
     <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home Page</title>
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Martian+Mono&display=swap" rel="stylesheet">
        <style> @import url('https://fonts.googleapis.com/css2?family=Martian+Mono&display=swap'); </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="bg-light" style="font-family: 'Martian Mono', monospace;">
<nav class="navbar navbar-expand-lg py-3 navbar-dark bg-dark" style="font-family: 'Martian Mono', monospace;">
    <div class="container-fluid" style="padding-right: 130px; padding-left: 30px;">
            
            <a class="navbar-brand" href="home.php">
            <img src="img/icon.png" alt="Bootstrap" width="60" height="55">
            </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
             
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Add New
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="police\incident\add_incident.php"> Add Incident </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="police\vehicle\add_vehicle.php"> Add Vehicle </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="police\person\add_person.php"> Add Person </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Search
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="police\incident\search_incident.php"> Search Incident </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="police\vehicle\search_vehicle.php"> Search Vehicle </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="police\person\search_person.php"> Search Person </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Edit
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="police\incident\edit_incident.php"> Edit Incident </a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Options
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="police\change_pass.php"> Change the Password </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php"> Logout </a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>

            
        <div class="container- fluid">
           <h1 class="animate__animated animate__zoomInDown animate__delay-0.5s py-5" style=" padding-left: 70px;"> Hello , <?php echo $_SESSION['username'];?></h1>
        <div>   
           
           
           
          
           
           
           
           


           <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    </body>
    </html>
<?php
}
else{
    header("Location: index.php");
    exit();
}
?>