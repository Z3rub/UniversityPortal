<?php 
	include("../../include/db/Database.php");
    $pid = $_GET['pid'];
    $id = $_GET['id'];
    $db = new Database();
    $sql = "SELECT * FROM tbl_education WHERE PID = '$pid';";
    $rs = $db->dbQuery($sql);
    $rows = $db->row($rs);
    if($id == 1){
?>
<option value="-1">Choose A Department</option>
<?php }elseif($id == 2){?>
<option value="-1">Choose A Course</option>
<?php
    }
	foreach ($rows as $row ) {
?>
	<option value="<?= $row[0] ?>"><?= $row[1] ?></option>
<?php
	}
?>
