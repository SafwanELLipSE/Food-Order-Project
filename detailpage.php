<!DOCTYPE html>
<?php 
	session_start();
	include("functions/function.php");
?>
<html>
<head>

	<!-- Title of Website -->
	<title>Food Order | Product Detail Page</title>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<meta name ="viewpoint" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	
	<!--Font Awesome Link-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	
	<!-- Bootstrap Link -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	
	<!-- Css main -->
	<link rel="stylesheet" type="text/css" href="styles/style4.css"> 
	

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
						<li class="nav-item active">
							<a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-concierge-bell"></i> Menu
							</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#"><i class="fas fa-hamburger"></i> All item</a>
							<?php getMenu() ?>
						</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-concierge-bell"></i> Categroy
							</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#"><i class="fas fa-utensils"></i> Daily</a>
							<?php getCats()?>
						</div>
						</li>
						<li class="nav-item">
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
	
	<section class = "maincontent mt-3">
		<div class="container">
			<?php 
			
			if(isset($_GET['pro_id']))
			{
	
				$product_id = $_GET['pro_id'];
				$get_pro = "select * from product where product_id = '$product_id'";
				$run_pro = mysqli_query($con, $get_pro); 
				
				while($row_pro = mysqli_fetch_array($run_pro))
					{
						$pro_id = $row_pro['product_id'];
						$pro_cat = $row_pro['product_cat'];
						$pro_men = $row_pro['product_men'];
						$pro_name = $row_pro['product_name'];
						$pro_price = $row_pro['product_price'];
						$pro_image = $row_pro['product_image'];
						$pro_desc = $row_pro['product_desc'];
					     

						$get_men = "select * from menu where men_id = '$pro_men'"; 
						$run_men = mysqli_query($con, $get_men);
						while($row_men = mysqli_fetch_array($run_men))
						{
							
							$menu_id = $row_men['men_id'];
							$menu_name = $row_men['men_name'];
							 
							$get_cat = "select * from category where cat_id = '$pro_cat'"; 
							$run_cat = mysqli_query($con, $get_cat);
							while($row_cat = mysqli_fetch_array($run_cat))
							{
							
								$category_id = $row_cat['cat_id'];
								$category_name = $row_cat['cat_name'];
								
								echo "
									<div class='row'>
										<div class='col-md-5'>
											<img src='admin_area/product_images/$pro_image' class='d-block' style='width: 400px; height:400px'>
										</div>
										<div class='col-md-7'>
											<h1>$pro_name</h1>
											<p> Item Code: $pro_id</p>
											
											<i class='fas fa-star text-success'></i>
											<i class='fas fa-star text-success'></i>
											<i class='fas fa-star text-success'></i>
											<i class='fas fa-star-half-alt text-success'></i>
											<i class='far fa-star text-success'></i>
											<hr>
											<h2>Price: <span class = 'text-success'> $pro_price Taka <span> </h2>
											<h4>Item: $menu_name</h4> 
											<h4>Categroy: $category_name</h4>
											<label>Quantity: </label>
											<input type='text' value = '1'>
											<a href = 'detailpage.php?add_cart=$pro_id' class='btn btn-success'>Add to Cart</a>
										</div>
									</div>
									<div class='row mt-4'>
										<div class='col-md-12'>
											<h4 class = 'text-success'>Product Description</h4>
											<hr>
											<p class = 'mt-2 p-1 float-left'>$pro_desc</p>
										</div>
									</div>
								
								";
							}
						}
					}	
				}
			?>
		</div>
		<?php cart();?>
	</section>
	
	
	<footer>
		<div class="container-fluid bg-dark text-light mt-3 p-3">
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