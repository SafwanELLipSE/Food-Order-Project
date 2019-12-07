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
    <title>User Profile | Order Detail</title>
	
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Order Detail Page<small>Manage Order Detail</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li>My Order</li>
          <li class="active">Order Detail</li>
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
                <h3 class="panel-title">Order Detail</h3>
              </div>
              <div class="panel-body">
				<?php
				
				
					if(isset($_GET['Order_id']))
					{					
						$order_id = $_GET['Order_id'];
						$get_ord = "select * from ordertbl where order_id ='$order_id'";
						$run_ord = mysqli_query($con, $get_ord); 
						
						while($row_ord = mysqli_fetch_array($run_ord))
						{
							$ord_id = $row_ord['order_id'];
							$ord_qty = $row_ord['qty'];
							$ord_product = $row_ord['p_id'];
							$ord_date = $row_ord['order_date'];
							$ord_amount = $row_ord['amount'];
						
							
							$get_pro = "select * from product where product_id ='$ord_product'";
							$run_pro = mysqli_query($con, $get_pro); 
							
							$row_pro=mysqli_fetch_array($run_pro);
							
							$pro_id = $row_pro['product_id'];
							$pro_cat = $row_pro['product_cat'];
							$pro_men = $row_pro['product_men'];
							$pro_name = $row_pro['product_name'];
							$pro_price = $row_pro['product_price'];
							$pro_image = $row_pro['product_image'];
							$pro_desc = $row_pro['product_desc'];
							$pro_key = $row_pro['product_keywords'];
							
							$get_men = "select * from menu where men_id = '$pro_men'"; 
							$run_men = mysqli_query($con, $get_men);
							$row_men = mysqli_fetch_array($run_men);
								
							$menu_name = $row_men['men_name'];
								 
							$get_cat = "select * from category where cat_id = '$pro_cat'"; 
							$run_cat = mysqli_query($con, $get_cat);
							$row_cat = mysqli_fetch_array($run_cat);

							$category_name = $row_cat['cat_name'];
				?>
				<table class="table table-striped table-hover">
				  <div class="row">
					<div class="col-md-6">
						<img src="../admin_area/product_images/<?php echo $pro_image;?>" class="img-rounded" style="width:250px; height:250px;">
					</div>
					<div class="col-md-6">
						<h3><strong>Item Name:</strong> <?php echo $pro_name;?></h3>
						<h5><b>Item ID: </b><?php echo $pro_id;?></h5>
						<h5><b>Price: </b><?php echo $pro_price;?> Taka</h5>
						<h5><b>Menu: </b><?php echo $menu_name;?></h5>
						<h5><b>Category: </b><?php echo $category_name;?></h5>
						<h5><b>Descraption: </b><?php echo $pro_desc;?></h5>
						<h5><b>Keywords: </b><?php echo $pro_key;?></h5>
						<br>
						<h5><b>Order Date: </b><?php echo $ord_date;?></h5>
						<h5><b>Quantity: </b><?php echo $ord_qty;?></h5>
						<h5><b>Total: </b><?php echo $ord_amount;?> Taka</h5>
					</div>
				  </div>
				</table>
				<?php
						}
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