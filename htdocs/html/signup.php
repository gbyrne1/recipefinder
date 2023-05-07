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
  width: 20%;
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




<!-- sign up -->
  <div class="container" style="text-align:center">
    <h1>Sign Up</h1>
	
	<!-- input boxes-->
    <label for="email"><b>Email<br></b></label>
    <input type="text" placeholder="Enter Email" name="email" required>
	
	<br><br>
    <label for="uname"><b>Username<br></b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
	
	<br><br>
    <label for="psw"><b>Password<br></b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
	
    <br><br>
	<!--login button, does nothing-->
    <input type="submit" value="Sign Up">
	<!--link back to login page-->
	<p>Already have an account? <a href="login.html">Log In</a></p>
  </div>
</body>
</html>