<!DOCTYPE html>
<?php
	session_start();
	include("includes/db.php");
	include("functions/function.php");
?>
<html>
<head>

	<!-- Title of Website -->
	<title>Food Order | Reservation Form</title>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<meta name ="viewpoint" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	
	<!--Font Awesome Link-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	
	<!-- Bootstrap Link -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	
	<!-- Css main -->
	<link rel="stylesheet" type="text/css" href="styles/reservation.css"> 
	
	<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

</head>
<body>

	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class = "container">
				<a class="navbar-brand" href="#">
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
				</a>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-lg-auto">
						<li class="nav-item">
							<a class="nav-link" href="register.php"><i class="fas fa-registered"></i> Register</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="customer/index.php"><i class="far fa-user"></i> My Account</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="cart.php"><i class="fas fa-cart-plus"></i> Go to Cart</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> LogIn</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> LogOut</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class = "container">
				<img src="images/logo.jpg" class="d-block" alt="Logo" style = "width: 70px; height: 45px;"><a class="navbar-brand ml-2" href="#"> Food Order</a>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-lg-auto">
						<li class="nav-item">
							<a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="menu.php"><i class="fas fa-concierge-bell"></i> Menu</a>
						</li>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="menu.php"><i class="fas fa-concierge-bell"></i> Categroy</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="reservation.php"><i class="fas fa-book"></i> Reservation</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact.php"><i class="far fa-address-card"></i> Contact Us</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>	
	
	<section class = "maincontent">
		<div class="container mb-5">
			<div class="row">
				<div class="col-md-7">
					<h1 class="text-left">Reserve a Table!</h1>
					<p>Dinner is often a very celebratory environment, a very safe place, a time to reflect and let the day go and enjoy good food and good wine. It's a very peaceful moment during the day. A great dinner can change your day around. - Brett Gelman</p>
				</div>
				<div class="col-md-5 mb-5">
					<div class="row">
						<div class="col-md-6">
							<h3 class="text-left">Table Reservation</h3>
						</div>
						<div class="col-md-6">
							<i class="fas fa-pencil-alt"></i>
						</div>
					</div>
					<hr>
				<form action="reservation.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<label class="label col-md-2 control-label">Email:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="email" placeholder="E-mail">
						</div>
					</div>
					<div class="row">
						<label class="label col-md-2 control-label">Persons</label>
						<div class="col-md-10">
							<select name="person" class="form-control">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							</select>
						</div>
					</div>
					<div class="row form-group">
						<label class="label col-md-2 control-label" for="date-start">Date</label>
						<div class="col-md-10">
							<input type="date" class="form-control" name="Date">
						</div>
					</div>
					<div class="row form-group">
						<label class="label col-md-2 control-label" for="date-start">Time</label>
						<div class="col-md-10">
							<input type="time" class="form-control" name="Time">
						</div>
					</div>				
					<a href="#"><button type="submit" name="Done_Reservation" class="btn btn-info">Submit</button></a>
					<a href="index.php"><div class="btn btn-warning">Cancel</div></a>
				</form>
				</div>
			</div>
		</div>	
	</section>
	<?php 
		if(isset($_POST['Done_Reservation']))
		{
			//getting the text data from the fields
			$reservation_email = $_POST['email'];
			$reservation_person = $_POST['person'];
			$reservation_date = $_POST['Date'];
			$reservation_time = $_POST['Time'];
			
			$insert_con = "insert into reservation(reservation_email,reservation_person,reservation_date,reservation_time) values ('$reservation_email','$reservation_person','$reservation_date','$reservation_time')";
			$run_con = mysqli_query($con, $insert_con); 
			 
			if($run_con)
			{
				echo "<script>alert('Reservation has been completed!')</script>";
				echo "<script>window.open('reservation.php','_self')</script>";
			}
		}
	?>
	<footer>
		<div class="container-fluid bg-dark text-light p-3">
			<div class="container text-center">
					Copyright <i class="far fa-copyright"></i> 2019 Purchase BD. All Rights Reserved.
			</div><!--container-->
		</div> 
	</footer>

	
	<script src="js/bootstrap.bundle.min.js"></script>
	<!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>	
	
</body>
</html>