<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
 

<style>

</style>
</head>
<body>

<div id="nav-placeholder">
    <?php include_once("nav.php"); ?>
  </div>

 <?php
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }




        // Query the database for all ingredients
        $sql = "SELECT * FROM Recipes ORDER BY Rating DESC;";
        $result = $conn->query($sql);
  
    // Create an array of categories and their ingredients
        $categories = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              
                echo "<div class='card card-style is-warning '>";
                    echo "<div class='card-content is-fullwidth is-warning'>";
                    echo "<a href='../" . $row["RecipePage"] . "'><p class='title'>" . $row["RecipeName"] . "</p></a>";
                    if (isset($row["Rating"])) {
                        echo "<p>Rating: " . $row["Rating"] . "</p>";
                    } else {
                        echo "<p>No rating available</p>";
                    }
                    echo "</div>";
                    echo "</div>";
 echo "</div>";
             } }
?>