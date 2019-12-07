<!DOCTYPE html>
<?php 
	session_start();
	include("functions/function.php"); 
	include("includes/db.php");
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
    <title>User Profile | Reservation Detail</title>
	
	<!--Font Awesome Link-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
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
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="orderpage.php">My Order</a></li>
            <li><a href="myAccount.php">My Account</a></li>
            <li class="active"><a href="reservationpage.php">Check Reservation</a></li>
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Customer Detail Page<small>Manage Customer Detail</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li>Reservation List</li>
          <li class="active">Reservation Detail</li>
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
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Reservation Detail</h3>
              </div>
              <div class="panel-body">	
				<table class="table table-striped table-hover">
				<?php
					if(isset($_GET['reservation_id']))
					{					
						$reservation_id = $_GET['reservation_id'];
						$get_res = "select * from reservation where reservation_id ='$reservation_id'";
						$run_res = mysqli_query($con, $get_res); 
						
						$row_res = mysqli_fetch_array($run_res);
						$res_id = $row_res['reservation_id'];
						$res_email = $row_res['reservation_email'];
						$res_person = $row_res['reservation_person'];
						$res_date = $row_res['reservation_date'];
						$res_time = $row_res['reservation_time'];
						
						$get_cus = "select * from customer where customer_email = '$res_email'";
						$run_cus = mysqli_query($con, $get_cus);
						
						$row_cus = mysqli_fetch_array($run_cus);
						
						$cus_id = $row_cus['customer_id'];
						$cus_country = $row_cus['customer_country'];
						$cus_email = $row_cus['customer_email'];
						$cus_city = $row_cus['customer_city'];
						$cus_name = $row_cus['customer_name'];
						$cus_address = $row_cus['customer_address'];
						$cus_pass = $row_cus['customer_pass'];
						$cus_contact = $row_cus['customer_contact'];
						$cus_image = $row_cus['customer_image'];
						
						echo
						"
						  <div class='row'>
							<div class='col-md-6'>
								<img src='../customer/customer_images/$cus_image' class='img-rounded' style='width:250px; height:250px;'>
							</div>
							<div class='col-md-6'>
								<h3><strong>Name:</strong> $cus_name</h3>
								<h5>ID: $cus_id</h5>
								<h5>Email: $res_email;</h5>
								<h5>Password: $cus_pass</h5>
								<h5>Address: $cus_address</h5>
								<h5>Country: $cus_country</h5>
								<h5>City: $cus_city</h5>
								<h5>Contact: $cus_contact</h5>
								<hr>
								<h5>Date: $res_date</</h5>
								<h5>Time: $res_time</</h5>
								<h5>Person: $res_person</</h5>
							</div>
						  </div>
						";	
					}
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