<?php
$current_page = 2;
$rootDir = "../";
session_start();
include('_pages.php');
include($rootDir.'includes/header.php');
include($rootDir.'includes/nav.php');
?>

<div class="main-content">
	<iframe src="games/racing/index.html" frameborder="0"></iframe>
</div>

<?php
include($rootDir."includes/footer.php");
?>