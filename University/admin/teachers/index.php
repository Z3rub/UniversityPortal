<?php session_start();
  include "../../include/db/Database.php";
  $db = new Database();
    $db->CheckUser();
  $view = (isset($_GET['view']) && $_GET['view'] !='') ? $_GET['view'] : '';

  switch($view)
	{
		case 'list':
		$pageTitle ='إدارة المعلمين - عرض المعلمين';
		$content = 'list.php';
		break;
		case 'add':
		$pageTitle ='إدارة المعلمين - إضافة المعلمين';
		$content = 'add.php';
		break;
		case 'modify': //course
		$pageTitle ='إدارة المعلمين - التعديل على المعلمين';
		$content = 'modify.php';
		break;
		case 'course': //
		$pageTitle ='إدارة المعلمين - التعديل على المعلمين';
		$content = 'course.php';
		break;
		default:
		$pageTitle ='إدارة المعلمين - عرض المعلمين';
		$content = 'list.php';
	}

	include "../include/template.php";

?>