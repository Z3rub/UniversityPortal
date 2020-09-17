<?php
   include "../include/db/Database.php";
   $db = new Database();
   $db->CheckUser(1);
  
   $pageTitle = "U Admin";
   $content = "main.php";
   include "include/template.php";
  
?>



