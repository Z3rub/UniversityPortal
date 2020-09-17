<?php 
	$db = new Database();
	$db->CheckUser(1);
	$t_id = $_SESSION['tr_id'];
	$sql = "SELECT T_Name FROM tbl_teachers WHERE T_ID = '$t_id';";
?>
<h4 class="page-head-line">Hi, <?= $db->dbRecord($db->dbQuery($sql))[0]; ?> !</h4>