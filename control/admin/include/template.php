<?php
 // echo __FILE__."<br>";
   $this_file= str_replace('\\', '/', __FILE__);
 // echo $_SERVER['DOCUMENT_ROOT']."<br>";
  $docRoot = $_SERVER['DOCUMENT_ROOT']; // المجلد الرئيسي الذي يتم فيه تخزين الموقع
  $webRoot = str_replace(array($docRoot, 'admin/include/template.php'), '', $this_file);
  define('WEB_ROOT', $webRoot);
  //echo WEB_ROOT."<br>";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Admin</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="<?= WEB_ROOT ?>include/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="<?= WEB_ROOT ?>include/css/styles.css" rel="stylesheet">
    </head>
    <body>
<!-- header -->
        <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">ADMIN SITE</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?= WEB_ROOT ?>admin/logout.php"><i class="glyphicon glyphicon-lock"></i> LOGOUT</a></li>
                    </ul>
                </div>
            </div>
            <!-- /container -->
        </div>
<!-- /Header -->

<!-- Main -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <!-- Left column -->
                    <strong>PAGES</strong>
                    <ul class="nav nav-stacked">
                        <li class="nav-header">
                            <ul class="nav nav-stacked collapse in" id="userMenu"> 
                                <li><a href="<?= WEB_ROOT ?>admin/collages"><i class="glyphicon glyphicon-cog"></i> U N I V E R S I T Y</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /col-3 -->
                <div class="col-sm-9">
                    <!-- column 2 -->
                    <a href="#"><strong>Hi, <?= $_SESSION['Ad_Name'] ?></strong></a>
                    <hr>
                    <div> 
                        <?php require "$content"; ?>
                    </div>
                </div>
                <!--/col-span-9-->
            </div>
        </div>
<!-- /Main -->
<footer class="text-center">T H I S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Y O U R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S I T E</footer>
    </body>
</html>