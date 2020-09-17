<?php
	session_start();
	if(isset($_SESSION['Ad_ID'])){
		$_SESSION = array();
		session_destroy();
		header("location: ../login.php");
	}
?>