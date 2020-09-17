<?php
	include "../../include/db/Database.php";
	$db = new Database();
	$db->CheckUser(1);
	$view = (isset($_GET['view']) && $_GET['view'] !='') ? $_GET['view'] : '';
	$pageTitle ='University Strucure Administation';
	switch($view)
	{
		case 'list':
		$content = 'list.php';
		break;
		case 'students':
		$content = 'students.php';
		break;
		default:
		$content = 'list.php';
	}
	include "../include/template.php";
?>