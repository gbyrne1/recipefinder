<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>Scrambled Eggs</h1>

        <div id="image">
             <img src="../images/ScrambledEggs.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul><li>8 eggs</li><li>2 tbsp unsalted butter</li><li>salt and pepper</li></ul>
        <br><h2>Instructions:</h2>
        <ol><li>Lightly beat the eggs with salt and pepper in a bowl.</li><li>Melt 1 tablespoon of the butter in a skillet over low heat; swirl to coat the bottom and sides.</li><li>Cook the eggs until most of the liquid has thickened and the eggs are soft, about 10 minutes.</li><li>Remove and add the last tablespoon of butter.</li><li>Serve.</li></ol>
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
			FROM ScrambledEggs
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