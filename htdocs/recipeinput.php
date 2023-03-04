<!--
  TODO:
  Add ingredient empty error
  Add Ingredient Data Structure
  Add ingredient counter
  Add ingredient input box
  Add ingredient 
  Add update recipe
-->
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$recipenameErr = $instructionsErr = "";
$recipename = $instructions = $urlname= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["recipename"])) {
    $recipenameErr = "Recipe name is required";
  } else {
    $recipename = test_input($_POST["recipename"]);
    // check if recipename only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$recipename)) {
      $recipenameErr = "Only letters and white space allowed";
    }
  }
  
 
    

  if (empty($_POST["instructions"])) {
    $instructionsErr = "Instructions required";
  } else {
    $instructions = test_input($_POST["instructions$instructions"]);
  }
}

 

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Recipe Input</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Recipe Name: <input type="text" name="recipename">
  <span class="error">* <?php echo $recipenameErr;?></span>
  <br><br>
  Instructions: <textarea name="instructions" rows="4" cols="50"></textarea>
  <span class="error">* <?php echo $instructionsErr;?></span>
 
  <br><br>
  <input type="submit" name="submit" value="Submit">  
  <br><br>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$urlname = str_replace(' ', '', $recipename);
$urlname.='.html';

$data = "<h1>Recipe Name: $recipename</h1><p>Instructions:<br><br> $instructions</p>";
file_put_contents('recipes/'.$urlname, $data);

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

// sql to insert into table recipeid stays null bc its auto incremented
$sql = "INSERT INTO Recipes (RecipeID, RecipeName, IngredientCount, RecipePage)
	VALUES (NULL,
	'$recipename',
	NULL,
	'$urlname')";

if ($conn->query($sql) === TRUE) {
  echo  " Recipe stored successfully at /recipes/". $urlname;
} else {
  echo "Error creating recipe: " . $conn->error;
}

$conn->close();

}
?>


</body>
</html>
