<?php
    include "../../include/db/Database.php";
    $db = new Database();
    $db->CheckUser(1);
    /////////////////////////////////////////
    if(!isset($_GET['eid'])){
        header("location: ../courses/index.php");
    }
    $e_id = $_GET['eid'];
    $sql = "SELECT * FROM tbl_exam WHERE ID = '$e_id';";
    $exam = $db->dbRecord($db->dbQuery($sql));
    if($db->numRows() == 0)
         header("location: ../courses/index.php");
    $id= $exam[2];
    ////////////////////////////////////////
    $sql = "DELETE FROM tbl_exam WHERE ID = $e_id;";
    $rs = $db->dbQuery($sql);
    header("location: ../exams/index.php?view=list&id=$id");
?>