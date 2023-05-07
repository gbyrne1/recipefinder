<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>Chicken Parmesan</h1>

        <div id="image">
             <img src="../images/ChickenParmesan.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul><li>1 lb spaghetti</li><li>1 lb boneless skinless chicken breasts cut into strips</li><li>1 cup all-purpose flour</li><li>2 eggs, beaten 1 cup panko bread crumbs</li><li>1/2 cup grated parmesan cheese</li><li>1/2 cup olive oil</li><li>1/2 cup grated mozzarella cheese</li><li>1/2 cup grated parmesan cheese</li></ul>
        <br><h2>Instructions:</h2>
        <ol><li>Cook spaghetti according to package directions.</li><li>Dip chicken strips in flour, then egg, then bread crumbs.</li><li>Heat olive oil in a large skillet over medium-high heat.</li><li>Add chicken strips and cook until golden brown.</li><li>Remove chicken from skillet and drain on paper towels.</li><li>Add spaghetti to skillet and toss with chicken.</li><li>Sprinkle with mozzarella and parmesan cheese.</li><li>Serve immediately.</li></ol>
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
			FROM ChickenParmesan
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