<?php
$current_page = 2;
$rootDir = "../";
session_start();
include('_pages.php');
include($rootDir.'includes/header.php');
include($rootDir.'includes/nav.php');
?>

<div class="main-content">
<?php
if (!isset($_SESSION['login'])) { ?>
	<p style="color:red">Sorry, you need to be logged in to be able to add new books or references. <a href="<?php echo $pages[$current_page]['loginLink']; ?>">Login Now</a>
<?php
} else {
	if (!isset($_GET['department'])) $_GET['department'] = $_SESSION['department'];
	if (!isset($_GET['semester'])) $_GET['semester'] = "1";
	if (!isset($_POST['submit'])) {
	?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<select name="department" onchange="updateForm()">
			<?php
			require($rootDir.'_mysqli_connect.php');
			$query = "select name from department order by name;";
			$response = $dbc->query($query);
			if ($response) {
				while ($row = $response->fetch_array()) { ?>
			<option value="<?php echo $row['name']; ?>" <?php if ($row['name'] == $_GET['department']) echo "selected";?>><?php echo $row['name']; ?></option>
				<?php
				}
				$response->free_result();
			}
			?>
		</select><br>
		<select name="semester" onchange="updateForm()">
			<option value="1" <?php if ($_GET['semester']=="1") echo "selected"; ?>>1st Year 1st Semester</option>
			<option value="2" <?php if ($_GET['semester']=="2") echo "selected"; ?>>1st Year 2nd Semester</option>
			<option value="3" <?php if ($_GET['semester']=="3") echo "selected"; ?>>2nd Year 1st Semester</option>
			<option value="4" <?php if ($_GET['semester']=="4") echo "selected"; ?>>2nd Year 2nd Semester</option>
			<option value="5" <?php if ($_GET['semester']=="5") echo "selected"; ?>>3rd Year 1st Semester</option>
			<option value="6" <?php if ($_GET['semester']=="6") echo "selected"; ?>>3rd Year 2nd Semester</option>
			<option value="7" <?php if ($_GET['semester']=="7") echo "selected"; ?>>4th Year 1st Semester</option>
			<option value="8" <?php if ($_GET['semester']=="8") echo "selected"; ?>>4th Year 2nd Semester</option>
		</select><br>
		<select name="course">
		<?php
		$query = "select course_no,name from course where dept_name='".$_GET['department']."' and semester=".$_GET['semester'].";";
		$response = $dbc->query($query);
		if ($response) {
			if (!isset($_GET['course'])) {
				$row=$response->fetch_array();
				$_GET['course']=$row['course_no'];
				$response->data_seek(0);
			}
			while ($row = $response->fetch_array()) {
			?>
			<option value="<?php echo $row['course_no'];?>" <?php if ($_GET['course']==$row['course_no']) echo "selected";?>><?php echo $row['course_no']." - ".$row['name'];?></option>
			<?php
			}
		}
		?>
		</select><br>
		<input type="text" name="title" placeholder="(title)" maxlength="50" required/><br>
		<input type="text" name="author" placeholder="(author)" maxlength="50" required/><br>
		<input type="number" name="edition" placeholder="(edition)" max="99" required/><br>
		<input type="url" name="link" placeholder="(link)" maxlength="2083"/><br>
		<input type="submit" name="submit" value="Add"/>
	</form>
	<?php
	} else {
		require($rootDir."_mysqli_connect.php");
		$title=$dbc->escape_string(trim($_POST['title']));
		$author=$dbc->escape_string(trim($_POST['author']));
		$edition = $_POST['edition'];
		$dept_name = $_POST['department'];
		$semester = $_POST['semester'];
		$course=$_POST['course'];
		$link=$dbc->escape_string(trim($_POST['link']));
		$query = "insert into reference(title, author, edition, dept_name, semester, course_no, link) values ('$title', '$author', $edition, '$dept_name', $semester, '$course', '$link');";
		$response = $dbc->query($query);
		if ($response) {
			$query = "insert into added values('".$_SESSION['username']."', last_insert_id(), NOW());";
			$dbc->query($query);
			echo "<p style=\"color:blue\">Reference added successfully. <a href=\"".$_SERVER['PHP_SELF']."?department=".$_POST['department']."&semester=".$_POST['semester']."&course=".$_POST['course']."\">Add more</a></p>";
		} else { ?>
	<p style="color:red">There was an error adding your reference. Please leave a feedback describing your problem <a href="<?php echo $rootDir;?>feedback.php">here</a>
	<?php
		}
	}
}
?>
</div>

<?php
include($rootDir."includes/footer.php");
?>