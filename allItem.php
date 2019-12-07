<!DOCTYPE html>
<?php
	session_start(); 
	include("functions/function.php");
?>
<html>
<head>

	<!-- Title of Website -->
	<title>Food Order | All Item Page</title>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<meta name ="viewpoint" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	
	<!--Font Awesome Link-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	
	<!-- Bootstrap Link -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	
	<!-- Css main -->
	<link rel="stylesheet" type="text/css" href="styles/main.css"> 

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
				<img src="images/logo.jpg" class="d-block" alt="Logo" style = "width: 70px; height: 45px;"><a class="navbar-brand ml-2 mr-5" href="#"> Food Order</a>
				
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-lg-auto">
						<form class="form-inline">
							<input class="form-control mr-sm-6 ml-5" type="search" placeholder="Search" name="user_query">
							<button class="btn btn-outline-success my-2 my-sm-0 ml-2" type="submit" name="search">Search</button>
						</form>
						<li class="nav-item">
							<a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="menu.php"><i class="fas fa-home"></i> Menu</a>
						</li>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="menu.php"><i class="fas fa-home"></i> Categroy</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="reservation.php"><i class="fas fa-book"></i> Reservation</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact.php"><i class="far fa-address-card"></i> Contact Us</a>
						</li>
					</div>
				</div>
			</div>
		</div>
	</header>		
	<section class = "maincontent">
		<!-- Upper Title -->
		<div class="container-fluid bg-light-gray">
			<div class="container pt-5">
				<div class="row">
					<h3>Item Menu</h3>
				</div><!--row-->
				<div class="underline">
				</div>
			</div><!--container-->
		</div><!--container fluid-->
		
		<!--Items-->
		<div class = "container mt-4">
			<div class = "row">	
				
			  <?php 
			  
				if(isset($_GET['search'])){
	
				$search_query = $_GET['user_query'];
				
				$get_pro = "select * from product where product_keywords like '%$search_query%'";
				
				$run_pro = mysqli_query($con, $get_pro);
				
				while($row_pro=mysqli_fetch_array($run_pro)){

					$pro_id = $row_pro['product_id'];
					$pro_cat = $row_pro['product_cat'];
					$pro_men = $row_pro['product_men'];
					$pro_name = $row_pro['product_name'];
					$pro_price = $row_pro['product_price'];
					$pro_image = $row_pro['product_image'];
					$pro_desc = $row_pro['product_desc'];
				
					echo "
							<div class = 'col-12 col-md-3 mb-4'>
							<div class = 'card'>
								<div class = 'card-header text-center'>	
									$pro_name
								</div>
									<img class= 'card-img-top' src='admin_area/product_images/$pro_image' alt='Card image' style='width:100%'>
								<div class='card-body'>
									<h4 class='card-title text-center'>Price: $pro_price Taka</h4>
									<p class='card-text text-center'>$pro_desc</p>
								</div> 
								<div class='card-footer'>
									<a class='btn btn-primary ml-5 text-white' href='detailpage.php?pro_id=$pro_id'><i class='fas fa-money-check'></i> CheckOut</a>
								</div>
							</div>
						</div>
					
					";
				
					}
				}
				else{
					echo 
					"	
						<div class = 'offset-md-3 col-md-4 mb-2'>
							<img src='images/noproduct.png' class='img-rounded ml-5'>
						</div>
						<div class = 'col-md-12 mb-5'>
							<h2 class='text-center text-sucess mb-5'>No products where found in this Menu!</h2>
						</div>
					
					";
				}
			  ?> 

			</div><!--row-->
		</div><!--container-->
	</section>
	
	<footer>
		<div class="container-fluid bg-dark text-light mt-5 p-5">
			<div class="container text-center">
					Copyright <i class="far fa-copyright"></i> 2019 Purchase BD. All Rights Reserved.
			</div><!--container-->
		</div> 
	</footer>

	
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
	
	<script src="js/bootstrap.bundle.min.js"></script>
	<!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>	
	
</body>
</html>