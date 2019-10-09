<?php
$current_page = 3;
$rootDir = "../";
session_start();
include('_pages.php');
include($rootDir.'includes/header.php');
include($rootDir.'includes/nav.php');
?>

<div class="main-content">
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
		<select name="department" onchange="updateForm()">
			<?php
				require($rootDir."_mysqli_connect.php");
				$query= "select distinct dept_name from routine;";
				$response = $dbc->query($query);
				if ($response) {
					if (!isset($_GET['department'])) {
						$row=$response->fetch_array();
						$_GET['department']=$row['dept_name'];
					}
					$response->data_seek(0);
					while ($row =  $response->fetch_array()) { ?>
						<option value="<?php echo $row['dept_name'];?>" <?php if ($_GET['department'] == $row['dept_name']) echo "selected";?>><?php echo $row['dept_name'];?></option>
					<?php
					}
				} else die("some error");

				$query2 = "select distinct semester from routine where dept_name='".$_GET['department']."';";
				$response2 = $dbc->query($query2);
				if ($response2) {
					if (!isset($_GET['semester'])) {
						$row=$response2->fetch_array();
						$_GET['semester']=$row['semester'];
					}
				} else die("some error");
			?>
		</select>
		<select name="semester" onchange="document.forms[0].submit()">
			<?php
				$response2->data_seek(0);
				while ($row =  $response2->fetch_array()) { ?>
					<option value="<?php echo $row['semester'];?>" <?php if ($_GET['semester'] == $row['semester']) echo "selected";?>><?php echo $row['semester'];?></option>
				<?php
				}
				$response2->free_result();
			?>
		</select>
	</form>
	<script type="text/javascript">
		var schedules = [
		<?php
			$response->data_seek(0);
			while ($row = $response->fetch_array()) {
				$query2 = "select distinct semester from routine where dept_name='".$row['dept_name']."';";
				$response2 = $dbc->query($query2);
				if ($response2) {
					echo "[";
					while ($row2 = $response2->fetch_array()) {
						echo "'".$row2['semester']."', ";
					}
					echo "],\n";
				}
			}
			$response2->free_result();
			$response->free_result();
		?>
	];
	</script>

	<?php
	function get_enum_values( $dbc, $table, $field )
	{
	    $row = $dbc->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->fetch_array();
	    $type=$row['Type'];
	    preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
	    $enum = explode("','", $matches[1]);
	    return $enum;
	}

	function get_tr( $day, &$routine ) {
		$tr = "<tr><th>$day</th>";
		$i=0;
		while ($i<9) {
			$tr .= "<td colspan=\"".$routine[$day][$i][1]."\">".$routine[$day][$i][0]."</td>";
			$i += $routine[$day][$i][1];
		}
		$tr .= "</tr>";
		return $tr;
	}

	if (isset($_GET['department']) && isset($_GET['semester'])) {
		echo "<h2 id=\"caption\">Class routine for ".$_GET['department']." ".$_GET['semester']."</h2>";
		$periods = get_enum_values($dbc, 'routine', 'period');
		$routine = array(
			"Sunday" => array_fill(0, 9, array("", 1)),
			"Monday" => array_fill(0, 9, array("", 1)),
			"Tuesday" => array_fill(0, 9, array("", 1)),
			"Wednesday" => array_fill(0, 9, array("", 1)),
			"Thursday" => array_fill(0, 9, array("", 1))
		);

		$query = "select day, period+0, course_no, span from routine where dept_name='".$_GET['department']."' and semester='".$_GET['semester']."';";
		$response = $dbc->query($query);
		if ($response) {
			while ($row = $response->fetch_array()) {
				$routine[$row['day']][$row['period+0']-1][0]=$row['course_no'];
				$routine[$row['day']][$row['period+0']-1][1]=$row['span'];
			}
		}
	?>
	<table>
		<tr>
			<th></th>
			<th><?php echo $periods[0];?></th>
			<th><?php echo $periods[1];?></th>
			<th><?php echo $periods[2];?></th>
			<th><?php echo $periods[3];?></th>
			<th><?php echo $periods[4];?></th>
			<th><?php echo $periods[5];?></th>
			<th><?php echo $periods[6];?></th>
			<th><?php echo $periods[7];?></th>
			<th><?php echo $periods[8];?></th>
		</tr>
		<?php
		echo get_tr('Sunday', $routine)."\n";
		echo get_tr('Monday', $routine)."\n";
		echo get_tr('Tuesday', $routine)."\n";
		echo get_tr('Wednesday', $routine)."\n";
		echo get_tr('Thursday', $routine)."\n";
		
		?>
	</table>
	<?php
	}
	?>
</div>

<?php
include($rootDir."includes/footer.php");
?>