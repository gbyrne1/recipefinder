<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="/css/background.css">
   
    <title>Fridge</title>

    <style>
        body {
            background-image: url("/images/fridge_background.jpg");
        }
    </style>
</head>
<body>
<div id="nav-placeholder">
    <?php include_once("nav.php"); ?>
  </div>
  <div class="section has-text-centered">
      <h2 class="title is-1 has-text-grey-dark">Fridge Contents</h2>
  </div>
  <?php
	$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";
        $conn = new mysqli($servername, $username, $password, $dbname);
	if(isset($_SESSION["email"])){
                $email = $_SESSION["email"];
            }
	$fridge = $conn->query("CALL fridge_display('$email')");
	if ($fridge->num_rows > 0){
		echo "<div class='columns is-multiline'>";
		$group = 'start';
		while($row = $fridge->fetch_assoc()) {
			if($group != $row["FoodGroup"]){
				if($group != 'start'){
					echo "</div>";
					echo "</div>";
					echo "</div>";
				}
				echo "<div class='column is-one-third'>";
				echo "<div class='card card-style is-warning'>";
				echo "<div class='card-content is-fullwidth is-warning'>";
				echo "<p class='title'>" . $row["FoodGroup"] . "</p></a>";
				$group = $row["FoodGroup"];
			}
			echo "<p>" . $row["Ingredient"] . "</p>";
		}
		echo "</div>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
	}
	else {
		echo "Your Fridge is empty.";
	}
$conn -> close();
?>
<div class="section has-text-centered">
      <h2 class="title is-1 has-text-grey-dark">Add to Fridge</h2>
  </div>
  <div class="column has-text-centered">
    <?php include_once("ingredientselector.php"); ?>
  </div>
  