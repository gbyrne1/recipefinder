<!--
creates a new table w the current sql recipe structure
-->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "RecipeDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE Recipes (
	RecipeID int NOT NULL AUTO_INCREMENT,
	RecipeName varchar(255) NOT NULL,
	IngredientCount int,
	RecipePage varchar(255) NOT NULL,
	PRIMARY KEY (RecipeID),
	UNIQUE (RecipeName)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table Recipes created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?> 