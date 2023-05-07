<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>Gnocchi Cacio e Pepe</h1>

        <div id="image">
             <img src="../images/GnocchiCacioePepe.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul><li>300g gnocchi</li><li>2 tbsp unsalted butter</li><li>60g parmesan</li><li>2 tsp black pepper</li></ul>
        <br><h2>Instructions:</h2>
        <ol><li>Cook the gnocchi in a pan of lightly salted, boiling water.</li><li>Drain and reserve 200ml of the cooking water.</li><li>Heat the butter in a frying pan.</li><li>Add the gnocchi, cheese and pepper as well as 150ml of the cooking water, raise the heat a little and stir until melted and the gnocchi is well coated.</li><li>Season with salt.</li><li>Transfer the gnocchi to bowls and serve.</li></ol>
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
			FROM GnocchiCacioePepe
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