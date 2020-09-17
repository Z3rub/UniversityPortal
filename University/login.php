<?php
    $errorMsg = "";
    include("include/db/Database.php");
    $db = new Database();
    $db->CheckLogin();
    if(isset($_POST['username']))
        $errorMsg = $db->doLogin(); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap Admin Theme v3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="include/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="include/css/styles.css" rel="stylesheet">

  </head>
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.php">Bootstrap Admin Theme</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <form  method="post" action="">
          					<?php if($errorMsg !=""){ ?>
            				<div class="alert alert-danger" role="alert">
                				<?php echo $errorMsg; ?>
            				</div>
            				<?php } ?>
          					<div class="content-wrap">
          						<input class="form-control" name="username" type="text" placeholder="E-mail address">
			                	<input class="form-control" name="password" type="password" placeholder="Password">
            					<input class="form-check-input" type="checkbox"> Remember Password</label>
	          						<button class="btn btn-primary btn-block" type="submit" name="btnLogin">
	          						Sign in
	          						</button>
          					</div>
          				</form>
			        </div>

			        <div class="already">
			            <p>Don't have an account yet?</p>
			            <a href="signup.html">Sign Up</a>
			        </div>
			    </div>
			</div>
		</div>
	</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="include/jquery/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="include/bootstrap/js/bootstrap.min.js"></script>
    <script src="include/js/custom.js"></script>
  </body>
</html>