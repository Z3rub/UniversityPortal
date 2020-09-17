<!DOCTYPE html>
<?php
 // echo __FILE__."<br>";
   $this_file= str_replace('\\', '/', __FILE__);
 // echo $_SERVER['DOCUMENT_ROOT']."<br>";
  $docRoot = $_SERVER['DOCUMENT_ROOT']; // المجلد الرئيسي الذي يتم فيه تخزين الموقع
  $webRoot = str_replace(array($docRoot, 'admin/include/template.php'), '', $this_file);
  define('WEB_ROOT', $webRoot);
  //echo WEB_ROOT."<br>";
?>
<html lang="en">
    <!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title><?= $pageTitle ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
       
        
    <link href="<?= WEB_ROOT ?>include/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= WEB_ROOT ?>include/css/styles.css" rel="stylesheet" type="text/css" /> 
</head>
<!-- END HEAD -->
<body>
    <div class="header">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <!-- Logo -->
                  <div class="logo">
                     <h1><a href="<?= WEB_ROOT ?>"><?=  $_SESSION['uni_name']?> Admin</a></h1>
                  </div>
               </div>
            </div>
         </div>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar content-box" style="display: block;">
                    <ul class="nav">
                        <!-- Main menu -->
                        <li class="current"><a href="<?= WEB_ROOT ?>admin"><i class="glyphicon glyphicon-home"></i> Home</a></li>
                        <li><a href="<?= WEB_ROOT ?>admin/collages"><i class="glyphicon glyphicon-copyright-mark"></i> Collages</a></li>
                        <!--
                        <li><a href="#"><i class="glyphicon glyphicon-bookmark"></i> Departments</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-bold"></i> Branches</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-book"></i> Courses</a></li>
                        -->
                        <li><a href="<?= WEB_ROOT ?>admin/teachers"><i class="glyphicon glyphicon-user"></i>Teachers</a></li>
                        <li><a href="<?= WEB_ROOT ?>admin/students"><i class="glyphicon glyphicon-pencil"></i>Students</a></li>
                        <li><a href="<?= WEB_ROOT ?>admin/logout.php"><i class="glyphicon glyphicon-log-out"></i>Log Out</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <div class="content-box-large">
                  <?php require "$content"; ?>
                </div>
            </div>
        </div>  
    </div>

    <footer style="position: fixed; width:100%;">
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2017 <a href='#'>NextStep</a>
            </div>
            
        </div>
    </footer>
    
    <!-- BEGIN CORE PLUGINS -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?= WEB_ROOT ?>include/jquery/jquery.js" type="text/javascript"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?= WEB_ROOT ?>include/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= WEB_ROOT ?>include/js/custom.js"></script>
</body>

</html>