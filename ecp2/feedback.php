<?php
$current_page = 4;
$rootDir = "";
session_start();
include('_pages.php');
include('includes/header.php');
include('includes/nav.php');
?>

<div class="main-content">
	<h2 id="caption">Feedback</h2>

	<?php
	if (!isset($_POST['submit'])) { 
	?>

		<p>If you face any problems or have any issues, comments or suggestions about this page, you can  post it in the form down below.</p>

		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label for="subject">Subject:</label><br>
			<input type="text" maxlength="127" id="subject" name="subject" placeholder="(subject)" required/><br>
			<label for="message">Message:</label><br>
			<textarea id="message" maxlength="127" name="message" placeholder="(your message)" required></textarea><br>
			<input type="checkbox" id="anonymous" name="anonymous" value="true"  <?php if (!isset($_SESSION['login'])) echo "checked disabled"; ?>/>
			<label for="anonymous">Post anonymously</label><br>
			<input type="submit" name="submit" value="Submit"/>
		</form>
	<?php
	} else {
		require_once($rootDir.'_mysqli_connect.php');
		$subject = mysqli_escape_string($dbc, trim($_POST['subject']));
		$message = mysqli_escape_string($dbc, trim($_POST['message']));
		if (!isset($_POST['anonymous']) && isset($_SESSION['login'])) {
			$username = $_SESSION['username'];
			$query = "insert into feedback(username, subject, message, time_submitted) values('$username', '$subject', '$message', NOW());";
		} else {
			$query = "insert into feedback(subject, message, time_submitted) values('$subject', '$message', NOW());";
		}
		$response = $dbc->query($query);

		$dbc->close();
		if ($response) { ?>
			<p style="color:blue">Thank you for your feedback. Your thoughts will be taken into consideration and will be used to make this website better for its users.</p>
		<?php } else { ?>
			<p style="color:red">Sorry, there was an error submitting your feedback. Please try again later.</p>
		<?php }
	}

	?>

</div> <!-- main-content -->

<?php
include($rootDir."includes/footer.php");
?>