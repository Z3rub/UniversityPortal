<?php session_start();
  include "../../include/db/Database.php";
  $db = new Database();
    $db->CheckUser();
  $view = (isset($_GET['view']) && $_GET['view'] !='') ? $_GET['view'] : ''; // if condition
  $pageTitle ='University Strucure Administation';
  switch($view)
	{
		case 'list':
		$content = 'list.php';
		break;
		case 'add':
		$content = 'add.php';
		break;
		case 'modify':
		$content = 'modify.php';
		break;
		default:
		$content = 'list.php';
	}

	include "../include/template.php";

?>