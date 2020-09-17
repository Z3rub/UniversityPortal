<?php
	session_start();
	if(isset($_SESSION['u_id'])){
		$_SESSION = array();
		session_destroy();
		header("location: ../login.php");
	}
?>