<!--
  //requires prior RecipeDB and recipe table for functionality
  TODO:
  Change Ingredient Data Structure
  Add ingredient counter
  Add ingredient input box
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
$recipename = $instructions = $urlname= $ingredient =  "";

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
  
  if (empty($_POST["ingredient"])) {
    $ingredient = "";
  } else {
    $ingredient = test_input($_POST["ingredient"]);
  }


    

  if (empty($_POST["instructions"])) {
    $instructionsErr = "Instructions required";
  } else {
    $instructions = test_input($_POST["instructions"]);
  }
}

 
//gets rid of leading/trailing whitespace and slashes
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
  Ingredient: <input type="text" name="ingredient">
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


//data includes all formatting for instruction page
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

$relativeurlname="recipes/".$urlname;

// sql to insert into table recipeid stays null bc its auto incremented
$sql = "INSERT INTO Recipes (RecipeID, RecipeName, IngredientCount, RecipePage)
	VALUES (NULL,
	'$recipename',
	NULL,
	'$relativeurlname')";

if ($conn->query($sql) === TRUE) {
  echo  " Recipe stored successfully at /recipes/". $urlname;
} else {
  echo "Error creating recipe: " . $conn->error;
}

  

//for ingriendent {if no table }

$ingredientsql= "CREATE TABLE `".$ingredient."` LIKE Recipes";

if ($conn->query($ingredientsql) === TRUE) {
  echo  " Table stored successfully at ". $ingredient;
} else {
  echo "Error creating table: " . $conn->error;
}


//SELECT * FROM Recipes WHERE Recipename='`".$recipename."`'
$insertsql= "INSERT INTO `".$ingredient."` SELECT * FROM Recipes WHERE RecipeName='`".$recipename."`'";

if ($conn->query($insertsql) === TRUE) {
  echo  " Row inserted successfully at ". $ingredient;
} else {
  echo "Error creating row: " . $conn->error;
}


$conn->close();

}
?>


</body>
</html>
