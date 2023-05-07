<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);

    $_SESSION["email"] = null;
   
   
    
    header("Location: http://localhost/html/login.php");
    
    $conn->close();

?>