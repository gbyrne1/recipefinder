<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="/css/background.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<style>

body {
    background-image: url("/images/back.jpeg");
}

input[type=text], input[type=password], select {
  
  padding: 12px 20px;
  margin: 8px 0px;
  border: 1px solid #232423;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 10%;
  background-color: #334133;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 15px 19px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

html h1 {
  font-size: 30px;
  line-height: 1.5;
  font-family: helvetica;
}
</style>
</head>
<body>
  <div id="nav-placeholder">
    <?php include_once("nav.php"); ?>
  </div>

  <div class="column is-one-third is-offset-one-third">
    <h1>Sign Up</h1>
  <?php
	if (isset($_GET['error'])) {
		echo "<p style='color: red'>" . $_GET['error'] . "</p>";
	}
	?>
  <form class="box" method="POST" action="signup_handler.php">
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

      <button class="button is-primary" type="submit" name="submit">Sign up</button>
      
      <p>Already have an account? <a href="http://localhost/html/login.php">Log In</a></p>
    </form>
  </div>
</body>
</html>