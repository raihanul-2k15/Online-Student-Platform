<?php
$current_page = 5;
$rootDir = "";
session_start();
include('_pages.php');
include($rootDir.'includes/header.php');
include($rootDir.'includes/nav.php');
?>

<link rel="stylesheet" href="styles/search.css"/>
<script type="text/javascript" src="scripts/search.js"></script>

<div class="main-content">
<?php
if (isset($_GET['q'])) {
	require_once("_mysqli_connect.php");
	$key = $dbc->escape_string($_GET['q']);
	$response = $dbc->query("select title, author, dept_name, semester+0 as semester, username from reference join added on reference.id = added.ref_id where title like '%$key%' or author like '%$key%';");
	if ($response->num_rows > 0) {
		echo "<h2 class=\"section-title\">Books and References mathces:</h2>";
		while ($row = $response->fetch_array()) {
			echo "<a href=\"".$rootDir."books_and_references/view.php?department=".$row['dept_name']."&semester=".$row['semester']."\" class=\"ref-tile\"><div><p>Title: ".$row['title']."<br>Author: ".$row['author']."<br>Dept: ".$row['dept_name']."<br>Added By: ".$row['username']."</p></div></a>";
		}
	}
	if (isset($_SESSION['login'])) {
		$response = $dbc->query("select dept_name from user where username = '".$_SESSION['username']."';");
		$row = $response->fetch_array();
		$userDept = $row['dept_name'];
	}

	$response = $dbc->query("select id, name as thread, thread.username as creator, starttime as time, (select count(*) from message where thread.id = message.thr) as posts, dept_name as department from thread join user on thread.username = user.username where thread.name like '%$key%' order by id desc;");
	if ($response->num_rows > 0) {
		echo "<h2 class=\"section-title\">Threads matches:</h2>";
		echo "<table>";
		echo "<tr><th>Thread</th><th>Creator</th><th>Department</th><th>Posts</th><th>Time</th></tr>";
		while ($row = $response->fetch_array()) {
			echo "<tr>";
			echo "<td><a href=\"".$rootDir."discussions/view.php?id=".$row['id']."\">".$row['thread']."</a></td>";
			if (isset($_SESSION['login']) && $row['creator']==$_SESSION['username']) {
				echo "<td class=\"own-thread\">".$row['creator']."</td>";
			} else {
				echo "<td>".$row['creator']."</td>";
			}
			if (isset($_SESSION['login']) && $row['department']==$userDept) {
				echo "<td class=\"own-dept\">".$row['department']."</td>";
			} else {
				echo "<td>".$row['department']."</td>";
			}
			echo "<td>".$row['posts']."</td>";
			echo "<td>".date('M j, Y - h:i:s A', strtotime($row['time']))."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}

	$response = $dbc->query("select username, roll, dept_name, (select count(*) from added where user.username = added.username) as books, (select count(*) from thread where user.username = thread.username) as threads, (select count(*) from message where user.username = message.username) as posts from user where username like '%$key%';");
	if ($response->num_rows > 0) {
		echo "<h2 class=\"section-title\">Users matches:</h2>";
		echo "<table id=\"users-table\">";
		echo "<tr><th>User</th><th>Roll</th><th>Department</th><th>Books</th><th>Threads</th><th>Posts</th></tr>";
		while ($row = $response->fetch_array()) {
			echo "<tr>";
			echo "<td>".$row['username']."</td>";
			echo "<td>".$row['roll']."</td>";
			if (isset($_SESSION['login']) && $userDept == $row['dept_name']) {
				echo "<td class=\"own-dept\">".$row['dept_name']."</td>";
			} else {
				echo "<td>".$row['dept_name']."</td>";
			}
			echo "<td>".$row['books']."</td>";
			echo "<td>".$row['threads']."</td>";
			echo "<td>".$row['posts']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	$response->free_result();
	$dbc->close();
}
?>
</div>

<?php
include($rootDir."includes/footer.php");
?>