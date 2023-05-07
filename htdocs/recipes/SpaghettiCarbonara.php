<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>Spaghetti Carbonara</h1>

        <div id="image">
             <img src="../images/SpaghettiCarbonara.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul><li>1 lb spaghetti</li><li>8 oz pancetta diced </li><li>3 large eggs</li><li>1/2 cup grated parmesan cheese</li></ul>
        <br><h2>Instructions:</h2>
        <ol><li>Cook spaghetti according to package directions.</li><li>Cook pancetta in a large skillet until crispy.</li><li>Whisk eggs and parmesan cheese in a bowl.</li><li>Drain spaghetti and add to skillet with pancetta.</li><li>Remove skillet from heat and add egg mixture, tossing quickly to avoid scrambling the eggs.</li><li>6. Serve immediately.</li></ol>
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
			FROM SpaghettiCarbonara
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