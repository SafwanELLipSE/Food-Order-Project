<!DOCTYPE html>
<?php 
include("includes/db.php"); 
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Account Login</title>
	
	<!--Font Awesome Link-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">AdminArea</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center"> Admin Area <small>Account Login</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form id="login" method="post" action="" class="well">
                  <div class="form-group">
                    <label>Email Address: </label>
                    <input type="text" name="email" class="form-control" placeholder="Enter Email">
                  </div>
                  <div class="form-group">
                    <label>Password: </label>
                    <input type="password" name="pass" class="form-control" placeholder="Password">
                  </div>
				  <input type="checkbox" name="remember"><label style="margin-left:10px;">Remember me ?</label>
                  <button type="submit" name="login" class="btn btn-default btn-block btn-success">Login</button>
				  <a href="../index.php" class="btn btn-default btn-block btn-info">Home Page</a>
            </form>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer" style="margin-top: 135px;">
      <p>Copyright <i class="far fa-copyright"></i> 2019 Purchase BD. All Rights Reserved.</p>
    </footer>
	
	<?php
		session_start();
		if(isset($_POST['login'])){
		
			$email = $_POST['email'];
			$pass = $_POST['pass'];
			
			echo $sel_c = "select * from admininfo where admin_password='$pass' AND admin_email='$email'";
			
			$run_c = mysqli_query($con, $sel_c);
			$check_admin = mysqli_num_rows($run_c); 
			
			if(isset($check_admin))
			{
				$_SESSION['patientSession'] = $email;
				
				echo "<script>alert('You logged in successfully, Thanks!')</script>";
				echo "<script>window.open('index.php','_self')</script>";
			}
			else
			{
				echo "<script>alert('Password or email is incorrect, please try again!')</script>";
				exit();
			}
			
		}

	?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
