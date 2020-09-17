<?php
   include "../include/db/Database.php";
   $db = new Database();
   $db->CheckUser();
  
   $pageTitle = "e4x.com";
   $content = "main.php";
   include "include/template.php";
  
?>



