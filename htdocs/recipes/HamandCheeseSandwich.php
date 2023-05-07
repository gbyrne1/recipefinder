<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>Ham and Cheese Sandwich</h1>

        <div id="image">
             <img src="../images/HamandCheeseSandwich.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul><li>2 slices of white bread</li><li>2 tbsp unsalted butter</li><li>2 thin slices of cooked ham</li><li>2 slices of american cheese</li></ul>
        <br><h2>Instructions:</h2>
        <ol><li>Spread some butter on top of each slice of bread, place the ham and cheese on a slice of bread and then top with the other bread slice.</li><li>Melt the remaining butter in a skillet over medium-high heat.</li><li>Place the sandwich in the skillet and let it cook, flipping once, until golden brown, about 3 minutes per side.</li><li>Serve immediately.</li></ol>
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
			FROM HamandCheeseSandwich
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