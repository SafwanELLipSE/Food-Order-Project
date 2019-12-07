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
    <title>User Profile | My Account</title>
	
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
            <li class="active"><a href="myAccount.php">My Account</a></li>
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
            <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span>  My Account <small>Manage Your Account</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li class="active">My Account</li>
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
                <h3 class="panel-title">Posts</h3>
              </div>
              <div class="panel-body">
				<?php
				
				
					if(isset($_SESSION['patientSession']))
					{	
						$customer_email = $_SESSION['patientSession'];				
						$get_cus = "select * from customer where customer_email='$customer_email'";
						
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
				?>
				<table class="table table-striped table-hover">
				  <div class="row">
					<div class="col-md-6">
						<img src="../customer/customer_images/<?php echo $cus_image;?>" class="img-rounded" style="width:250px; height:250px;">
					</div>
					<div class="col-md-6">
						<h3><strong>Name:</strong> <?php echo $cus_name;?></h3>
						<h5>ID: <?php echo $cus_id;?></h5>
						<h5>Email: <?php echo $cus_email;?></h5>
						<h5>Password: <?php echo $cus_pass;?></h5>
						<h5>Address: <?php echo $cus_address;?></h5>
						<h5>Country: <?php echo $cus_country;?></h5>
						<h5>City: <?php echo $cus_city;?></h5>
						<h5>Contact: <?php echo $cus_contact;?></h5>
						<a class="btn btn-default btn-success" href="editCustomer.php?customer_id=<?php echo $cus_id;?>"><i class="fas fa-edit"></i> Edit</a>
						<a style = "margin-left:20px;"class="btn btn-default btn-danger" type="button" data-toggle="modal" data-target="#delacc"><i class="fas fa-trash-alt"></i> Delete</a>
						<br>
						<br>
						<a class="btn btn-default btn-info" type="button" data-toggle="modal" data-target="#chngpass"><i class="fas fa-recycle fa-spin"></i> Password Change</a>
					</div>
				  </div>
				</table>
				<?php
					}	
				?>
              </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
		Copyright <i class="far fa-copyright"></i> 2019 Purchase BD. All Rights Reserved.
    </footer>

<!-- Modals -->
<!-- Change Password -->
<div class="modal fade" id="chngpass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="myAccount.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
        <div  class="form-group">
			<label>Old Password:</label>
			<input type="password" name="current_pass" class="form-control" placeholder="Old Password">
        </div>
		<div  class="form-group">
			<label>New Password:</label>
			<input type="password" name="new_pass" class="form-control" placeholder="New Password">
        </div>
		<div  class="form-group">
			<label>New Password Again:</label>
			<input type="password" name="new_pass_again" class="form-control" placeholder="New Password Again">
        </div>
      </div> 
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="change_pass" class="btn btn-success">Change Password</button>
      </div>	  
    </form>
    </div>
  </div>
</div>

<!-- Delete Account -->
<div class="modal fade" id="delacc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="myAccount.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Delete Own Account</h4>
      </div>
      <div class="modal-body">
		<h4>Do you really want to DELETE your account?</h4>
		<h4><?php echo $cus_name;?></h4>
			<button style = "margin-left:20px;" type="submit" name="yes" class="btn btn-success" class="form-control">Yes, I want.</button>
			<button style = "margin-left:20px;" type="submit" name="no" class="btn btn-info" class="form-control">No, I was kidding.</button>

      </div> 
	  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>	  
    </form>
    </div>
  </div>
</div>

<?php 
	if(isset($_POST['change_pass']))
	{
		$user = $_SESSION['patientSession']; 
		$current_pass = $_POST['current_pass']; 
		$new_pass = $_POST['new_pass']; 
		$new_again = $_POST['new_pass_again']; 
		
		$sel_pass = "select * from customer where customer_pass='$current_pass' AND customer_email='$user'";
		$run_pass = mysqli_query($con, $sel_pass); 
		$check_pass = mysqli_num_rows($run_pass); 
		
		if($check_pass==0)
		{
			echo "<script>alert('Your Current Password is wrong!')</script>";
			exit();
		}
		if($new_pass!=$new_again)
		{
			echo "<script>alert('New password do not match!')</script>";
			exit();
		}
		else 
		{
			$update_pass = "update customer set customer_pass='$new_pass' where customer_email='$user'";
			$run_update = mysqli_query($con, $update_pass); 
			echo "<script>alert('Your password was updated succesfully!')</script>";
			echo "<script>window.open('myAccount.php','_self')</script>";
		}
	}
?>

<?php 
	$user = $_SESSION['patientSession']; 
	
	if(isset($_POST['yes']))
	{
		$delete_customer = "delete from customer where customer_email='$user'";
		$run_customer = mysqli_query($con,$delete_customer); 
		
		echo "<script>alert('We are really sorry, your account has been deleted!')</script>";
		echo "<script>window.open('../index.php','_self')</script>";
	}
	if(isset($_POST['no']))
	{
		echo "<script>alert('oh! do not make fun again!')</script>";
		echo "<script>window.open('myAccount.php','_self')</script>";
	}
?>
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