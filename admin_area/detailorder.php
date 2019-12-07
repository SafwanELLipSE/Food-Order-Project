<!DOCTYPE html>
<?php 
	include("functions/function.php"); 
	include("includes/db.php");
	session_start();
	if(!isset($_SESSION['patientSession'])){
	echo "<script>window.open('adminlogin.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Posts</title>
	
	<!--Font Awesome Link-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
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
          <a class="navbar-brand" href="#">AdminArea</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Dashboard</a></li>
            <li class="active"><a href="menuli.php">Menu List</a></li>
            <li><a href="categoryli.php">Category List</a></li>
            <li><a href="itemli.php">Item List</a></li>
            <li><a href="userli.php">User List</a></li>
            <li><a href="reservationli.php">Reservation List</a></li>
			<li><a href="contactli.php">Contact List</a></li>
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Customer Detail Page<small>Manage Customer Detail</small></h1>
          </div>
          <div class="col-md-2">
            <div class="dropdown create">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Create Content
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li><a type="button" data-toggle="modal" data-target="#addPage">Add New Item</a></li>
                <li><a type="button" data-toggle="modal" data-target="#addcat">Add New Category</a></li>
                <li><a type="button" data-toggle="modal" data-target="#addmen">Add New Menu</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li>Order List</li>
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
                <i class="fas fa-cog fa-pulse"></i> Dashboard
              </a>
			  <a href="menuli.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Menu List <span class="badge"><?php countMenu(); ?></span></a>
              <a href="categoryli.php" class="list-group-item"><i class="fas fa-receipt"></i> category List <span class="badge"><?php countCategory(); ?></span></a>
              <a href="itemli.php" class="list-group-item"><i class="fas fa-cookie-bite"></i> Item List <span class="badge"><?php countItem(); ?></span></a>
              <a href="userli.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> User List <span class="badge"><?php countUser(); ?></span></a>
              <a href="reservationli.php" class="list-group-item"><i class="fab fa-readme"></i> Reservation List <span class="badge"><?php countReservation();?></span></a>         
              <a href="contactli.php" class="list-group-item"><i class="far fa-id-card"></i> Contact List <span class="badge"><?php countContact();?></span></a>
			  <a href="orderli.php" class="list-group-item"><i class="fas fa-book"></i> Order List <span class="badge"><?php countOrder();?></span></a>
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
							$ord_customer = $row_ord['c_id'];
							$ord_date = $row_ord['order_date'];
							$ord_amount = $row_ord['amount'];
						
							$get_cus = "select * from customer where customer_id ='$ord_customer'";
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
					</div>
				  </div>
				  <hr>
				  <div style="margin-top: 35px;" class="row">
					<div class="col-md-6">
						<img src="product_images/<?php echo $pro_image;?>" class="img-rounded" style="width:250px; height:250px;">
					</div>
					<div class="col-md-6">
						<h3><strong>Item Name:</strong> <?php echo $pro_name;?></h3>
						<h5><b>Item ID: </b><?php echo $pro_id;?></h5>
						<h5><b>Price: </b><?php echo $pro_price;?> Taka</h5>
						<h5><b>Menu: </b><?php echo $menu_name;?></h5>
						<h5><b>Category: </b><?php echo $category_name;?></h5>
						<h5><b>Descraption: </b><?php echo $pro_desc;?></h5>
						<h5><b>Keywords: </b><?php echo $pro_key;?></h5>
						<hr>
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
      <p>Copyright <i class="far fa-copyright"></i> 2019 Purchase BD. All Rights Reserved.</p>
    </footer>

    <!-- Modals -->

 <!-- Add item Page -->
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="index.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Item in Menu</h4>
      </div>
      <div class="modal-body">
        <div  class="form-group">
			<label>Item Name</label>
			<input type="text" name="product_name" class="form-control" placeholder="Item Name" required>
        </div>
		<div class="form-group">
          <label>Item Categroy</label>
          <select name="product_cat" class="form-control">
			<option>Select a Category</option>
			<?php
				$get_cats = "select * from category";
				$run_cats = mysqli_query($con, $get_cats);
				
				while ($row_cats = mysqli_fetch_array($run_cats))
				{
					$cat_id = $row_cats['cat_id']; 
					$cat_name = $row_cats['cat_name'];
					echo "<option value='$cat_id'>$cat_name</option>";
				}
			?>
		  </select>
        </div>
		<div class="form-group">
          <label>Item Menu</label>
          <select name="product_men" class="form-control">
			<option>Select a Menu</option>
			<?php
				$get_menu = "select * from menu";
				$run_menu = mysqli_query($con, $get_menu);
					
				while ($row_menu=mysqli_fetch_array($run_menu))
				{
					$menu_id = $row_menu['men_id']; 
					$menu_name = $row_menu['men_name'];
					echo "<option value='$menu_id'>$menu_name</option>";
				}
			?>
		  </select>
        </div>
			<div class="form-group">
          <label>Item Image</label>
          <input type="file" name="product_image">
        </div>
		<div class="form-group">
          <label>Item Price</label>
          <input type="text" name="product_price" class="form-control" placeholder="Item Price" required>
        </div>
        <div class="form-group">
          <label>	
			<div class="form-group">
				<label>Item Description</label>
			</div>
		  </label>
          <textarea name="product_desc" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label>Item Keywords</label>
          <input type="text" name="product_keywords" class="form-control" placeholder="Item Keywords" required>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="insert_post" class="btn btn-primary">Add Item</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- add category Page -->
<div class="modal fade" id="addcat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="index.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Category</h4>
      </div>
      <div class="modal-body">
        <div  class="form-group">
			<label>Category Name</label>
			<input type="text" name="cat_name" class="form-control" placeholder="Category Name" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="inser_cat" class="btn btn-primary">Add Category</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- add category Page -->
<div class="modal fade" id="addmen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="index.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Add New Menu</h4>
      </div>
      <div class="modal-body">
        <div  class="form-group">
			<label>Menu Name</label>
			<input type="text" name="men_name" class="form-control" placeholder="Menu Name" required>
        </div>
      </div> 
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="inser_men" class="btn btn-primary">Add Menu</button>
      </div>	  
    </form>
    </div>
  </div>
</div>

  <script>
     CKEDITOR.replace( 'product_desc' );
 </script>

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