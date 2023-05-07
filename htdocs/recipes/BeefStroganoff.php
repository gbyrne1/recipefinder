<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>Beef Stroganoff</h1>

        <div id="image">
             <img src="../images/BeefStroganoff.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul><li>1 lb egg noodles</li><li>1 lb beef sirloin, cut into thin strips</li><li>1 onion, chopped</li><li>2 cloves garlic, minced</li><li>1 cup beef broth</li><li>1 cup sour cream</li><li>2 tbsp flour</li><li>2 tbsp olive oil</li></ul>
        <br><h2>Instructions:</h2>
        <ol><li>Cook egg noodles according to package directions.</li><li>In a large skillet, heat olive oil over medium-high heat.</li><li>Add beef strips and cook until browned.</li><li>Add onion and garlic and cook until softened.</li><li>Sprinkle flour over the mixture and stir to combine.</li><li>Add beef broth and bring to a boil.</li><li>Reduce heat and simmer until sauce thickens.</li><li>Remove from heat and stir in sour cream.</li><li>Drain noodles and serve with beef stroganoff sauce.</li></ol>
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
			FROM BeefStroganoff
			WHERE (Comments <> '');");
                if ($reviews->num_rows > 0){
					echo "<div class='columns is-multiline'>";
                    while($row = $reviews->fetch_assoc()) {
                        echo "<div class='column is-one-third'>";
                        echo "<div class='card card-style is-warning'>";
                        echo "<div class='card-content is-fullwidth is-warning'>";
                        echo "<p class='title'>" . $row["Rating"] . " Stars</p></a>";
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
</html>