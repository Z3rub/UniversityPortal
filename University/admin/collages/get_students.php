<?php 
	include("../../include/db/Database.php");
    $pid = $_GET['pid'];
    $id = $_GET['id'];
    $ik = $_GET['ik'];
    $db = new Database();
    
    if($id == 0){
        $sql =" select S_ID, S_Name
                from tbl_students
                where S_Assign in (
                    select id from tbl_education where pid in (
                        select id from tbl_education where pid = '$pid'));";
    }
    elseif($id == 1){
        $sql =" select S_ID, S_Name
                from tbl_students
                where S_Assign in (
                    select id from tbl_education where pid = '$pid');";
    }
    elseif($id == 2){
        $sql =" select S_ID, S_Name
                from tbl_students
                where S_Assign = '$pid';";
    }
    elseif ($id == -1) {
        $sql =" SELECT S_ID, S_Name
                FROM tbl_students
                WHERE S_Assign = (SELECT pid FROM tbl_education WHERE id = '$pid');";
    }

    $rs = $db->dbQuery($sql);
    $rows = $db->row($rs);

	foreach ($rows as $row ) {
?>
<tr>
        <td><?=$row[0] ?></td>
        <td><?=$row[1] ?></td>
    <?php if($id != -1){ ?>
        <td>Action</td>
    <?php } 
        else {
            $ssql = "SELECT * FROM tbl_stdcrs WHERE STUDENT_ID = '$row[0]' AND COURSE_ID = '$ik';";
            $ro_no = $db->numRows($db->dbQuery($ssql));
    ?>
    <td>
        <input name="Active" type="checkbox" onclick="is_belong(<?=$row[0]?>)" <?php if($ro_no==1){?> checked <?php } ?> >
    </td>
    <?php } ?>
</tr>
<?php
	}
?>


