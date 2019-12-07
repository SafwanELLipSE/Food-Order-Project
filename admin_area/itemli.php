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
    <title>Admin Area | Item List</title>
	
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
            <li class="active"><a href="itemli.php">Item List</a></li>
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Item List<small>Manage Item Informations</small></h1>
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
          <li class="active">Item List</li>
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
                <h3 class="panel-title">Item List</h3>
              </div>
              <div class="panel-body">
				<?php
				
					global $con; 
					$get_pro = "select * from product";
					$run_pro = mysqli_query($con, $get_pro); 
					
					while($row_pro=mysqli_fetch_array($run_pro))
						{
							$pro_id = $row_pro['product_id'];
							$pro_cat = $row_pro['product_cat'];
							$pro_men = $row_pro['product_men'];
							$pro_name = $row_pro['product_name'];
							$pro_price = $row_pro['product_price'];
							$pro_image = $row_pro['product_image'];
						
						$get_men = "select * from menu where men_id = '$pro_men'"; 
						$run_men = mysqli_query($con, $get_men);
						$row_men = mysqli_fetch_array($run_men);

						$menu_name = $row_men['men_name'];
							 
						$get_cat = "select * from category where cat_id = '$pro_cat'"; 
						$run_cat = mysqli_query($con, $get_cat);
						$row_cat = mysqli_fetch_array($run_cat);

						$category_name = $row_cat['cat_name'];
								
				?>
				<form action="" method="post" enctype="multipart/form-data">
                <table class="table table-striped table-hover">
					<tr>
						<th>Image</th>
						<th>Detail of Item</th>
                        <th>Option Radio</th>
                        <th></th>
                    </tr> 
                    <tr>
                        <td><img src="product_images/<?php echo $pro_image; ?>" style="width:110px; height:110px;"></td>
                        <td>
							<h5><b>ID:</b> <?php echo $pro_id;?></</h5>
							<h5><b>Price:</b> <?php echo $pro_price;?></</h5>
							<h5><b>Menu:</b> <?php echo $menu_name;?></</h5> 
							<h5><b>Categroy:</b> <?php echo $category_name;?></h5>
						</td>
                        <td><input style="margin-left:40px; margin-top:40px;" type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
                        <td><a style= "margin-top:35px;" class="btn btn-default" href="detailItem.php?product_id=<?php echo $pro_id;?>">Detail</a> <button type="submit" style= "margin-top:35px;" class="btn btn-danger" name="remove_item">Delete</button></td>
                    </tr>
				</table>
				</form>

				<?php
					}	
				?>
              </div>
              </div>
				<?php 
					if(isset($_POST['remove_item']))
					{
						foreach($_POST['remove'] as $remove_id)
						{
							$delete_item = "delete from product where product_id = '$remove_id'";
							$run_delete = mysqli_query($con, $delete_item); 
							
							if($run_delete)
							{
								echo "<script>alert('Item has been deleted!')</script>";
								echo "<script>window.open('itemli.php','_self')</script>";
							}
						}
					
					}			
				?>
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