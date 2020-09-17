<?php
    include("../../../include/db/Database.php");
    $db = new Database();
    $db->CheckUser(0);
   
    /////////////////////////////////////////
    if(!isset($_GET['qid'])){
        header("location: ../courses/index.php");
    }
    $st_id = $_GET['sid'];
    $qt_id = $_GET['qid'];
    $an_id = $_GET['aid'];

    ////////////////////////////////////////

        $sql = "SELECT * FROM tbl_student_answer
                WHERE ST_ID = '$st_id'
                AND Q_ID = '$qt_id';";
        if($db->numRows($db->dbQuery($sql)) == 1){
            $asql = "UPDATE tbl_student_answer SET
                     st_ans = '$an_id'
                     WHERE ST_ID = '$st_id'
                     AND Q_ID = '$qt_id';";
        }
        else{
            $asql = "INSERT INTO tbl_student_answer(ST_ID, Q_ID, st_ans)
                     VALUES ('$st_id', '$qt_id', '$an_id')";
        }
        $db->dbQuery($asql);
        echo $asql;
?>