<?php 
$errorMsg = "";
    include("include/db/Database.php");
    $db = new Database();
    //$db->CheckLogin();
    if(isset($_POST['studentname']))
        $errorMsg = $db->doLogin(0); 
    elseif(isset($_POST['teachername']))
        $errorMsg = $db->doLogin(1); 


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Free Responsive Admin Theme - ZONTAL</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="include/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="include/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="include/css/style.css" rel="stylesheet" />
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="left-div"> 
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
   
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="navbar col-md-12">
                    <div class="navbar-inner">
                        <div class="container">
                            <ul class="nav nav-pills">
                                <li class="active col-md-3">
                                    <h4 class="page-head-line">
                                    <a href="#tab1" data-toggle="tab">
                                        Teacher Login 
                                    </a>
                                    </h4>
                                </li>
                                <li class="col-md-3">
                                    <h4 class="page-head-line">
                                    <a href="#tab2" data-toggle="tab">
                                        Student Login
                                    </a>
                                    </h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <form  method="post" action="">
                            <?php if($errorMsg !=""){ ?>
                            <div class="alert alert-danger" role="alert">
                            <?php echo $errorMsg; ?>
                            </div>
                            <?php } ?>
                            <div class="col-md-6">
                                 <label>Teacher Email : </label>
                                    <input type="text" class="form-control" name="teachername" />
                                    <label>Teacher Password :  </label>
                                    <input type="password" class="form-control" name="teacherpass" />
                                    <hr />
                                    <button class="btn btn-primary" type="submit" name="btnLogin"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Teacher In </button>&nbsp;
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <form  method="post" action="">
                            <?php if($errorMsg !=""){ ?>
                            <div class="alert alert-danger" role="alert">
                            <?php echo $errorMsg; ?>
                            </div>
                            <?php } ?>
                            <div class="col-md-6">
                                 <label>Student Email: </label>
                                    <input type="text" class="form-control" name="studentname" />
                                    <label>Student Password :  </label>
                                    <input type="password" class="form-control" name="studentspass" />
                                    <hr />
                                    <button class="btn btn-success " type="submit" name="btnLogin"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Student In </button>&nbsp;
                            </div>
                        </form>
                    </div>
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
    <script src="include/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="include/js/bootstrap.js"></script>
</body>
</html>
