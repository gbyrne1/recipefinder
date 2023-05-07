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
  $sql = "SELECT * FROM RegUsers WHERE Email='$email' AND Password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Start a session for the user and redirect to the home page
    $_SESSION["email"] = $email;
    header("Location: ../");
    exit();
  } else {
    // If there is no matching email and password combination, show an error message
    
    header("Location: ./login.php?error=Invalid%20email%20or%20password");
    echo "Invalid email or password";
  }
}
?>