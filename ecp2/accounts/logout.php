<?php
ob_start();
session_start();
if (isset($_COOKIE['user-login'])) {
	setcookie("user-login", "", time() - 60-60, '/');
}
if (!isset($_SESSION['last_page_visited']))
	$target = "../home.php";
else
	$target= $_SESSION['last_page_visited'];
session_destroy();
echo "You have logged out.";
ob_clean();
header("location: ".$target);
?>