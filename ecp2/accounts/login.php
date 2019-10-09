<?php
$current_page = 1;
$rootDir = "../";
ob_start();
session_start();
include('_pages.php');
include($rootDir.'includes/header.php');
include($rootDir.'includes/nav.php');
?>

<div class="main-content">
	<h2 id="caption">Log In</h2>
	<?php
	if (isset($_SESSION['login'])) {
		echo "<p>You're already logged in as ".$_SESSION['username'].".</p>";
	} else {
		?>
	<form action="login.php" method="post" onsubmit="return validateLogin()">
		<label for="username">Username: </label><br>
		<input type="text" name="username" id="username" maxlength="30" placeholder="username" required/><br>
		<label for="password">Password: </label><br>
		<input type="password" name="password" id="password" maxlength="20" pattern=".{6,}" placeholder="password" onkeyup="validateLogin()" required/><br>
		<input type="checkbox" id="remember" name="remember" value="true" checked/>
		<label for="remember">Remember me</label><br>
		<input type="submit" name="submit" value="Log In"/>
	<p id="loginStatus"></p>
	<?php  } ?>

	<?php
		if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['submit'])) {
			$login = false;
			require($rootDir.'_mysqli_connect.php');
			$username = mysqli_escape_string($dbc, trim($_POST['username']));
			$passHash = sha1($_POST['password']);
			
			$query = "Select * from user where username='$username' and password='$passHash';";
			$response = $dbc->query( $query);
			if ($response && $response->num_rows == 1){
				$login = true;
				$row = $response->fetch_array();
				$dept = $row['dept_name'];
			}
			$response->free_result();
			$dbc->close();
			
			if ($login == false) {
				echo "<p style=\"color:orange\">Username and password does not match. Try again.</p>";
				session_destroy();
			} else {
				$_SESSION['login']=true;
				$_SESSION['username']=$username;
				$_SESSION['department'] = $dept;
				ob_clean();
				if (isset($_POST['remember'])) {
					setcookie('user-login', sha1($username.$_POST['password']), time() + 60*60, '/');
				}
				if (!isset($_SESSION['last_page_visited']))
					header("location: ".$rootDir."home.php");
				else
					header("location: ".$_SESSION['last_page_visited']);
			}
		}
	?>
	<?php if (!isset($_SESSION['login'])) { ?>
	</form>
	<?php } ?>
</div> <!-- main-content -->

<?php
include($rootDir."includes/footer.php");
ob_flush();
?>