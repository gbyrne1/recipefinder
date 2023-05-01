<?php
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

// Create stored procedures
$create_criteria_query = "CREATE PROCEDURE create_criteria()
	 BEGIN
	 CREATE TEMPORARY TABLE Criteria (
        Ingredient varchar(255) NOT NULL
       
    );
	 END;";
$conn->query($create_criteria_query);

$insert_criteria_query = "CREATE PROCEDURE insert_criteria(IN ingred varchar(255))
	 BEGIN
	    INSERT INTO Criteria (Ingredient)
	    VALUES (ingred);
	 END;";
$conn->query($insert_criteria_query);

$inclusive_search_query = "CREATE PROCEDURE inclusive_search()
	BEGIN
	    SELECT DISTINCT recipes.* FROM ((recipes
	    INNER JOIN RecipesIngredients ON recipes.RecipeName = RecipesIngredients.RecipeName)
	    INNER JOIN Criteria ON RecipesIngredients.Ingredient = Criteria.Ingredient);
	 END;";
$conn->query($inclusive_search_query);

$exclusive_search_query = "CREATE PROCEDURE exclusive_search()
	 BEGIN
	    CREATE TEMPORARY TABLE SearchResults AS
		SELECT DISTINCT recipes.* FROM recipes INNER JOIN recipesingredients ON recipes.RecipeName = recipesingredients.RecipeName;
    DELETE FROM SearchResults
        WHERE NOT RecipeName in 
        (SELECT DISTINCT RecipeName FROM SearchResults WHERE Ingredient in (SELECT DISTINCT Ingredient FROM Criteria));
    SELECT * FROM SearchResults;
END;";
$conn->query($exclusive_search_query);


$conn->close();
?>
