<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>Mackerel and Leek Hash</h1>

        <div id="image">
             <img src="../images/MackerelandLeekHash.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul><li>250g potatoes halved</li><li>2 tbsp oil, 2 large leeks thinly sliced</li><li>100g peppered smoked mackerel with skin removed</li><li>4 eggs</li></ul>
        <br><h2>Instructions:</h2>
        <ol><li>Put the potatoes in a microwaveable bowl with some water, cover, then cook for 5 mins until tender.</li><li>Heat the oil in a frying pan, add the leeks with a pinch of salt and cook for 10 mins, stirring until softened.</li><li>Tip in the potatoes, turn up the heat and fry for a couple of mins to crisp.</li><li>Flake through the mackerel.</li><li>Make four indents in the leek mixture in the pan, crack an egg into each, season, then cover the pan and cook for 6-8 mins until the whites have set and the yolks are runny.</li><li>Serve immediately.</li></ol>
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
			FROM MackerelandLeekHash
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