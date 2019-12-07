<!DOCTYPE html>
<?php 
	session_start();
	include("functions/function.php");
	include("includes/db.php");
?>
<html>
<head>

	<!-- Title of Website -->
	<title>Food Order | Contact Page</title>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<meta name ="viewpoint" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	
	<!--Font Awesome Link-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	
	<!-- Bootstrap Link -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	
	<!-- Css main -->
	<link rel="stylesheet" type="text/css" href="styles/contact.css">
	
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
							<a class="nav-link" href="button" data-toggle="modal" data-target="#addcart"><i class="fas fa-cart-plus"></i> Go to Cart</a>
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
						<li class="nav-item">
							<a class="nav-link" href="reservation.php"><i class="fas fa-book"></i> Reservation</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="contact.php"><i class="far fa-address-card"></i> Contact Us</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>					
	
	<section class = "maincontent">
		<div class = "container mt-4 mb-4">
			<div class = "row">	
				<div class = "col-md-12">
					<div class = "row" style = "margin-top: 12px; box-shadow: -1px 1px 50px 10px black;">
						<div class = "col-md-6 bg-light conme">
							<ul>
								<a href = "contact.html" style = "border-bottom: 2px solid #F44C89; padding: 10px;"> Contact Us</a>	
							</ul>
							<form action="contact.php" method="post" enctype="multipart/form-data">
							
								<label class = "label control-label">Name</label>
								<input type = "text" name="name" class="form-control" placeholder="Name" required>
								<label class = "label control-label">Email</label>
								<input type = "email" name="email" class="form-control" placeholder="Email" required>
								<label class = "label control-label">Message</label>
								<textarea name="message"></textarea>
								<a href="#"><button type="submit" name="Send_Message" class="btn btn-info">SEND MESSAGE</button></a>	
							
							</form>
							<?php 
								if(isset($_POST['Send_Message']))
								{
									//getting the text data from the fields
									$contact_name = $_POST['name'];
									$contact_email= $_POST['email'];
									$contact_message = $_POST['message'];
									
									$insert_con = "insert into contact(contact_name,contact_Email,contact_message) values ('$contact_name','$contact_email','$contact_message')";
									$run_con = mysqli_query($con, $insert_con); 
									 
									if($run_con)
									{
										echo "<script>alert('Contact has been Created!')</script>";
										echo "<script>window.open('contact.php','_self')</script>";
									}
								}
							?>
						</div>
						<div class = "col-md-6 bg-light comna">
							<ul>
								<a href = "contact.html" style = "border-bottom: 2px solid #F44C89; padding: 10px;"> Address</a>	
							</ul>
							<div class = "container mb-5 mt-5">
								<div class = "row">
									<div class = "col-md-6">								
										<p>
											965, East Shewrapara <br> 
											Kafrul, Dhaka-1216 <br> 
											Bangladesh <br>
											<i class="fas fa-mobile-alt"></i> Phone: 01677-560660 <br>
											<i class="fas fa-at"></i> Email: booking@haraj.com	<br>
											<i class="fas fa-globe"></i> Website: grandmoharaj.com
										</p>
									</div>
									<div class = "col-md-6">								
										<p>
										965, East Shewrapara <br> 
										Kafrul, Dhaka-1216 <br> 
										Bangladesh <br>
										<i class="fas fa-mobile-alt"></i> Phone: 01677-560660 <br>
										<i class="fas fa-at"></i> Email: booking@haraj.com <br>
										<i class="fas fa-globe"></i> Website: grandmoharaj.com
										</p>
									</div>
								</div>
							</div>
							<ul>
								<a href = "contact.html" style = "border-bottom: 2px solid #F44C89; padding: 10px;"> Social Media</a>	
							</ul>
							<div class = "container mb-3 mt-5">
								<div class = "row ml-2">
									<div class = "col-md-2">
										<a href="https://www.facebook.com"><i class="fab fa-3x fa-facebook-f text-primary"></i></a>
									</div>
									<div class = "col-md-2">
										<a href="https://plus.google.com/"><i class="fab fa-3x fa-google-plus-g text-danger"></i></a>
									</div>
									<div class = "col-md-2">
										<a href="https://twitter.com/"><i class="fab fa-3x fa-twitter text-success"></i></a>
									</div>
									<div class = "col-md-2">
										<a href="https://www.linkedin.com"><i class="fab fa-3x fa-linkedin-in text-warning"></i></a>
									</div>
									<div class = "col-md-2">
										<a href="https://www.instagram.com"><i class="fab fa-3x fa-instagram text-secondary"></i></a>
									</div>
								</div>
							</div>
							<ul>
								<a href = "contact.html" style = "border-bottom: 2px solid #F44C89; padding: 10px;"> Our Location</a>	
							</ul>
							<div class = "container">
								<a href="#"><div class="btn btn-info" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-map-marker-alt"></i> Map</div></a>	
								<hr>
								<img src="images/map.JPG" alt="Map Loction" class="img-thumbnail" height="250" width="510" style="margin-bottom: 15px;">
								<!-- Modal -->
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Map Location</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div id="mapwrap">
													<iframe height="300" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.es/maps?t=m&amp;ie=UTF8&amp;ll=23.792606,90.3750767&amp;spn=67.34552,156.972656&amp;z=2&amp;output=embed"></iframe>
												</div>	
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--Model for cart option-->
	<div class="modal fade" id="addcart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Total Item and Price</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
						<p class="mt-2 mb-1"><strong>Total Item:</strong><?php total_items();?></p>
						<P><strong>Total Price:</strong><?php total_price();?> Taka</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<a href="cart.php" class="btn btn-success"><i class="fas fa-cart-arrow-down"></i>CheckoOut Item</a>
				</div>
			</div>
		</div>
	</div>
	</section>
	
	<footer>
		<div class="container-fluid bg-dark text-light p-3">
			<div class="container text-center">
					Copyright <i class="far fa-copyright"></i> 2019 Purchase BD. All Rights Reserved.
			</div><!--container-->
		</div> 
	</footer>

	<script>
		CKEDITOR.replace( 'message' );
	</script>	
	
	<!--Model for cart option-->
	<div class="modal fade" id="addcart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Total Item and Price</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
						<p class="mt-2 mb-1"><strong>Total Item:</strong><?php total_items();?></p>
						<P><strong>Total Price:</strong><?php total_price();?> Taka</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<a href="cart.php" class="btn btn-success"><i class="fas fa-cart-arrow-down"></i> CheckoOut Item</a>
				</div>
			</div>
		</div>
	</div>
	
	<script src="js/bootstrap.bundle.min.js"></script>
	<!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>	
	
</body>
</html>