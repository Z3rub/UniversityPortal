<?php
	session_start();
	if(isset($_SESSION['tr_id'])){
		$_SESSION = array();
		session_destroy();
		header("location: ../login.php");
	}
?>