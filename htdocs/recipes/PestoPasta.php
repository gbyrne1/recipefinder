<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>Pesto Pasta</h1>

        <div id="image">
             <img src="../images/PestoPasta.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul><li>1 lb pasta</li><li>2 cups fresh basil leaves</li><li>1/2 cup grated parmesan cheese</li><li>1/2 cup pine nuts</li><li>2 garlic cloves</li><li>1/2 cup olive oil</li></ul>
        <br><h2>Instructions:</h2>
        <ol><li>Cook pasta according to package directions.</li><li>In a food processor, combine basil, parmesan cheese, pine nuts, and garlic.</li><li>Pulse until ingredients are finely chopped.</li><li>Gradually add olive oil and continue pulsing until a paste is formed.</li><li>Drain pasta and toss with pesto sauce.</li><li>Serve immediately.</li></ol>
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
			FROM PestoPasta
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