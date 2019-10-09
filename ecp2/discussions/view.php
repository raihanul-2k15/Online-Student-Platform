<?php
$current_page = 2;
$rootDir = "../";
session_start();
include('_pages.php');
include($rootDir.'includes/header.php');
include($rootDir.'includes/nav.php');
?>

<?php
require_once($rootDir."_mysqli_connect.php");
if (isset($_POST['id'])) $_GET['id'] = $_POST['id'];
if (!isset($_GET['id'])) {
	$query = "select id from thread order by id desc limit 1;";
	$response = $dbc->query($query);
	$row = $response->fetch_array();
	$_GET['id'] = $row['id'];
}

if (isset($_POST['msg']) && isset($_SESSION['login'])) {
	$msg = $dbc->escape_string($_POST['msg']);
	$usr = $_SESSION['username'];
	$response = $dbc->query("insert into message(msg, username, posttime, thr) values('$msg', '$usr', NOW(), ".$_GET['id'].");");
}
?>

<div class="main-content">
	<?php
	$query = "select name as thread, thread.username as creator, starttime as time, (select count(*) from message where thread.id = message.thr) as posts, dept_name as department from thread join user on thread.username = user.username where id = ".$_GET['id'].";";
	$response = $dbc->query($query);
	$row = $response->fetch_array();
	?>

	<div class="thread-container clearfix">
	<?php
	echo "<h1>".$row['thread']."</h1>";
	echo "<small>";
	echo "created by: <b>".$row['creator']."</b> &nbsp;&nbsp;dept: <b>".$row['department']."</b><br>";
	echo "at: <b>".date('M j, Y - h:i:s A', strtotime($row['time']))."</b> &nbsp;&nbsp;posts: <b>".$row['posts']."</b>";
	echo "</small>";
	?>
	</div>

	<?php
	if (isset($_SESSION['login'])) {
	?>
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<input type="text" name="id" value="<?php echo $_GET['id'];?>" style="display:none"/>
		<label for="msg">Your answer: </label><br>
		<textarea name="msg" id="msg" maxlength="4095"></textarea><br>
		<input type="submit" name="submit" value="Post"/>
	</form>
	<?php
	} else echo "<p style=\"color:orange;margin:0 auto;width:80%;\">You must be logged in to post on threads.</p>";
	?>

	<style type="text/css">
		form {
			box-shadow: none;
		}
	</style>

	<?php
	$response = $dbc->query("select msg as post, message.username as poster, posttime as time, dept_name as department from message join user on message.username = user.username where thr = ".$_GET['id']." order by posttime desc;");
	while ($row = $response->fetch_array()) {
		echo "<div class=\"post-container clearfix\">&nbsp;";

		echo "<p class=\"details-pane\">";
		echo $row['poster']."<br>";
		echo $row['department']."<br>";
		echo $row['time'];
		echo "</p>";

		echo "<div class=\"message-pane\"><p>";
		echo $row['post'];
		echo "</p></div>";

		echo "</div>";
	}
	?>
</div>

<?php
include($rootDir."includes/footer.php");
?>