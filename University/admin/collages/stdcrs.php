<?php
    include("../../include/db/Database.php");
    $db = new Database();
    $db->CheckUser();
   
    /////////////////////////////////////////
    if(!isset($_GET['sid']) || !isset($_GET['cid'])){
        header("location: ../");
    }
    $st_id = $_GET['sid'];
    $cr_id = $_GET['cid'];

    ////////////////////////////////////////

        $sql = "SELECT * FROM tbl_stdcrs
                WHERE STUDENT_ID = '$st_id'
                AND COURSE_ID = '$cr_id';";

        if($db->numRows($db->dbQuery($sql)) == 1){
            $asql = "DELETE FROM tbl_stdcrs 
                     WHERE STUDENT_ID = '$st_id'
                     AND COURSE_ID = '$cr_id';";
        }
        else{
            $asql = "INSERT INTO tbl_stdcrs(SEMSTER, STUDENT_ID, COURSE_ID)
                     VALUES (0, '$st_id', '$cr_id')";
        }
        $db->dbQuery($asql);
        echo $asql;
?>