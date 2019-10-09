<?php
$current_page = 3;
$rootDir = "../";
ob_start();
session_start();
include('_pages.php');
include($rootDir.'includes/header.php');
include($rootDir.'includes/nav.php');
?>

<?php 
if (isset($_SESSION['login']) && isset($_POST['thread'])) {
	require_once($rootDir."_mysqli_connect.php");
	$thread = $dbc->escape_string($_POST['thread']);
	$response = $dbc->query("insert into thread(name, username, starttime) values('$thread', '".$_SESSION['username']."', NOW());");
	$response = $dbc->query("select max(id) as mid from thread;");
	$row = $response->fetch_array();
	if (isset($_POST['post']) && $_POST['post'] != "") {
		$msg = $dbc->escape_string($_POST['post']);
		$response = $dbc->query("insert into  message(username, posttime, msg, thr) values('".$_SESSION['username']."', NOW(), '$msg', ".$row['mid'].");");

	}

	ob_clean();
	header("location: view.php?id=".$row['mid']);
}
?>

<div class="main-content">
	<h2 id="caption">Create New Thread</h2>
	<?php
	if (isset($_SESSION['login'])) { ?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<input type="text" name="thread" maxlength="512" placeholder="What is your question?"/><br>
		<label for="1st-post">1st post: </label><br>
		<textarea name="post" id="1st-post" maxlength="4095" placeholder="Describe your question here"></textarea>
		<input type="submit" name="create" value="Create"/>
	</form>
	<?php
	} else 
		echo "<p style=\"color:orange;margin:0 auto;width:80%;\">You must be logged in to create a thread.</p>";
	?>
</div>

<style type="text/css">
</style>

<?php
include($rootDir."includes/footer.php");
ob_flush();
?>