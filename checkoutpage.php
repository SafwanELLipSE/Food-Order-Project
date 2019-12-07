<!DOCTYPE html>
<?php 
	session_start();
	include("functions/function.php");
	include("includes/db.php");
	if(!isset($_SESSION['patientSession'])){
	echo "<script>window.open('customerlogin.php?not_User=You are not an User!','_self')</script>";
}
else {
?>
<html>
<head>

	<!-- Title of Website -->
	<title>Food Order | CheckOut Page</title>
	<!-- Required meta tags -->
	<meta charset="UTF-8">
	<meta name ="viewpoint" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	
	<!--Font Awesome Link-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	
	<!-- Bootstrap Link -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	
	<!-- Css main -->
	<link rel="stylesheet" type="text/css" href="styles/style1.css"> 
	
	
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
						echo "<b>Welcome Guest !</b>";
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
			<div class="row">	
				<div class="col-md-8">	
					<div class="card">
						<div class="card-header bg-dark">	
							<div class="float-left text-light"><span><i class="fas fa-hamburger"></i></span> Review Order</div><a href="cart.php" class="float-right text-light">Edit Cart</a>
						</div>
						<div class="card-body">
					<form action="checkoutpage.php" method="post" enctype="multipart/form-data">
							<?php 
								$total = 0;
								
								global $con; 
								
								$ip = getIp(); 
								
								$sel_price = "select * from cart where ip_add='$ip'";
								
								$run_price = mysqli_query($con, $sel_price); 
								
								while($p_price = mysqli_fetch_array($run_price)){
								
									$pro_id = $p_price['p_id']; 
									$pro_qty = $p_price['qty']; 
									
									$pro_price = "select * from product where product_id='$pro_id'";
									
									$run_pro_price = mysqli_query($con,$pro_price); 
									while ($pp_price = mysqli_fetch_array($run_pro_price)){

										$product_price = array($pp_price['product_price']);
										$product_name = $pp_price['product_name'];
										$product_desc = $pp_price['product_desc'];
										$product_image = $pp_price['product_image']; 
										$single_price = $pp_price['product_price'];
										
										$values = array_sum($product_price); 

										$total += $values; 								
							?>
								<tr>
									<td class="Product">
										<div class="row">
											<div class="col-sm-2 hidden-xs"><img src="admin_area/product_images/<?php echo $product_image; ?>" style = "width:100px; height:100px;" alt="No image"/></div>
											<div class="col-sm-10">
												<h4 class="ml-4"><?php echo $product_name; ?></h4>
												<p class="ml-4">Quantity: <?php echo $pro_qty; ?></p>												
												<p class="ml-4">Price: <?php echo $single_price; ?> Taka</p>
											</div>
										</div>
									</td>
								</tr>
								<hr>
							<?php
									}
								}
							?>
						</div> 
						<div class="card-footer">
								<p class="float-left">Total Order Price:</p>
								<p class="float-right"><strong>
								<?php
									if($pro_qty == 0)
									{
										$pro_qty = 1;
										echo $total=$total*$pro_qty;
									}
									else 
									{
										$qty = $pro_qty;
										echo $total = $total*$pro_qty;
									}
								?>
								</strong></p>
								<button style="margin-top:30px;margin-left:325px;" name="place_order" type="submit" class="btn btn-primary btn-submit-fix">Place Order</button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</section>
			
	
	<footer style="margin-top:200px;">
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
					<a href="cart.php" class="btn btn-success"><i class="fas fa-cart-arrow-down"></i> CheckoOut Item</a>
				</div>
			</div>
		</div>
	</div>
	<?php
		if(isset($_POST['place_order']))
		{	
			// this is about the customer
			$user = $_SESSION['patientSession'];
				
			$get_cus = "select * from customer where customer_email='$user'";	
			$run_cus = mysqli_query($con, $get_cus); 
			$row_cus = mysqli_fetch_array($run_cus); 
				
			$cus_id = $row_cus['customer_id'];
			$cus_email = $row_cus['customer_email'];
			$cus_name = $row_cus['customer_name'];
			
			// inserting the order into table
			$insert_order = "insert into ordertbl(p_id,c_id,qty,order_date,amount) values('$pro_id','$cus_id','$qty',NOW(),$total)";
			$run_order = mysqli_query($con, $insert_order); 
			
			//removing the products from cart
			$empty_cart = "delete from cart";
			$run_cart = mysqli_query($con, $empty_cart);

			if($run_order)
			{
				echo "<h2>Welcome:" . $_SESSION['customer_email']. "<br>" . "Your Order was successful!</h2>";
				echo "<script>window.open('cart.php','_self')</script>";
			}
			else 
			{
				echo "<h2>Welcome Guest, Payment was failed</h2><br>";
			}		
		}
	?>
	<script src="js/bootstrap.bundle.min.js"></script>
	<!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>	
	
</body>
</html>
<?php
	}
?>