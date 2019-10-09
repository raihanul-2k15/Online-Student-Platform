<?php
$current_page = 1;
$rootDir = "../";
session_start();
include('_pages.php');
include($rootDir.'includes/header.php');
include($rootDir.'includes/nav.php');
?>

<div class="main-content">
	<table>
		<tr><th>Thread</th><th>Creator</th><th>Department</th><th>Posts</th><th>Time</th></tr>
		<?php
		require_once($rootDir."_mysqli_connect.php");

		if (isset($_SESSION['login'])) {
			$response = $dbc->query("select dept_name from user where username = '".$_SESSION['username']."';");
			$row = $response->fetch_array();
			$userDept = $row['dept_name'];
		}

		$query = "select id, name as thread, thread.username as creator, starttime as time, (select count(*) from message where thread.id = message.thr) as posts, dept_name as department from thread join user on thread.username = user.username order by id desc;";
		$response = $dbc->query($query);
		while ($row = $response->fetch_array()) {
			echo "<tr>";
			echo "<td><a href=\"view.php?id=".$row['id']."\">".$row['thread']."</a></td>";
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
		$response->free_result();
		$dbc->close();
		?>
	</table>
</div>

<?php
include($rootDir."includes/footer.php");
?>