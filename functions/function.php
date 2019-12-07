<?php 
// After uploading to online server, change this connection accordingly
$con = mysqli_connect("localhost","root","","druglife");

if (mysqli_connect_errno())
  {
	echo "The Connection was not established: " . mysqli_connect_error();
  }

// getting the user IP address
function getIp() {
    
	$ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
	{
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } 
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
	{
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

//creating the shopping cart

function cart(){

	if(isset($_GET['add_cart'])){

		global $con; 
		
		$ip = getIp();
		
		$pro_id = $_GET['add_cart'];
		$check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";		
		$run_check = mysqli_query($con, $check_pro); 
		
		if(mysqli_num_rows($run_check)>0)
		{
			echo "";		
		}
		else 
		{
			$insert_pro = "insert into cart (p_id,ip_add) values ('$pro_id','$ip')";
			$run_pro = mysqli_query($con, $insert_pro); 
		
			echo "<script>window.open('index.php','_self')</script>";
		}	
	}
}

 // getting the total added items
 
 function total_items(){
 
		global $con; 
	
	if(isset($_GET['add_cart']))
	{
		
		$ip = getIp(); 
		
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($con, $get_items); 
		$count_items = mysqli_num_rows($run_items);
		
	}
	else 
	{
		$ip = getIp(); 
		
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($con, $get_items); 
		$count_items = mysqli_num_rows($run_items);	
	}
	
	echo $count_items;
}

// Getting the total price of the items in the cart 
	
function total_price(){
	
	$total = 0;
	
	global $con; 
	
	$ip = getIp(); 
	
	$sel_price = "select * from cart where ip_add='$ip'";
	$run_price = mysqli_query($con, $sel_price); 
	
	while($p_price=mysqli_fetch_array($run_price))
	{
		$pro_id = $p_price['p_id']; 
		$pro_price = "select * from product where product_id='$pro_id'";
		$run_pro_price = mysqli_query($con,$pro_price); 
		
		while ($pp_price = mysqli_fetch_array($run_pro_price))
		{
		
			$product_price = array($pp_price['product_price']);
			$values = array_sum($product_price);
			$total += $values;
		
		}
	}
	
	echo $total;
		
	
}


//getting the categories

function getCats(){
	
	global $con; 
	$get_cats = "select * from category";
	$run_cats = mysqli_query($con, $get_cats);
	
	while ($row_cats = mysqli_fetch_array($run_cats))
	{
		$cat_id = $row_cats['cat_id']; 
		$cat_name = $row_cats['cat_name'];
		echo "<a class='dropdown-item' href='menu.php?cat=$cat_id'><i class='fas fa-utensils'></i> $cat_name</a>";
	}
}

//getting the Menu

function getMenu(){
	
	global $con; 
	$get_menu = "select * from menu";
	$run_menu = mysqli_query($con, $get_menu);
	
	while ($row_menu=mysqli_fetch_array($run_menu))
	{
		$menu_id = $row_menu['men_id']; 
		$menu_name = $row_menu['men_name'];
		echo "<a class='dropdown-item' href='menu.php?menu=$menu_id'><i class='fas fa-hamburger'></i> $menu_name</a>";
	}
}

//getting the Item in index page

function getPro1(){

	if(!isset($_GET['cat']))
	{
		if(!isset($_GET['menu']))
		{

			global $con; 
			
			$get_pro = "select * from product order by RAND() LIMIT 0,8";
			$run_pro = mysqli_query($con, $get_pro); 
			
			while($row_pro=mysqli_fetch_array($run_pro))
				{
			
					$pro_id = $row_pro['product_id'];
					$pro_cat = $row_pro['product_cat'];
					$pro_men = $row_pro['product_men'];
					$pro_name = $row_pro['product_name'];
					$pro_price = $row_pro['product_price'];
					$pro_image = $row_pro['product_image'];
					$pro_desc = $row_pro['product_desc'];
				
					echo "
						<div class = 'col-12 col-md-3 mb-4'>
							<div class = 'card'>
								<div class = 'card-header text-center'>	
									$pro_name
								</div>
									<img class= 'card-img-top' src='admin_area/product_images/$pro_image' alt='Card image' style='width:100%;height:45%';>
								<div class='card-body'>
									<h4 class='card-title text-center'>Price: $pro_price Taka</h4>
									<p class='card-text text-center'>$pro_desc</p>
								</div> 
								<div class='card-footer'>
									<a class='btn btn-primary ml-5 text-white' href='detailpage.php?pro_id=$pro_id'><i class='fas fa-money-check'></i> CheckOut</a>
								</div>
							</div>
						</div>
					
					";
			
				}	
	    }
	}
}

//getting the Item in menu page

function getPro2(){

	if(!isset($_GET['cat']))
	{
		if(!isset($_GET['menu']))
		{

			global $con; 
			
			$get_pro = "select * from product order by RAND()";
			$run_pro = mysqli_query($con, $get_pro); 
			
			while($row_pro=mysqli_fetch_array($run_pro))
				{
			
					$pro_id = $row_pro['product_id'];
					$pro_cat = $row_pro['product_cat'];
					$pro_men = $row_pro['product_men'];
					$pro_name = $row_pro['product_name'];
					$pro_price = $row_pro['product_price'];
					$pro_image = $row_pro['product_image'];
					$pro_desc = $row_pro['product_desc'];
				
					echo "
						<div class = 'col-12 col-md-3 mb-4'>
							<div class = 'card'>
								<div class = 'card-header text-center'>	
									$pro_name
								</div>
									<img class= 'card-img-top' src='admin_area/product_images/$pro_image' alt='Card image' style='width:100%;height:45%;'>
								<div class='card-body'>
									<h4 class='card-title text-center'>Price: $pro_price Taka</h4>
									<p class='card-text text-center'>$pro_desc</p>
								</div> 
								<div class='card-footer'>
									<a class='btn btn-primary ml-5 text-white' href='detailpage.php?pro_id=$pro_id'><i class='fas fa-money-check'></i> CheckOut</a>
								</div>
							</div>
						</div>
					
					";
			
				}	
	    }
	}

}

//getting the Item in menu page with respect to categroy

function getCatPro(){

	if(isset($_GET['cat']))
	{
		$cat_id = $_GET['cat'];

		global $con; 
		
		$get_cat_pro = "select * from product where product_cat='$cat_id'";
		$run_cat_pro = mysqli_query($con, $get_cat_pro); 
		
		$count_cats = mysqli_num_rows($run_cat_pro);
	
		if($count_cats==0){
		
		echo "	
				<div class = 'offset-md-3 col-md-4 mb-2'>
					<img src='images/noproduct.png' class='img-rounded ml-5'>
				</div>
				<div class = 'col-md-12 mb-5'>
					<h2 class='text-center text-sucess mb-5'>No products where found in this category!</h2>
				</div>
			
			";
		}
		
		while($row_cat_pro=mysqli_fetch_array($run_cat_pro))
			{
		
				$pro_id = $row_cat_pro['product_id'];
				$pro_cat = $row_cat_pro['product_cat'];
				$pro_men = $row_cat_pro['product_men'];
				$pro_name = $row_cat_pro['product_name'];
				$pro_price = $row_cat_pro['product_price'];
				$pro_image = $row_cat_pro['product_image'];
				$pro_desc = $row_cat_pro['product_desc'];
			
				echo "
					<div class = 'col-12 col-md-3 mb-4'>
						<div class = 'card'>
							<div class = 'card-header text-center'>	
								$pro_name
							</div>
								<img class= 'card-img-top' src='admin_area/product_images/$pro_image' alt='Card image' style='width:100%;height:45%;'>
							<div class='card-body'>
								<h4 class='card-title text-center'>Price: $pro_price Taka</h4>
								<p class='card-text text-center'>$pro_desc</p>
							</div> 
							<div class='card-footer'>
								<a class='btn btn-primary ml-5 text-white' href='detailpage.php?pro_id=$pro_id'><i class='fas fa-money-check'></i> CheckOut</a>
							</div>
						</div>
					</div>
				
				";
		
			}	
	}

}

//getting the Item in menu page with respect to Menu items

function getMemuPro(){
	if(isset($_GET['menu']))
	{
		$men_id = $_GET['menu'];

		global $con; 
		
		$get_men_pro = "select * from product where product_men='$men_id'";
		$run_men_pro = mysqli_query($con, $get_men_pro); 
		
		$count_men = mysqli_num_rows($run_men_pro);
	
		if($count_men==0){
		
		echo "	
				<div class = 'offset-md-3 col-md-4 mb-2'>
					<img src='images/noproduct.png' class='img-rounded ml-5'>
				</div>
				<div class = 'col-md-12 mb-5'>
					<h2 class='text-center text-sucess mb-5'>No products where found in this Menu!</h2>
				</div>
			
			";
		}
		
		while($row_men_pro=mysqli_fetch_array($run_men_pro)){
		
				$pro_id = $row_men_pro['product_id'];
				$pro_cat = $row_men_pro['product_cat'];
				$pro_men = $row_men_pro['product_men'];
				$pro_name = $row_men_pro['product_name'];
				$pro_price = $row_men_pro['product_price'];
				$pro_image = $row_men_pro['product_image'];
				$pro_desc = $row_men_pro['product_desc'];
			
				echo "
					<div class = 'col-12 col-md-3 mb-4'>
						<div class = 'card'>
							<div class = 'card-header text-center'>	
								$pro_name
							</div>
								<img class= 'card-img-top' src='admin_area/product_images/$pro_image' alt='Card image' style='width:100%;height:45%;'>
							<div class='card-body'>
								<h4 class='card-title text-center'>Price: $pro_price Taka</h4>
								<p class='card-text text-center'>$pro_desc</p>
							</div> 
							<div class='card-footer'>
								<a class='btn btn-primary ml-5 text-white' href='detailpage.php?pro_id=$pro_id'><i class='fas fa-money-check'></i> CheckOut</a>
							</div>
						</div>
					</div>
				
				";
		}	
	}
}


?>










