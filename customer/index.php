<!DOCTYPE html>
<?php
	session_start();
	include("includes/db.php"); 
	include("functions/function.php"); 
	if(!isset($_SESSION['patientSession'])){
	echo "<script>window.open('../customerlogin.php?not_User=You are not an User!','_self')</script>";
}
else {
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile | Main</title>
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
          <a class="navbar-brand" href="#">UserProfile</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Dashboard</a></li>
            <li><a href="orderpage.php">My Order</a></li>
            <li><a href="myAccount.php">My Account</a></li>
            <li><a href="reservationpage.php">Check Reservation</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">
			<?php 
				if(isset($_SESSION['patientSession']))
				{
					echo "<b>Welcome: </b>" . $_SESSION['patientSession'];
				}
				else
				{
					echo "Welcome Guest !";
				}
			?>
			</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile Page <small>Manage Your Profile</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item active main-color-bg">
                <i class="fa fa-cog fa-spin"></i> Dashboard
              </a>
              <a href="orderpage.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> My Order</a>
              <a href="myAccount.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> My Account</a>
              <a href="reservationpage.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Check Reservation</a>
            </div>
          </div>
          <div class="col-md-9">

              <!-- Latest Users -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Latest nformations</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                      <h3>Latest Item</h3>
						<?php 
							latestItem();
						?>
                  </table>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
		Copyright <i class="far fa-copyright"></i> 2019 Purchase BD. All Rights Reserved.
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php
	}
?>