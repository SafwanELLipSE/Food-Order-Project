<?php 
include("includes/db.php"); 
include("functions/function.php");
?>
<?php 
session_start();
	if(isset($_POST['login'])){
	
		$c_email = $_POST['email'];
		$c_pass = $_POST['pass'];
		
		echo $sel_c = "select * from customer where customer_pass='$c_pass' AND customer_email='$c_email'";
		
		$run_c = mysqli_query($con, $sel_c);
		$check_customer = mysqli_num_rows($run_c); 
		
		if($check_customer == 0){
		
			echo "<script>alert('Password or email is incorrect, please try again!')</script>";
			exit();
		}
		
		$ip = getIp(); 
		
		$sel_cart = "select * from cart where ip_add='$ip'";
		
		$run_cart = mysqli_query($con, $sel_cart); 
		$check_cart = mysqli_num_rows($run_cart); 
		
		if($check_customer > 0 AND $check_cart == 0)
		{
			$_SESSION['patientSession'] = $c_email;
			
			echo "<script>alert('You logged in successfully, Thanks!')</script>";
			echo "<script>window.open('customer/index.php','_self')</script>";	
		}
		else 
		{
			$_SESSION['patientSession'] = $c_email;
			
			echo "<script>alert('You logged in successfully, Thanks!')</script>";
			echo "<script>window.open('cart.php','_self')</script>";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Food Order | Login Form</title>
	<meta charset="UTF-8">
	<meta name ="viewpoint" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<!--Font Awesome Link-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<!-- Bootstrap Link -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	
	<!--  main CSS file -->
	<link rel="stylesheet" type="text/css" href="styles/style3.css">
	
	<!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<!-- Latest compiled Popper -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>	
	<!-- Latest compiled FontAwesome Js -->
	<script src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
</head>
<body>

	<div class = "container mt-5 mb-5">
		<div class = "row">
			<div class = "col-md-2">
			</div>
			<div class = "col-md-8">
				<div class = "row" style = "margin-top: 12px; box-shadow: -1px 1px 50px 10px black;">
					<div class = "col-md-6">
						<form method="post" action=""> 
							<ul>
								<a href = "login.html" style = "border-bottom: 2px solid #F44C89; padding: 10px;"> Sign In </a>
								<a href = "register.html">/ Sign Up</a>
							</ul>
							<label class = "label control-label">Email:</label>
							<input type = "text" name = "email" class = "form-control" placeholder = "Email">
							<label class = "label control-label">Password:</label>
							<input type = "password" name = "pass" class = "form-control" placeholder = "Password">
							<input type = "checkbox"><small>Remember me ?</small>
							<a href="#"><input type="submit" name="login" class="btn btn-info" value="SIGN IN"></a>
							<a href="index.php"><div class="btn btn-info">BACK TO HOME</div></a>
							<a href="register.php" style="text-decoration: none;"><h6 class = "text-center">DO YOU HAVE AN ACCOUNT ?</h6></a>
							<a href="#" style="text-decoration: none;"><p class = "text-center">FORGOT PASSWORD ?</p></a>
						</form>
					</div>
					<div class = "col-md-6">
						<img src="images/side.jpg">
					</div>
				</div>
			</div>
			<div class = "col-md-2">
			</div>
		</div>
	</div>

</body>
</html>

