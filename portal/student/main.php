<?php 
	$db = new Database();
	$db->CheckUser(0);
	$st_id = $_SESSION['st_id'];
	$sql = "SELECT S_Name FROM tbl_students WHERE S_ID = '$st_id';";
?>
<h4 class="page-head-line">Hi, <?= $db->dbRecord($db->dbQuery($sql))[0]; ?> !</h4>