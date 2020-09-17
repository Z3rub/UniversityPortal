<?php
    include "../../../include/db/Database.php";
    $db = new Database();
    $db->CheckUser(1);
    /////////////////////////////////////////
    if(!isset($_GET['qid'])){
        header("location: ../courses/index.php");
    }
    $q_id = $_GET['qid'];
    $sql = "SELECT * FROM tbl_mcq WHERE Q_ID = '$q_id';";
    $quiz = $db->dbRecord($db->dbQuery($sql));
    if($db->numRows() == 0)
         header("location: ../courses/index.php");
    $id= $quiz[7];
    ////////////////////////////////////////
    $sql = "DELETE FROM tbl_mcq WHERE Q_ID = $q_id;";
    $rs = $db->dbQuery($sql);
    header("location: ../index.php?view=quiz&qid=$id");
?>