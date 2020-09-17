<?php
    $errorMsg = "";
    include("include/db/Database.php");
    $db = new Database();
    $db->CheckLogin();
    if(isset($_POST['username']))
        $errorMsg = $db->doLogin(); //login
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Admin</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="include/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="include/css/styles.css" rel="stylesheet">
    </head>
    <body>
<!-- header -->
        <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand">ADMIN SITE | LOGIN</a>
                </div>
            </div>
            <!-- /container -->
        </div>
<!-- /Header -->

<!-- Main -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                </div>
                <!-- /col-3 -->
                <div class="col-sm-4">
                    <!-- column 2 -->
                    <a href="#"><strong>L O G I N</strong></a>
                    <hr>
                    <div>
                        <form class="form-signin" method="post" action="">
          <?php if($errorMsg !=""){ ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMsg; ?>
            </div>
            <?php } ?>
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" id="exampleInputEmail1" type="text" name="username" aria-describedby="emailHelp" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" name="password" id="exampleInputPassword1" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="btnLogin">Sign in</button>
        </form>
                    </div>
                </div>
                <!--/col-span-9-->
            </div>
        </div>
<!-- /Main -->
<footer class="text-center">T H I S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Y O U R&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S I T E</footer>
    </body>
</html>
