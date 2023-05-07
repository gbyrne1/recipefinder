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

//inserts the fridge into the search criteria if enabled
//write as "fridge_display('$User')"
$include_fridge = "CREATE PROCEDURE include_fridge(IN user varchar(255))
	 BEGIN
	 INSERT INTO Criteria SELECT Ingredient FROM Fridge WHERE Fridge.Email = user;
	 END;";
$conn->query($include_fridge);

$inclusive_search_query = "CREATE PROCEDURE inclusive_search()
	BEGIN
	    SELECT DISTINCT recipes.* FROM ((recipes
	    INNER JOIN RecipesIngredients ON recipes.RecipeName = RecipesIngredients.RecipeName)
	    INNER JOIN Criteria ON RecipesIngredients.Ingredient = Criteria.Ingredient)
		ORDER BY Rating DESC;
	 END;";
$conn->query($inclusive_search_query);

$exclusive_search_query = "CREATE PROCEDURE exclusive_search()
	BEGIN
	CREATE TEMPORARY TABLE SearchResults AS SELECT * FROM RecipesIngredients;
	
	DELETE FROM SearchResults WHERE RecipeName IN (SELECT RecipeName FROM SearchResults WHERE SearchResults.Ingredient NOT IN
		(SELECT DISTINCT SearchResults.Ingredient FROM SearchResults INNER JOIN Criteria 
		ON SearchResults.Ingredient = Criteria.Ingredient));
	
	SELECT DISTINCT recipes.* FROM (recipes
	    INNER JOIN SearchResults ON recipes.RecipeName = SearchResults.RecipeName) 
		ORDER BY Rating DESC;
	
    END;";
$conn->query($exclusive_search_query);
/*
//Write as "comment_create('$recipename', '$User', rating, comment)
$comment_create = "CREATE PROCEDURE comment_create(IN recipe varchar(255), cUser varchar(255), cRating Double (2, 1), cComment varchar(255))
	 BEGIN
		INSERT INTO recipe (User, Rating, Comment) VALUES (cUser, cRating, cComment);
	 END;";
$conn->query($comment_create);

//Write as "comment_display('$recipename')
$comment_display = "CREATE PROCEDURE comment_display(IN recipecom varchar(255))
	 BEGIN
	    SELECT Rating, Comments, User
		FROM recipecom
		WHERE (Comments <> '');
	 END;";
$conn->query($comment_display);
*/
//creates user fridge
//Write as "fridge_create('$User')"
$fridge_add = "CREATE PROCEDURE fridge_add(IN user varchar(255), ingred varchar(255))
	 BEGIN
	    INSERT IGNORE INTO Fridge (Email, Ingredient) VALUES (user, ingred);
	 END;";
$conn->query($fridge_add);
//Write as "fridge_display('$User')"
$fridge_display = "CREATE PROCEDURE fridge_display(IN user varchar(255))
	 BEGIN
	    SELECT FoodGroup,Fridge.Ingredient
		FROM Ingredients
		INNER JOIN Fridge ON Ingredients.Ingredient = Fridge.Ingredient 
		WHERE Fridge.Email = user;
	 END;";
$conn->query($fridge_display);

$conn->close();
?>