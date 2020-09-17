<?php 
    include("../../include/db/Database.php");
    $cid = $_GET['cid'];
    $db = new Database();
    $sql = "SELECT cr.id, t.T_Name FROM tbl_teacrs cr
            JOIN tbl_teachers t ON t.T_ID = cr.teacher_id
            WHERE course_id = '$cid';";
    $rs = $db->dbQuery($sql);
    $rows = $db->row($rs);
?>
<option value="-1">Choose A Teacher</option>

<?php 
    foreach ($rows as $row ) {
?>
    <option value="<?= $row[0] ?>"><?= $row[1] ?></option>
<?php
    }
?>