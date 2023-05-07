<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>Chicken Alfredo</h1>

        <div id="image">
             <img src="../images/ChickenAlfredo.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul><li>1 lb fettuccine</li><li>1 lb boneless skinless chicken breasts cut into strips</li><li>2 cloves garlic, minced </li><li>2 cups heavy cream</li><li>1 cup grated parmesan cheese</li></ul>
        <br><h2>Instructions:</h2>
        <ol><li>Cook fettuccine according to package directions.</li><li>Cook chicken in a large skillet until no longer pink.</li><li>Add garlic and cook for 1 minute.</li><li>Add heavy cream and parmesan cheese and cook until thickened.</li><li>Drain fettuccine and add to skillet with sauce. 6. Serve immediately.</li></ol>
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
			FROM ChickenAlfredo
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