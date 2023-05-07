<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="/css/background.css">
 

<style>
body {
    background-image: url("/images/back2.jpeg");
}
</style>
</head>

<body>
  <div id="nav-placeholder">
    <?php include_once("nav.php"); ?>
  </div>


  <div class="column is-one-third is-offset-one-third">
  <?php
	if (isset($_GET['error'])) {
		echo "<p style='color: red'>" . $_GET['error'] . "</p>";
	}
	?>
  <form class="box" method="POST" action="login_handler.php">
      <div class="field">
        <label class="label">Email</label>
        <div class="control">
          <input class="input" type="email" name="email" placeholder="e.g. alex@example.com">
        </div>
      </div>

      <div class="field">
        <label class="label">Password</label>
        <div class="control">
          <input class="input" type="password" name="password" placeholder="********">
        </div>
      </div>

      <button class="button is-primary" type="submit" name="submit">Sign in</button>
      
      <div>Don't have an account? 
        <a href="http://localhost/html/signup.php">Sign up</a>
      </div>
    </form>
  </div>
  
</body>
</html>