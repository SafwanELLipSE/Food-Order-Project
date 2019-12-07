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
    <title>Admin Area | Edit Item</title>
	
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
            <li><a href="menuli.php">Menu List</a></li>
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Edit Item Page<small>Edit Item Inforamtion</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li><a href="menuli.php">Item List</a></li>
          <li><a href="menuli.php">Item Detail</a></li>
          <li class="active">Edit Item</li>
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
        </div>
		  <?php
			if(isset($_GET['product_id'])){

			$get_id = $_GET['product_id']; 
			
			$get_pro = "select * from product where product_id='$get_id'";
			$run_pro = mysqli_query($con, $get_pro); 
			$row_pro=mysqli_fetch_array($run_pro);
				
			$pro_id = $row_pro['product_id'];
			$pro_name = $row_pro['product_name'];
			$pro_image = $row_pro['product_image'];
			$pro_price = $row_pro['product_price'];
			$pro_desc = $row_pro['product_desc']; 
			$pro_keywords = $row_pro['product_keywords']; 
			$pro_cat = $row_pro['product_cat'];
			$pro_men = $row_pro['product_men'];
		
			$get_men = "select * from menu where men_id = '$pro_men'"; 
			$run_men = mysqli_query($con, $get_men);
			$row_men = mysqli_fetch_array($run_men);

			$menu_name = $row_men['men_name'];
			 
			$get_cat = "select * from category where cat_id = '$pro_cat'"; 
			$run_cat = mysqli_query($con, $get_cat);
			$row_cat = mysqli_fetch_array($run_cat);

			$category_name = $row_cat['cat_name'];
			}
		?>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Edit Item</h3>
              </div>
              <div class="panel-body">
                <form action="" method="post" enctype="multipart/form-data">
					<div  class="form-group">
						<label>Item Name</label>
						<input type="text" name="product_name" class="form-control" value="<?php echo $pro_name?>">
					</div>
					<div class="form-group">
					  <label>Item Categroy</label>
					  <select name="product_cat" class="form-control">
						<option><?php echo $category_name;?></option>
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
						<option><?php echo $menu_name;?></option>
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
					   <img src="product_images/<?php echo $pro_image; ?>" width="60" height="60" style="margin-top:10px;"/>
					</div>
					<div class="form-group">
					   <label>Item Price</label>
					   <input type="text" name="product_price" class="form-control" value="<?php echo $pro_price;?>">
					</div>
					<div class="form-group">
					  <label>	
						<div class="form-group">
							<label>Item Description</label>
						</div>
					  </label>
					  <textarea name="product_desc" class="form-control"><?php echo $pro_desc;?></textarea>
					</div>
					<div class="form-group">
					  <label>Item Keywords</label>
					  <input type="text" name="product_keywords" class="form-control" value="<?php echo $pro_keywords;?>" >
					</div>
				
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" name="Edit_Item" class="btn btn-primary">Edit Item</button>
				  </div>
                </form>
              </div>
              </div>
          </div>
        </div>
      </div>
    </section>
<?php 
	if(isset($_POST['Edit_Item']))
	{
		//getting the text data from the fields
		$update_id = $pro_id;
		
		$product_name = $_POST['product_name'];
		$product_cat= $_POST['product_cat'];
		$product_men = $_POST['product_men'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keywords = $_POST['product_keywords'];
	
		//getting the image from the field
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];
		move_uploaded_file($product_image_tmp,"product_images/$product_image");

		$update_product = "update product set product_cat='$product_cat',product_men='$product_men',product_name='$product_name',product_price='$product_price',product_image='$product_image',product_desc='$product_desc', product_keywords='$product_keywords' where product_id='$update_id'";
		 
		 $run_product = mysqli_query($con, $update_product);
		 
		if($run_product)
		{
			echo "<script>alert('Item has been updated!')</script>";
			echo "<script>window.open('itemli.php?view_products','_self')</script>";
		}
	}
?>
    <footer id="footer">
      <p>Copyright <i class="far fa-copyright"></i> 2019 Purchase BD. All Rights Reserved.</p>
    </footer>

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
