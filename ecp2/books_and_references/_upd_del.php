<?php 
if (isset($_POST['rq'])) {
	require("../_mysqli_connect.php");

	$id = $_POST['id'];

	if ($_POST['rq'] == 'd') {
		$response = $dbc->query("delete from reference where id = $id;");
		if ($response && $dbc->affected_rows == 1)
			$result = "success";
		else
			$result = "failure";
	} else if ($_POST['rq'] == 'u') {
		$title = $_POST['title'];
		$author = $_POST['author'];
		$edition = $_POST['edition'];
		$link = $_POST['link'];
		$response = $dbc->query("update reference set ".
								"title = '$title',".
								"author = '$author',".
								"edition = $edition,".
								"link = '$link' ".
								"where id = $id;");
		if ($response && $dbc->affected_rows == 1 || $dbc->affected_rows == 0)
			$result = "success";
		else
			$result = "failure";
	}

	echo $result;
}
?>