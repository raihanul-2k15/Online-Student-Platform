<?php
$current_page = 2;
$rootDir = "../";
ob_start();
session_start();
include('_pages.php');
include($rootDir.'includes/header.php');
include($rootDir.'includes/nav.php');
?>
<div class="main-content">
	<h2 id="caption">Register</h2>
	<form action="register.php" method="post" onsubmit="return validateRegister()">
		<label for="username">Username: </label><br>
		<input type="text" id="username" name="username" maxlength="30" placeholder="username" required/><br>
		<label for="password">Password: </label><br>
		<input type="password" id="password" name="password" maxlength="20" placeholder="password" onkeyup="validateRegister()" required/><br>
		<label for="retype">Retype password: </label><br>
		<input type="password" id="retype" name="retype" maxmaxlength="20" placeholder="retype password" onkeyup="validateRegister()" required/><br>
		<label for="roll">Roll: </label><br>
		<input type="text" pattern="\d{7}" id="roll" name="roll" maxlength="7" placeholder="roll" onkeyup="validateRegister()" required/><br>
		<label for="email">Email: </label><br>
		<input type="email" id="email" name="email" maxmaxlength="100" placeholder="email" onkeyup="validateRegister()" required/><br>
		<label for="department">Department: </label>
		<select name="department" required>
			<?php
			require($rootDir.'_mysqli_connect.php');
			$query = "select name from department order by name;";
			$response = $dbc->query($query);
			if ($response) {
				while ($row = $response->fetch_array()) { ?>
					<option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
				<?php }
			}
			$dbc->close();
			?>
		</select>
		<input type="submit" name="submit" value="Register"/>
	<p id="registerStatus"></p>
		
	<?php
		if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['retype']) && isset($_POST['department']) && isset($_POST['submit'])) {
			require($rootDir.'_mysqli_connect.php');
			$username = mysqli_escape_string($dbc, trim($_POST['username']));
			$passHash = sha1($_POST['password']);
			$loginCookieHash = sha1($username.$_POST['password']);
			$roll = $_POST['roll'];
			$email = mysqli_escape_string($dbc, trim($_POST['email']));
			$department = $_POST['department'];
			$query = "insert into user values('$username', '$passHash', '$loginCookieHash', '$roll', '$email', '$department');";
			$response = $dbc->query( $query);
			
			if ($response) {
				ob_clean();
				header("location: ".$rootDir."accounts/login.php");
			} else {
				if (preg_match('/primary/i', mysqli_error($dbc))) {
					echo '<p style="color:orange">Username already exists</p>';
				} else if (preg_match('/roll/i', mysqli_error($dbc))) {
					echo '<p style="color:orange">Roll already exists</p>';
				} else if (preg_match('/email/i', mysqli_error($dbc))) {
					echo '<p style="color:orange">Email already exists</p>';
				} else {
					echo '<p style="color:orange">Some error occured</p>';
				}
			}
			$dbc->close();
			
		}
	?>
	
	</form>
</div> <!-- main-content -->

<?php
include($rootDir."includes/footer.php");
ob_flush();
?>