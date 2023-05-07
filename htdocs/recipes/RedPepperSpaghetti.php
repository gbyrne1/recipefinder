<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>Red Pepper Spaghetti</h1>

        <div id="image">
             <img src="../images/RedPepperSpaghetti.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul><li>1 roasted red pepper</li><li>30ml olive oil</li><li>50g toasted walnuts</li><li>1 small garlic clove</li><li>100g spaghetti</li><li>parmesan</li></ul>
        <br><h2>Instructions:</h2>
        <ol><li>Thoroughly chop the roasted red pepper with the olive oil, walnuts and garlic in a food processor, season well and set aside.</li><li>Heat a pan of salted water to boil, add the pasta and cook for 1 min less than the pack instructions and drain, reserving a ladleful of cooking water.</li><li>Tip the pasta back into the pan, along with the reserved cooking water and red pepper sauce, and return to the heat to warm through.</li><li>Tip the pasta into a bowl and top with the parmesan and some chopped toasted walnuts.</li><li>Season and serve.</li></ol>
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
			FROM RedPepperSpaghetti
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