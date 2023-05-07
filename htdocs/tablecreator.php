<!--
store this file and recipes.json in the htdocs folder and run this file after starting your web server at localhost/recipejsoninput.php  
requires database called: RecipeDB
you can change $dbname on line15 if you have a different database name in your mysql db
 

TODO:
 
-->
<?php

//variables for sql connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the RegUsers table exists
$result = $conn->query("SHOW TABLES LIKE 'RegUsers'");
if ($result->num_rows == 0) {
  // Create the RegUsers table if it doesn't exist
  $sql = "CREATE TABLE RegUsers (
    Email varchar(255),
    Password varchar(255) NOT NULL,
    PRIMARY KEY (Email)
  )";
  if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
  }
}

//create recipe table if it doesnt exist
$tableExists = $conn->query("SHOW TABLES LIKE 'Recipes'");
if($tableExists->num_rows == 0){
$sql = "CREATE TABLE Recipes (
	RecipeName varchar(255) NOT NULL,
	RecipePage varchar(255) NOT NULL,
  Rating DOUBLE(2,1),
	PRIMARY KEY (RecipeName),
	UNIQUE (RecipeName)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table Recipes created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error;
}
}


//create foodgroup table if it doesnt exist
//cant use group as a column name because it is a reserved word
$tableExists = $conn->query("SHOW TABLES LIKE 'FoodGroups'");
if($tableExists->num_rows == 0){
$sql = "CREATE TABLE FoodGroups (
	FoodGroup varchar(255) NOT NULL,
	PRIMARY KEY (FoodGroup),
  UNIQUE (FoodGroup)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table FoodGroups created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error;
}
}

//create ingredients table if it doesnt exist
$tableExists = $conn->query("SHOW TABLES LIKE 'Ingredients'");
if($tableExists->num_rows == 0){
$sql = "CREATE TABLE Ingredients (
	Ingredient varchar(255) NOT NULL,
	FoodGroup varchar(255) NOT NULL,
	PRIMARY KEY (Ingredient),
	FOREIGN KEY (FoodGroup) REFERENCES FoodGroups(FoodGroup)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table Ingredients created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error;
}
}

//create recipeingredients table if it doesnt exist
$tableExists = $conn->query("SHOW TABLES LIKE 'RecipesIngredients'");
if($tableExists->num_rows == 0){
$sql = "CREATE TABLE RecipesIngredients (
	RecipeName varchar(255) NOT NULL,
	Ingredient varchar(255) NOT NULL,
  FOREIGN KEY (RecipeName) REFERENCES Recipes(RecipeName),
	FOREIGN KEY (Ingredient) REFERENCES Ingredients(Ingredient)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table RecipeIngredients created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error;
}
}

// Check if the Fridge table exists
$result = $conn->query("SHOW TABLES LIKE 'Fridge'");
if ($result->num_rows == 0) {
  // Create the Fridge table if it doesn't exist
  $sql = "CREATE TABLE Fridge (
    Ingredient varchar(255) NOT NULL,
    Email varchar(255),
    FOREIGN KEY (Ingredient) REFERENCES Ingredients(Ingredient),
    FOREIGN KEY (Email) REFERENCES RegUsers(Email),
	CONSTRAINT PK_Person PRIMARY KEY (Ingredient, Email)
  )";
  if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
  }
}

// specify the path to JSON file
$jsonFilePath = 'recipes.json';

// read the JSON file into a string
$jsonString = file_get_contents($jsonFilePath);

// decode the JSON string into a PHP object
$data = json_decode($jsonString);

//tracker variable for amount of recipes added
$addedrecipes=0;
// loop through each recipe object
foreach ($data->recipes as $recipe) {
	$recipename = str_replace(' ', '', $recipe->recipename);
	//checks if recipe is in db already
	$sql_check = "SELECT * FROM Recipes WHERE RecipeName = '$recipe->recipename'";
$result = $conn->query($sql_check);
if ($result->num_rows > 0) {
    //recipe already exists
    echo "Recipe ".$recipe->recipename." already exists in database<br>";
  } else {

    //makes url name from recipename
    $urlname = $recipename . '.php';
    $relativeurlname="recipes/".$urlname;

//data includes all formatting for instruction page
$data = '<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>' . $recipe->recipename . '</h1>

        <div id="image">
             <img src="../images/' . $recipename . '.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul>';
foreach ($recipe->ingAmount as $ingredient) {
    $data .= '<li>' . $ingredient . '</li>';
}
$data .= '</ul>
        <br><h2>Instructions:</h2>
        <ol>';
foreach ($recipe->recipetext as $instruction) {
    $data .= '<li>' . $instruction . '</li>';
}
$data .='</ol>
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
		
		$reviews = $conn->query("SELECT Rating, Comments, User
			FROM ' . $recipename . '
			WHERE (Comments <> \'\');");
                if ($reviews->num_rows > 0){
					echo "<div class=\'columns is-multiline\'>";
                    while($row = $reviews->fetch_assoc()) {
                        echo "<div class=\'column is-one-third\'>";
                        echo "<div class=\'card card-style is-warning\'>";
                        echo "<div class=\'card-content is-fullwidth is-warning\'>";
                        echo "<p class=\'title\'>" . $row["Rating"] . " Stars</p></a>";
                        echo "<p>" . $row["Comments"] . "</p>";
						echo "<p>User: " . $row["User"] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
				}
		else {
			echo "No comments yet. Be the first!";
		}
		
		
        // Close the database connection
        $conn->close();
    ?>
</body>
</html>';

file_put_contents('recipes/'.$urlname, $data);

    //counts ingredients
    $ingredientcount = count($recipe->ingredients);

    // sql to insert into table, adds recipe to recipe table
$sql = "INSERT INTO Recipes (RecipeName, RecipePage, Rating)
VALUES (
'$recipe->recipename',
'$relativeurlname',
0)";
if ($conn->query($sql) === TRUE) {
echo  "<br><br> Recipe ".$recipe->recipename." stored successfully in recipe table<br>";
$addedrecipes++;
} else {
echo "Error creating recipe: " . $conn->error;
}

   //makes ingredients tables/adds recipes to them
   foreach ($recipe->ingredients as $ingredient) {
    $name = $ingredient->name;
    $foodgroup = $ingredient->foodGroup; 


    $selectsql = "SELECT * FROM FoodGroups WHERE FoodGroup = '$foodgroup'";
    $result = $conn->query($selectsql);
if ($result->num_rows < 1) {
    $foodgroupSql = "INSERT INTO FoodGroups (Foodgroup) VALUES ('$foodgroup')";
    if ($conn->query($foodgroupSql) === TRUE) {
        echo "Group added: " . $foodgroup . "<br>";
    } else {
        echo "Error creating row: " . $conn->error;
    }}
      
    $selectsql = "SELECT * FROM Ingredients WHERE Ingredient = '$name'";
    $result = $conn->query($selectsql);
if ($result->num_rows < 1) {
    $ingredientSql = "INSERT INTO Ingredients (Ingredient, Foodgroup) VALUES ('$name', '$foodgroup')";
    if ($conn->query($ingredientSql) === TRUE) {
        echo "Ingredient added successfully: " . $name . "<br>";
    } else {
        echo "Error creating row: " . $conn->error;
    }}
        
        // Insert recipe into table
        $insertsql = "INSERT INTO RecipesIngredients (RecipeName, Ingredient) VALUES ('$recipe->recipename', '$name')";
        if ($conn->query($insertsql) === TRUE) {
          echo  " Row inserted successfully for" .$recipe->recipename."-". $name."<br>";
        } else {
          echo "Error creating row: " . $conn->error;
        }
      

}


        // Check if recipe rating table already exists  

        $tableExists = $conn->query("SHOW TABLES LIKE '$recipe->recipename'");
        if($tableExists->num_rows == 0){
  //creates rating table for each recipe
  //,
	//PRIMARY KEY (User),
	//FOREIGN KEY (User) REFERENCES RegUsers(Email)
  $sql = "CREATE TABLE `$recipename` (
    User varchar(255),
	Rating Double (2,1) NOT NULL DEFAULT 0.0,
	Comments varchar(255),
  PRIMARY KEY (User),
  FOREIGN KEY (User) REFERENCES RegUsers(Email)
  )";
  if ($conn->query($sql) === TRUE) {
    echo  " Rating table inserted successfully for " . $recipe->recipename."<br>";
  } else {
    echo "Error creating row: " . $conn->error;
  }
} 
   
}}

//prints amount of recipes added/total recipes in db
echo $addedrecipes." recipes added.<br>";
$sql_check = "SELECT * FROM Recipes";
$result = $conn->query($sql_check);
echo ($result->num_rows)." recipes in database"; 
    
  
?>