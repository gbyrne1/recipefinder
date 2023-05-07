<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <link rel="stylesheet" href="/css/recipeFormat.css">
    </head>
    <body>
        <h1>Smoked Salmon and Spinach Gratin</h1>

        <div id="image">
             <img src="../images/SmokedSalmonandSpinachGratin.png" alt="">
        </div>

        <br><h2>Ingredients:</h2>
        <ul><li>1.2kg spinach</li><li>15g butter</li><li>6 lightly smoked raw salmon fillets with skin removed</li><li>300ml double cream</li></ul>
        <br><h2>Instructions:</h2>
        <ol><li>Put the spinach in a saucepan and add a few tablespoons of water.</li><li>Cover, set over a medium heat and cook for 5-8 mins, turning the spinach over occasionally until wilted.</li><li>Tip it into a colander to drain and allow it to cool.</li><li>Take handfuls of it and squeeze out excess water.</li><li>Chop the spinach, melt the butter in a saucepan and toss the spinach in it.</li><li>Season with pepper and salt.</li><li>Heat the oven to 140C, lay the spinach in the bottom of a gratin dish, then arrange the salmon fillets on top.</li><li>Heat the double cream in a pan, then pour it over the salmon and spinach.</li><li>Bake for 35 mins, or until the top is golden and the cream is bubbling.</li><li>Serve immediately.</li></ol>
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
			FROM SmokedSalmonandSpinachGratin
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