<?php
 
$sname = "localhost";
$uname = "root";
$password = "";
$dbname = "check";

$conn = mysqli_connect($sname,$uname,$password,$dbname);

if(!$conn){
   echo "Unable to connect";
   exit();
}


?>
