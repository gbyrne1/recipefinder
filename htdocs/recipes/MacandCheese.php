<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>Mac and Cheese</h1>

        <div id="image">
             <img src="../images/MacandCheese.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul><li>8 oz box of elbow macaroni</li><li>1/4 cup butter</li><li>1/4 cup all-purpose flour</li><li>2 cups milk</li><li>2 cups shredded cheddar cheese</li><li>salt and pepper</li></ul>
        <br><h2>Instructions:</h2>
        <ol><li>Bring a pot of lightly salted water to a boil.</li><li>Cook elbow macaroni in the boiling water, stirring occasionally, 8 minutes.</li><li>Melt butter in a saucepan.</li><li>Add flour, salt, and pepper and stir until smooth, about 5 minutes.</li><li>Pour in milk while stirring, continue to cook and stir until mixture is smooth and bubbling, about 5 minutes, making sure the milk doesn't burn.</li><li>Add cheddar cheese and stir until melted, 2-4 minutes.</li><li>Drain macaroni and fold into cheese sauce until coated.</li><li>Serve immediately.</li></ol>
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
			FROM MacandCheese
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