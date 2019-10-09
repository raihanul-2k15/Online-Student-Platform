<?php
$current_page = 1;
$rootDir = "../";
session_start();
include('_pages.php');
include($rootDir.'includes/header.php');
include($rootDir.'includes/nav.php');
?>

<!--
<script src="../scripts/jquery-ui.js"></script>
<link rel="stylesheet" href="../styles/jquery-ui.css"/>
-->
<div class="modal">
	<div id="ref_detailDialog">
		<img src="../img/books_and_references/default_ref.jpg"/>
		<p></p>
		<form style="display:none">
			<input type="text" name="title" placeholder="(title)" maxlength="50" required/><br>
			<input type="text" name="author" placeholder="(author)" maxlength="50" required/><br>
			<input type="number" name="edition" placeholder="(edition)" max="99" required/><br>
			<input type="url" name="link" placeholder="(link)" maxlength="2083"/><br>
			<button type="button" onclick="upd_del('upd')">Done</button>
		</form>
		<button style="display: inline-block" class="yellow-btn" onclick="openEditForm()">Edit</button>
		<button style="display: inline-block" class="red-btn" onclick="if (confirm('Are you sure you want to delete?')) upd_del('del')">Delete</button>
	</div>
</div> <!-- modal -->

<div class="side-left">
<?php
$sem_names = array(
	"",
	"1st year 1st semester",
	"1st year 2nd semester",
	"2nd year 1st semester",
	"2nd year 2nd semester",
	"3rd year 1st semester",
	"3rd year 2nd semester",
	"4th year 1st semester",
	"4th year 2nd semester",
);
require($rootDir."_mysqli_connect.php");
$query="select name from department;";
$response = $dbc->query($query);
if ($response) {
	while ($row = $response->fetch_array()) { ?>
	<p><?php echo $row['name'];?></p>
	<ul>
		<li><a href="<?php echo $_SERVER['PHP_SELF']."?department=".$row['name']."&semester=1";?>"><?php echo $sem_names[1];?></a></li>
		<li><a href="<?php echo $_SERVER['PHP_SELF']."?department=".$row['name']."&semester=2";?>"><?php echo $sem_names[2];?></a></li>
		<li><a href="<?php echo $_SERVER['PHP_SELF']."?department=".$row['name']."&semester=3";?>"><?php echo $sem_names[3];?></a></li>
		<li><a href="<?php echo $_SERVER['PHP_SELF']."?department=".$row['name']."&semester=4";?>"><?php echo $sem_names[4];?></a></li>
		<li><a href="<?php echo $_SERVER['PHP_SELF']."?department=".$row['name']."&semester=5";?>"><?php echo $sem_names[5];?></a></li>
		<li><a href="<?php echo $_SERVER['PHP_SELF']."?department=".$row['name']."&semester=6";?>"><?php echo $sem_names[6];?></a></li>
		<li><a href="<?php echo $_SERVER['PHP_SELF']."?department=".$row['name']."&semester=7";?>"><?php echo $sem_names[7];?></a></li>
		<li><a href="<?php echo $_SERVER['PHP_SELF']."?department=".$row['name']."&semester=8";?>"><?php echo $sem_names[8];?></a></li>
	</ul>
	<?php
	}
	$response->free_result();
}
?>
</div>

<div class="main-content main-beside_side-left">
<?php
if (!isset($_GET['department'])) {
	if (isset($_SESSION['login']))
		$_GET['department'] = $_SESSION['department'];
	else 
	{
		$query="select name from department limit 1;";
		$response = $dbc->query($query);
		if ($response) {
			$firstRow = $response->fetch_array();
			$_GET['department']=$firstRow['name'];
			$response->free_result();
		}
	}
}
if (!isset($_GET['semester']))
	$_GET['semester']="1";
?>
<h2 class="section-title">Books and References for <?php echo $_GET['department']." ".$sem_names[(int)$_GET['semester']];?></h2>

<?php
	$query = "select course_no, name from course where dept_name='".$_GET['department']."' and semester=".$_GET['semester'].";";
	$response = $dbc->query($query);
	if ($response) {
		while ($row = $response->fetch_array()) {
?>
<h4><?php echo $row['course_no']." - ".$row['name'];?></h4>
			<?php
			$query2 = "select id, title, author, edition, link from reference where dept_name='".$_GET['department']."' and semester=".$_GET['semester']." and course_no='".$row['course_no']."';";
			$response2 = $dbc->query($query2);
			if ($response2) {
				while ($row2 = $response2->fetch_array()) {
					$query3 = "select username, time_added from added where ref_id=".$row2['id'].";";
					$response3 = $dbc->query($query3);
					$row3 = $response3->fetch_array();
				?>
			<div class="ref-tile">
				<div class="img-container">
					<img src="<?php echo $rootDir;?>img/books_and_references/default_ref.jpg"/>
				</div>
				<div class="detail-container">
					<p>
						Title: <span><?php echo $row2['title']."\n";?></span><br>
						Author: <span><?php echo $row2['author']."\n";?></span><br>
						Edition: <span><?php echo $row2['edition']."\n";?></span><br>
						Added by: <span><?php echo $row3['username']."\n";?></span><br>
						Added on: <span><?php echo $row3['time_added'];?></span>
						id: <span><?php echo $row2['id']."\n";?></span>
						u_d_able: <span><?php echo ($_SESSION['username']!=null && $_SESSION['username']==$row3['username']) ? "yes" : "no";?></span>
					</p>
					<a href="<?php echo $row2['link']?>">Link</a><br>
				</div>
			</div>
				<?php 
				$response3->free_result();
				}

				if (isset($_SESSION['login'])) {
					?>
			<div class="ref-add-tile">
				<div class="img-container">
					<a href="add.php?department=<?php echo $_GET['department'];?>&semester=<?php echo $_GET['semester'];?>&course=<?php echo $row['course_no'];?>"><img src="<?php echo $rootDir;?>img/books_and_references/add_ref.png"/></a>
				</div>
				<div class="detail-container">
					<p>Add new</p>
				</div>
			</div>
					<?php
				}
			}
			$response2->free_result();
		}
	}
	$response->free_result();
?>
</div>

<?php
include($rootDir."includes/footer.php");
?>