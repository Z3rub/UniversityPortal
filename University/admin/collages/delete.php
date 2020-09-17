<?php
    include "../../include/db/Database.php";
    $db = new Database();
    $id = $_GET['id'];
    $s1= "DELETE FROM tbl_teachers WHERE T_ID = $id";
    $r1 = $db->dbQuery($s1);
    echo "<meta http-equiv='refresh' content='0;URL=index.php?view=list'>";
?>
<!_ Important Notes _>
<!--
     /*
    alter table tbl_privileges add foreign key(userid)
    references tbl_users(id) ON DELETE CASCADE ON UPDATE CASCADE
    */
    /*
    $s= "DELETE FROM tbl_privileges WHERE userid = $id";
    $r = $db->dbQuery($s);
    */
-->