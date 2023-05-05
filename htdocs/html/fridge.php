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
  <div class="column has-text-centered">
    
    <h2 class="title is-3">Add to your Fridge</h2>
    <?php include_once("ingredientselector.php"); ?>
  </div>
  
    
</body>
</html>