<?php 
	include("../../include/db/Database.php");
    $db = new Database();
    $it = $_GET['it'];
    $ic = $_GET['ic'];
    if($ic!="-1"){ //Add
        $sql = "SELECT * FROM tbl_teacrs WHERE teacher_id = '$it' AND course_id = '$ic';";
        $rs = $db->dbQuery($sql);
        if($db->numRows()!=0){

?>
<p>The course is already registered...</p>
<?php
        }
        else{
        $sql = "INSERT INTO tbl_teacrs(teacher_id, course_id) VALUES ('$it','$ic');";
        $rs = $db->dbQuery($sql);
?>
<p>Addition is Done...</p>
<?php 
        }
    }
    else{ 
        $sql = " SELECT * FROM tbl_education WHERE ID in (
                    SELECT course_id FROM tbl_teacrs WHERE teacher_id = '$it');";
        $rs = $db->dbQuery($sql);
        $rows = $db->row();
        foreach ($rows as $row) {
?>
    <tr>
        <th><?= $row[0] ?></th>
        <th><?= $row[1] ?></th>
        <th>There are No Notes..</th>
    </tr>
<?php
         } 
    }
    
    
?>
