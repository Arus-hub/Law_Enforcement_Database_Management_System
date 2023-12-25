<?php
session_start();
include "db_connect.php";

if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["check"])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
      
    $uname = validate($_POST["username"]);
    $pass = validate($_POST["password"]);

} 


$sql = "SELECT * FROM admin WHERE username = '$uname' AND password = '$pass'";
$error = "Username Or Password Incorrect";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)===1) {
    $row = mysqli_fetch_assoc($result);
    if($row['username'] === $uname && $row['password'] === $pass){
        echo "Logged IN..!";
        $_SESSION['username'] = $row['username'];
        header("Location: admin_home.php");
        exit();
    }
    else{
        $_SESSION["error"] = $error;
        header("Location: ..\Police\admin_index.php?error = Login error");
        exit();
    }
}
else{
    $_SESSION["error"] = $error;
    header("Location: ..\Police\admin_index.php"); 
    exit();
}


?>