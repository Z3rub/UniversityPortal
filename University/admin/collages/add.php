<?php 
	include("../../include/db/Database.php");
    $st = $_GET['st'];
    $id = $_GET['id'];
    $db = new Database();
    $sql = "INSERT INTO tbl_education(Title, PID) VALUES ('$st','$id');";
    $rs = $db->dbQuery($sql);
    $sql = "SELECT MAX(ID) FROM tbl_education";
    $rs = $db->dbQuery($sql);
    $MAXID = $db->dbRecord()[0];
    $sql = "SELECT * FROM tbl_education WHERE PID = '$id';";
    $rs = $db->dbQuery($sql);
    $rows = $db->row($rs);
?>

	<option value="-1">اختر</option>
<?php 
	foreach ($rows as $row ) {
		if($row[0] == $MAXID){
?>
		<option selected="true" value="<?= $row[0] ?>"><?= $row[1] ?></option>
<?php 
		}
		else {
?>
		<option value="<?= $row[0] ?>"><?= $row[1] ?></option>
<?php
		}
	}
?>