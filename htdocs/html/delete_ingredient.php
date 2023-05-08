<?php session_start(); ?>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['ingredient']) &&  isset($_SESSION["email"])){
        $ingredient = $_POST['ingredient'];
        $email = $_POST['email'];
    
        $stmt = $conn->prepare("DELETE FROM fridge WHERE Email = ? AND Ingredient = ?");
        $stmt->bind_param("ss", $email, $ingredient);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            header("Location: http://localhost/html/fridge.php");
        } else {
            echo "No matching ingredient found.";
        }
    } else {
        echo "Invalid parameters.";
    }

    $conn->close();
?>