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
    <title>User Profile | My Order</title>
	
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
            <li class="active"><a href="orderpage.php">My Order</a></li>
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
            <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span>  My Order <small>Manage Your Order</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li class="active">My Order</li>
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
                <h3 class="panel-title">My Order</h3>
              </div>
              <div class="panel-body">
				<?php
				
					$customer_email = $_SESSION['patientSession'];				
					$get_cus = "select * from customer where customer_email='$customer_email'";
						
					$run_cus = mysqli_query($con, $get_cus); 
					$row_cus = mysqli_fetch_array($run_cus);
						
					$cus_id = $row_cus['customer_id'];
					
					$get_ord = "select * from ordertbl where c_id ='$cus_id'";
					$run_ord = mysqli_query($con, $get_ord); 
					
					while($row_ord =mysqli_fetch_array($run_ord))
					{
							$ord_id = $row_ord['order_id'];
							$ord_qty = $row_ord['qty'];
							$ord_date = $row_ord['order_date'];
							$ord_amount = $row_ord['amount'];
				?>
				<table class="table table-striped table-hover">
					<tr>
						<th>Serial</th>
						<th>Detail of Order</th>
                        <th>Option Radio</th>
                        <th></th>
                    </tr> 
                    <tr>
                        <td><b>No.: </b><?php echo $ord_id;?></td>
                        <td>
							<h5><b>Quantity: </b> <?php echo $ord_qty;?></</h5>
							<h5><b>Date: </b> <?php echo $ord_date;?></</h5>
							<h5><b>Amount: </b> <?php echo $ord_amount;?></</h5>
						</td>
                        <td><input style="margin-left:40px; margin-top:20px;" type="checkbox" name="remove[]" value="<?php echo $ord_id;?>"/></td>
                        <td><a style= "margin-top:15px;" class="btn btn-default" href="detailorder.php?Order_id=<?php echo $ord_id;?>">Detail</a> <button type="submit" style= "margin-top:15px;" class="btn btn-danger" name="cancel_order">Cancel</button></td>
                    </tr>
				</table>
				</form>
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
	<?php 
		if(isset($_POST['cancel_order']))
		{
			foreach($_POST['remove'] as $remove_id)
			{
				$delete_item = "delete from ordertbl where order_id = '$remove_id'";
				$run_delete = mysqli_query($con, $delete_item); 
				
				if($run_delete)
				{
					echo "<script>alert('Order has been canceled!')</script>";
					echo "<script>window.open('orderli.php','_self')</script>";
				}
			}
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