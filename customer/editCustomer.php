<!DOCTYPE html>
<?php 
	include("functions/function.php"); 
	include("includes/db.php");
	session_start();
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
    <title>User Profile | Edit Account</title>
	
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
            <li><a href="index.php">Dashboard</a></li>
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Edit Page<small>About</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li>My Account</li>
          <li class="active">Edit Your Account</li>
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
                <h3 class="panel-title">Edit Your Account</h3>
              </div>
			  <?php
				if(isset($_GET['customer_id'])){

					$get_id = $_GET['customer_id']; 
					$get_cus = "select * from customer where customer_id ='$get_id'";
					$run_cus = mysqli_query($con, $get_cus); 

					$row_cus=mysqli_fetch_array($run_cus);
					
					$cus_id = $row_cus['customer_id'];
					$cus_name = $row_cus['customer_name'];
					$cus_email = $row_cus['customer_email'];
					$cus_pass = $row_cus['customer_pass'];
					$cus_country = $row_cus['customer_country'];
					$cus_city = $row_cus['customer_city'];
					$cus_contact = $row_cus['customer_contact'];
					$cus_address = $row_cus['customer_address'];
					$cus_image = $row_cus['customer_image']; 
				}
			  ?>
              <div class="panel-body">
                <form action="" method="post" enctype="multipart/form-data">
					<div  class="form-group">
						<label>Customer Name: </label>
						<input type="text" name="c_name" class="form-control" value="<?php echo $cus_name;?>" required>
					</div>
					<div  class="form-group">
						<label>Customer Email: </label>
						<input type="text" name="c_email" class="form-control" value="<?php echo $cus_email;?>" required>
					</div>
					
					<div  class="form-group">
						<label>Customer Password:</label>
						<input type="password" name="c_pass" class="form-control" value="<?php echo $cus_pass;?>" required>
					</div>
					<div class="form-group">
					   <label>Customer Image:</label>
					   <input type="file" name="c_image">
					   <img src="../customer/customer_images/<?php echo $cus_image;?>" width="60" height="60" style="margin-top:10px;"/>
					</div>
					<div class="form-group">
					  <label>Customer Country:</label>
					  <select name="c_country" class="form-control">
						<option><?php echo $cus_country;?></option>
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
					<div class="form-group">
					  <label>Customer City:</label>
					  <input type="text" name="c_city" class="form-control" value="<?php echo $cus_city;?>" required>
					</div>
					<div class="form-group">
					  <label>Customer Contact:</label>
					  <input type="text" name="c_contact" class="form-control" value="<?php echo $cus_contact;?>" required>
					</div>
					<div class="form-group">
					  <label>Customer Address:</label>
					  <input type="text" name="c_address" class="form-control" value="<?php echo $cus_address;?>" required>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" name="Edit_Customer" class="btn btn-primary">Edit Item</button>
				  </div>
                </form>
              </div>
              </div>
          </div>
        </div>
      </div>
    </section>
<?php 
	if(isset($_POST['Edit_Customer']))
	{
		//getting the text data from the fields
		$update_id = $cus_id;
		
		$customer_name = $_POST['c_name'];
		$customer_email = $_POST['c_email'];
		$customer_password = $_POST['c_pass'];
		$customer_country = $_POST['c_country'];
		$customer_city = $_POST['c_city'];
		$customer_contact = $_POST['c_contact'];
		$customer_address = $_POST['c_address'];
	
		//getting the image from the field
		$customer_image = $_FILES['c_image']['name'];
		$customer_image_tmp = $_FILES['c_image']['tmp_name'];
		move_uploaded_file($customer_image_tmp,"../customer/customer_images/$customer_image");

		$update_product = "update customer set customer_name='$customer_name',customer_email='$customer_email',customer_pass='$customer_password',customer_city='$customer_city',customer_contact='$customer_contact',customer_address='$customer_address', customer_image='$customer_image' where customer_id='$update_id'";
		 
		$run_product = mysqli_query($con, $update_product);
		 
		if($run_product)
		{
			echo "<script>alert('Customer has been updated!')</script>";
			echo "<script>window.open('myAccount.php','_self')</script>";
		}
	}
?>
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