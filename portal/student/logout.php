<?php
	session_start();
	if(isset($_SESSION['st_id'])){
		$_SESSION = array();
		session_destroy();
		header("location: ../login.php");
	}
?>