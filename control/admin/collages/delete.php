<?php
    include ("../../include/db/Database.php");
    $db = new Database();
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_education
            WHERE ID = '$id';";
    $db->dbQuery($sql);
    header("location:index.php");
?>