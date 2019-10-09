<?php
if (isset($_GET['q'])) {
	$q = $_GET['q'];
} else {
	$q = "";
}

if (isset($_GET['rootDir'])) {
	$rootDir = $_GET['rootDir'];
} else {
	$rootDir = "";
}

if ($q == "") {
	echo "";
	exit();
}

require_once("_mysqli_connect.php");
$q = $dbc->escape_string($q);
$response = $dbc->query("select sug from (select title as sug from reference where title like '$q%' union select author from reference where author like '$q%' union select name from thread where name like '%$q%' union select username from user where username like '$q%') temp order by sug;");
if ($response->num_rows == 0) {
	echo "";
	exit();
}

while ($row = $response->fetch_array()) {
	echo "<a href=\"".$rootDir."search.php?q=".rawurlencode($row['sug'])."\"><div class=\"suggestion-item\">".$row['sug']."</div></a>";
}
$response->free_result();
$dbc->close();
?>