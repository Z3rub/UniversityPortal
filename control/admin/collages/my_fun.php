<?php
	include ("../../include/db/Database.php");
    $id = $_GET['id'];
    $str = $_GET['str'];
    $pass = $_GET['pass'];

    $db = new Database();
	    if($str != '' && $pass != ''){
		    if($id == -1)
			    $sql = "INSERT INTO tbl_education (Title,PID, Password)
			            VALUES('$str', 0, '$pass')";
			else
				$sql = "UPDATE tbl_education
						SET		Title = '$str',
								Password = '$pass' 
						WHERE ID = '$id';";
		    $db->dbQuery($sql);
	}
?>