<!DOCTYPE html>
<?php 
session_start();
include("functions/function.php");
include("includes/db.php"); 
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name ="viewpoint" content="width=device-width, initial-scale=1.0">
	<title>Food Order | Registration Form</title>
	<!--Font Awesome Link-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<!-- Bootstrap Link -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/style2.css">
</head>
<body>

	<div class="container mb-5">
		<div class="row">
			<div class="col-md-7">
				<h1 class="text-left">Online Registration Form</h1>
				<p>Dinner is often a very celebratory environment, a very safe place, a time to reflect and let the day go and enjoy good food and good wine. It's a very peaceful moment during the day. A great dinner can change your day around. - Brett Gelman</p>
			</div>
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-6">
						<h3 class="text-left">Registration Form</h3>
					</div>
					<div class="col-md-6">
						<i class="fas fa-pencil-alt"></i>
					</div>
				</div>
				<hr>
				<form method="post" action="register.php" enctype="multipart/form-data"> 
					<div class="row">
						<label class="label col-md-2 control-label">Name:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="c_name" placeholder="Full Name">
						</div>
					</div>
					<div class="row">
						<label class="label col-md-2 control-label">Email:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="c_email" placeholder="E-mail">
						</div>
					</div>
					<div class="row">
						<label class="label col-md-2 control-label">Password:</label>
						<div class="col-md-10">
							<input type="Password" class="form-control" name="c_pass" placeholder="Password">
							<input type="checkbox"><small> Remember me</small>
						</div>
					</div>
					<div class="row">
						<label class="label col-md-2 control-label">Image:</label>
						<div class="col-md-10 mt-3 text-light">
							<input type="file" name="c_image">
						</div>
					</div>
					<div class="row">
						<label class="label col-md-2 control-label">Country:</label>
						<div class="col-md-10">
							<select class="form-control" name="c_country">
								<option>Select a Country</option>
								<option>Bangladesh</option>
								<option>Afghanistan</option>
								<option>India</option>
								<option>Japan</option>
								<option>Pakistan</option>
								<option>Israel</option>
								<option>Nepal</option>
								<option>United Arab Emirates</option>
								<option>United States</option>
								<option>United Kingdom</option>
							</select>
						</div>
					</div>	
					<div class="row">
						<label class="label col-md-2 control-label">City:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="c_city" placeholder="City">
						</div>
					</div>
					<div class="row">
						<label class="label col-md-2 control-label">Contact:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="c_contact" placeholder="Contact">
						</div>
					</div>
					<div class="row">
						<label class="label col-md-2 control-label">Address:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name="c_address" placeholder="Address">
						</div>
					</div>
					<a href="#"><input type="submit" name="register" class="btn btn-info" value= "Register"></a>
					<a href="index.php"><div class="btn btn-warning">Cancel</div></a>
				</form>
			</div>
		</div>
	</div>

	<!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- Latest compiled Popper -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>	
	<!-- Latest compiled FontAwesome Js -->
	<script src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</body>
</html>
<?php 
	if(isset($_POST['register'])){
	
		$ip = getIp();
		
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];
		$c_country = $_POST['c_country'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
	
		
		move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
		
		$insert_c = "insert into customer (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
	
		$run_c = mysqli_query($con, $insert_c); 
		
		$sel_cart = "select * from cart where ip_add='$ip'";
		$run_cart = mysqli_query($con, $sel_cart); 
		$check_cart = mysqli_num_rows($run_cart); 
		
		if($check_cart==0)
		{
			$_SESSION['customer_email']=$c_email; 
			
			echo "<script>alert('Account has been created successfully, Thanks!')</script>";
			echo "<script>window.open('customer/index.php','_self')</script>";
		}
		else 
		{
			$_SESSION['customer_email']=$c_email; 
		
			echo "<script>alert('Account has been created successfully, Thanks!')</script>";
			echo "<script>window.open('checkout.php','_self')</script>";
		}
	}

?>	
	
	
	
	
	
	