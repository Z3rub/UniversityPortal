<!DOCTYPE html>
<?php
 // echo __FILE__."<br>";
   $this_file= str_replace('\\', '/', __FILE__);
 // echo $_SERVER['DOCUMENT_ROOT']."<br>";
  $docRoot = $_SERVER['DOCUMENT_ROOT']; // المجلد الرئيسي الذي يتم فيه تخزين الموقع
  $webRoot = str_replace(array($docRoot, 'student/include/template.php'), '', $this_file);
  define('WEB_ROOT', $webRoot);
  //echo WEB_ROOT."<br>";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>WELCOME</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="<?= WEB_ROOT ?>include/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="<?= WEB_ROOT ?>include/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="<?= WEB_ROOT ?>include/css/style.css" rel="stylesheet" />
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="left-div">   
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a class="menu-top-active" href="<?= WEB_ROOT ?>student/index.php">Home</a></li>
                            <li><a href="<?= WEB_ROOT ?>student/courses/">Courses</a></li>
                            <li><a href="<?= WEB_ROOT ?>student/logout.php">Log out</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php require "$content"; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2015 YourCompany | By : <a href="http://www.designbootstrap.com/" target="_blank">DesignBootstrap</a>
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="<?= WEB_ROOT ?>include/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="<?= WEB_ROOT ?>include/js/bootstrap.js"></script>
</body>
</html>
