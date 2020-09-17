<?php
   include "../include/db/Database.php";
   $db = new Database();
   $db->CheckUser();
  
   $pageTitle = "U Admin";
   $content = "main.php";
   include "include/template.php";
  
?>



