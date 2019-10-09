<html>
	<head>
		<title>Login | e-class</title>
		<link rel="stylesheet" href="styles/template.css">
		<link rel="stylesheet" href="styles/login_n_register.css">
		<script src="scripts/login_n_register_validate.js"></script>
		<meta name="viewport" content="width=device-width initial-scale=1.0">
	</head>
	
	<body>
	<header class="page-header">
		<img src="img/home-logo.png"></img>
		<h1>E-Class platform</h1>
		<h4>Login | <a href="register.html">Register</a></h4>
	</header>
		<nav class="page-nav">
			<ul>
				<li><a href="home.html">Home</a></li>
				<li class="current-page">Login</li>
				<li><a href="register.html">Register</a></li>
			</ul>
		</nav>
		
<div class="main-content">
	<h2 id="caption">Log In</h2>
	<form action="login.php" method="post" onsubmit="return validateLogin()">
		<label for="username">Username: </label><br>
		<input type="text" name="username" id="username" max="30" placeholder="username" required/><br>
		<label for="password">Password: </label><br>
		<input type="password" name="password" id="password" max="20" placeholder="password" required/><br>
		<input type="submit" name="submit" value="Log In"/>
	<p id="loginStatus"></p>
	
	<?php
		if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['submit'])) {
			$login = false;
			require_once('_mysqli_connect.php');
			$username = mysqli_escape_string($dbc, trim($_POST['username']));
			$passHash = sha1($_POST['password']);
			
			$query = "Select * from user where username='$username' and password='$passHash';";
			$response = $dbc->query( $query);
			if ($response && $response->num_rows == 1)
				$login = true;
			$dbc->close();
			
			if ($login == false) {
				echo "<p style=\"color:red\">Username and password does not match. Try again.</p>";
			} else {
				echo "<p>Login successful! <a href=\"home.html\">Proceed</a></p>";
			}
		}
	?>
	
	</form>
</div> <!-- main-content -->


		<footer class="page-footer">
			<small>&copy; 2018, Raihanul Islam Refat</small>
		</footer>
	</body>
</html>