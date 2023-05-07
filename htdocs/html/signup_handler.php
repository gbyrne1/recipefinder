<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);
echo "test connection";
// Check if the login form was submitted
if (isset($_POST["submit"])) {
  // Get the email and password entered by the user
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Query the RegUsers table to check if there is a matching email and password combination
  $sql = "SELECT * FROM RegUsers WHERE Email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // redirect to the login page
   
    header("Location: ./login.php?error=Account%20already%20exists");
    exit();
  } else {
    // If there is no matching email,create one
    $sql="INSERT INTO RegUsers (Email,Password) VALUES ('$email','$password')";
    $result = $conn->query($sql);
    $_SESSION["email"] = $email;
    header("Location: ../");
    
  }
}
?>