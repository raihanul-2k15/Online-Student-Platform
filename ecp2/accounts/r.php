<!DOCTYPE html>
<html>
	<head>
		<title>Register | e-class</title>
		<link rel="stylesheet" href="styles/template.css">
		<link rel="stylesheet" href="styles/login_n_register.css">
		<script src="scripts/login_n_register_validate.js"></script>
		<meta name="viewport" content="width=device-width initial-scale=1.0">
	</head>
	
	<body>
	<header class="page-header">
		<img src="img/home-logo.png"></img>
		<h1>E-Class platform</h1>
		<h4><a href="login.html">Login</a> | Register</h4>
	</header>
		<nav class="page-nav">
			<ul>
				<li><a href="home.html">Home</a></li>
				<li><a href="login.html">Login</a></li>
				<li class="current-page">Register</li>
			</ul>
		</nav>
		
<div class="main-content">
	<h2 id="caption">Register</h2>
	<form action="register.php" method="post" onsubmit="return validateRegister()">
		<label for="username">Username: </label><br>
		<input type="text" id="username" name="username" max="30" placeholder="username" required/><br>
		<label for="password">Password: </label><br>
		<input type="password" id="password" name="password" max="20" placeholder="password" required/><br>
		<label for="retype">Retype password: </label><br>
		<input type="password" id="retype" name="retype" max="20" placeholder="retype password" required/><br>
		<input type="submit" name="submit" value="Register"/>
	<p id="registerStatus"></p>
		
	<?php
		if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['retype']) && isset($_POST['submit'])) {
			require_once('_mysqli_connect.php');
			$username = mysqli_escape_string($dbc, trim($_POST['username']));
			$passHash = sha1($_POST['password']);
			echo $username." ".$passHash;
			$query = "insert into user values('$username', '$passHash');";
			$response = $dbc->query( $query);
			
			if ($response) {
				echo "<p>Registered successfully! <a href=\"login.html\">Login</a></p>";
			} else {
				echo "<p style=\"color:red\">Username already exists.</p>";
			}
			
			$dbc->close();
			
		}
	?>
	
	</form>
</div> <!-- main-content -->


		<footer class="page-footer">
			<small>&copy; 2018, Raihanul Islam Refat</small>
		</footer>
	</body>
</html>